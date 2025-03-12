<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return response()->json(['success'=>true,'result'=>$products]);
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
        //
        $rules = [
            'name'=>'required',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'price'=>'required'
        ];

        if($request->images)
        {
            $rules['filenames'] = 'required';
            $rules['filenames.*'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }

        if($request->images)
        {
            $images = '';
            foreach($request->images as $image)
            {
                $fileName = time().rand(1,100).$image->extension();
                $image->move(public_path('uploads'),$fileName);
                $images.=$fileName;
            }
            $data['images'] = $images;
        }

        $product = Product::create($data);
        return response()->json(['success'=>true,'result'=>$product]);
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
            'name'=>'required',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'price'=>'required'
        ];

        if($request->images)
        {
            $rules['filenames'] = 'required';
            $rules['filenames.*'] = 'image';
        }

         $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }

         if($request->images)
        {
            $images = '';
            foreach($request->images as $image)
            {
                $fileName = time().rand(1,100).$image->extension();
                $image->move(public_path('uploads'),$fileName);
                $images.=$fileName;
            }
            $data['images'] = $images;
        }

        $product = Product::find($id)->update($data);
        return response()->json(['success'=>true,'result'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return response()->json(['success'=>true,'message'=>"Product Deleted Successfully"]);
    }
}
