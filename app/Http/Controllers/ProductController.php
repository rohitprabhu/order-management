<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        // Set default value for "in_stock" attribute
        $request->input('in_stock', 1);

        if ($request->get('in_stock') === 0) {
            return response()->json(['error' => 'Products Not Found'], 404);
        } else {
            return response()->json(['success' => 'Listing Products'], 200);
        }
    }
}
