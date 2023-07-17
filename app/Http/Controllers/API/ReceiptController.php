<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show all receipts
        $data=Receipt::all();
        return response()->json([
            'success' => true,
            'message' => 'Receipts retrieved successfully.',
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
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',
        ]);

        // Calculate the total price
        $totalPrice = Product::whereIn('id', $validatedData['product_id'])->sum('price');

        // Create the receipt
        $receipt = Receipt::create([
            'user_id' => $validatedData['user_id'],
            'total_price' => $totalPrice,
        ]);

        // Update the product quantities
        $products = Product::whereIn('id', $validatedData['product_id'])->get();
        foreach ($products as $product) {
            $product->decrement('quantity', 1);
        }
        // Return the receipt
        return response()->json([
            'success' => true,
            'message' => 'Receipt created successfully.',
            'data' => $receipt
            ], 200);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show one receipt
        $data=Receipt::where('id',$id);
        return response()->json([
            'success' => true,
            'message' => 'Receipt retrieved successfully.',
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
        //
    }
}
