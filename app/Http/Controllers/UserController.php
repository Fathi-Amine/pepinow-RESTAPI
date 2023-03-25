<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     */
    public function register(StoreUserRequest $request)
    {
        //
        $userValidated = $request->validated();
        $userValidated['password'] = Hash::make($userValidated['password']);
        $user = User::create($userValidated);

        return response()->json([
            'message'=>'user created successfully',
            'user'=>$user,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function logout(Request $request)
    {
        //
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function login(Request $request)
    {
        //
       $request->validate([
        'email' => 'required|string|email|exists:users',
        'password' => 'required|string'
       ]);

       $credentials = [
            'email' => $request->email,
            'password' => $request->password,
    ]   ;


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $accessToken = $user->createToken('pepinowToken')->plainTextToken;
            $personalAccessToken = PersonalAccessToken::findToken($accessToken);
            $personalAccessToken->expires_at = now()->addMinutes(50);
            $personalAccessToken->save();

            return response()->json([
                'user' => $user,
                'access_token' => $accessToken,
                'token_type' => 'Bearer',
            ]);
        }else{
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function refreshToken()
    {
        $user = Auth::user();
    
        $accessToken = $user->currentAccessToken();
    
        $accessToken->delete();
    
        $newAccessToken = $user->createToken('newToken')->plainTextToken;
    
        return response()->json([
            'access_token' => $newAccessToken,
            'token_type' => 'Bearer',
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $request->validated();

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->update();

        return response()->json(['message' => 'Profile updated successfully']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'The provided old password is incorrect'], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password reset successfully']);
    }

    public function assignRole(Request $request, User $user)
    {
        $role = Role::find($request->role_id);

        if (!$role) {
            return response()->json([
                'message' => 'Role not found'
            ], 404);
        }

        $user->assignRole($role);

        return response()->json([
            'message' => 'Role assigned to user successfully',
            'data' => $user
        ]);
    }
}
