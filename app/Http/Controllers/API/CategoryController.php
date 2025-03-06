<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return response()->json(['message'=>'success','result'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $validator = Validator::make(['name'=>$request->name],['name'=>'required|unique:categories,name']);
        if($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }
        $category = Category::create($request->all());
        return response()->json(['message'=>'success','result'=>$category]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $rules = [
            "name"=>"required|unique,name,".$id
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json(['status'=>false,'errors'=>$validator->errors()]);
        }

        $category = Category::find($id)->update($request->all());

        return response()->json(['status'=>true,'result'=>$category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::find($id);
        $category->delete();

        return response()->json(['status'=>true,'message'=>'Category Deleted successfully']);
    }
}
