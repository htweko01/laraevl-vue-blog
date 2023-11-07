<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function categories() {
        $categories = Category::all();
        return response([
            'categories' => $categories,
        ], 200);
    }

    public function create(Request $request) {
        $category = $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required'
        ]);

        Category::create($category);
        return response([
            'message' => 'Create Success!',
        ], 200);
    }

    public function edit(Request $request, Category $category) {
        $fields = $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required'
        ]);

        $category->update($fields);
        return response([
            'message' => 'Edit Category Success!',
        ], 200);
    }

    public function delete(Category $category) {
        $category->delete();
        return response([
            'message' => "Delete Success",
        ], 200);
    }

}
