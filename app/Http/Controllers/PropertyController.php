<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Property;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::all();
        return response()->json([$properties],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'userId' => 'required',
            'location' => 'required|string',
            'type' => 'required|in:sale,rent',
        ]);
        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validate->errors(),
            ], 422);
        }
        $property = new Property();
        $property['userId'] = $request['userId'];
        $property['location'] = $request['location'];
        $property['type'] = $request['type'];
        $property->save();
        return response()->json([
            'message' => 'property added successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return response()->json([
            'data' => $property,
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validate = $request->validate([
            'userId' => 'required',
            'location' => 'required|string',
            'type' => 'required|in:sale,rent',
        ]);
        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validate->errors(),
            ], 422);
        }
        $property->update([
            'userId' => $request['userId'],
            'location' => $request['location'],
            'type' => $request['type'],
        ]);
        return response()->json([
            'message' => 'property updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json([
            'message' => 'property deleted succesfully',
        ], 200);
    }
}
