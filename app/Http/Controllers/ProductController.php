<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function filter(Request $request)
{
    // Initialize the product query builder 
    $query = Product::query();


    // If the 'filter' key is set and true, apply filtering logic
    if (isset($request->filter) && $request->filter === "true" || $request->filter === true) {


        // Validate incoming request data
        $validated = $request->validate([
            'subcategory_id' => 'nullable|exists:subcategories,id', // Make nullable in case user doesn't provide it
            'product_type' => 'nullable|string',
            'condition' => 'nullable|string',
            'seller_type' => 'nullable|string',
            'location' => 'nullable|array', // Accepting multiple locations as an array
            'location.*' => 'string', // Ensuring each location is a string
            'radius' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
        ]);

        // Apply filtering for each parameter if provided in the request
        if ($request->has('subcategory_id')) {
            $query->where('subcategory_id', $validated['subcategory_id']);
        }


        if ($request->has('product_type')) {
            $query->where('product_type', $validated['product_type']);
        }

        if ($request->has('condition')) {
            $query->where('condition', $validated['condition']);
        }

        if ($request->has('seller_type')) {
            $query->where('seller_type', $validated['seller_type']);
        }

        // Handle filtering by multiple locations
        if ($request->has('location')) {
            $query->whereIn('location', $validated['location']); 
        }

        
        if ($request->has('radius')) {
            $query->where('radius', '<=', $validated['radius']); 
        }

        // price get as higher we show lower price
        if ($request->has('price')) {
            $query->where('price', '<=', $validated['price']); 
        }

        // Paginate the filtered products (10 products per page as an example)
        $filter_products = $query->paginate(10);

        // 
        $products = !$filter_products->isEmpty() ?  $filter_products : Product::paginate(10);

        
        return response()->json([
            'message' => 'Filtered products retrieved successfully!',
            'data' => $products
        ], 200);

    } else {

        // If 'filter' key is not set or value is false execute this 
        $products = Product::paginate(10); 
        return response()->json([
            'message' => 'All products retrieved successfully!',
            'data' => $products
        ], 200);
    }
}
    
}
