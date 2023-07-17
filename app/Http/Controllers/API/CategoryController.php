<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show all categories
        $data=Category::all();
        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully.',
            'data' => $data
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create category
        //with validations
//        dd($request->all());
        $request->validate([
            'name' => 'required',
        ]);
        $data=Category::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data' => $data
            ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show one category
        $data=Category::where('id',$id);
        return response()->json([
            'success' => true,
            'message' => 'Category retrieved successfully.',
            'data' => $data
            ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete one category
        $data=Category::where('id',$id);
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.',
            'data' => $data
            ], 200);
    }
}
