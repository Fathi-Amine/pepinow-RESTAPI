<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Http\Resources\PlantResource;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        //
        // $plants = Plant::with('categories')->get();
        // return PlantResource::collection($plants);
        $user = auth()->user();
        $plants = Plant::with('categories')
                    ->where('user_id', $user->id)
                    ->get();
        return PlantResource::collection($plants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {

        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $plant = Plant::create($validatedData);
        
        $plant->categories()->attach($request->input('categories'));

        return response()->json(['message' => 'Plant created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        //
        return new PlantResource($plant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        //
        $validated_request = $request->validated();

        $plant->update($validated_request);

        $plant->categories()->sync($request->input('categories', []));

        return response()->json(['message' => 'Plant updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        //

         // Delete the plant
        $plant->delete();

        // Return a response indicating success
        return response()->json(['message' => 'Plant deleted successfully']);
    }

    // public function index(Request $request)
    // {
    //     $query = Plant::query();
        
    //     // Apply filters
    //     if ($request->has('category')) {
    //         $query->whereHas('categories', function($q) use ($request) {
    //             $q->where('name', $request->category);
    //         });
    //     }
        
    //     // Retrieve plants
    //     $plants = $query->with('categories')->get();
        
    //     // Return response
    //     return PlantResource::collection($plants);
    // }

}
