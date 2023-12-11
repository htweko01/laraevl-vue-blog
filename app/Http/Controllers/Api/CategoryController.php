<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    //
    public function categories() {
        $categories = Category::all();
        return $categories;
        // return response([
        //     'categories' => $categories,
        // ], 200);
    }

    public function create(Request $request) {
        $category = $this->validateCategory($request);

        Category::create($category);
        return response([
            'message' => 'Create Success!',
        ], 200);
    }

    public function edit(Request $request, Category $category) {

        $fields = $this->validateCategory($request, $category->id);

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

    private function validateCategory($request, $id = null) {
        return Validator::make($request->all(), [
            'name' => 'required|min:3|unique:categories,name,'. $id,
            'slug' => 'required|min:3|unique:categories,slug,' . $id,
            
        ], [
            'name.required' => "Category Name is required",
            'slug.required' => "Category Slug is required"
        ])->validate();
    }

}
