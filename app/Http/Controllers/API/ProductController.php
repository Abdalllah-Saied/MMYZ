<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show all ctegories
        $data=Product::all();
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data' => $data
            ], 200);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store product
        //with validations
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'branch_id' => 'required',
            'category_id' => 'required',
            'code'=>'required',
        ]);
        //if the image is not null then store it
        if($request->image){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        // if cate
        $data=Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'branch_id' => $request->branch_id,
            'category_id' => $request->category_id,
            'image' => $name,
            'code'=>$request->code,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data' => $data
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show one product
        $data=Product::where('id',$id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully.',
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
        //update product
        //with validations
$request->validate([
            'name' => 'required',
            'price' => 'required',
            'branch_id' => 'required',
            'category_id' => 'required',
            'code'=>'required',
        ]);
        //if the image is not null then store it
        if($request->image){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }

        $data=Product::where('id',$id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'branch_id' => $request->branch_id,
            'category_id' => $request->category_id,
            'image' => $name,
            'code'=>$request->code,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => $data
            ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete product
        $data=Product::where('id',$id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.',
            'data' => $data
            ], 200);
    }
    //search product by code
    public function search(Request $request){
        $data=Product::where('code',$request->code)->get();
        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully.',
            'data' => $data
            ], 200);
    }
}
