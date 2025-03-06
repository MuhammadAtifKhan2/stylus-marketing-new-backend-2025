<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Validation\Rule;
use Validator;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subCategories = SubCategory::all();
        return response()->json(['message'=>'success','result'=>$subCategories]);
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
        $data = $request->all();

        $rules = [
            'name'=>[
                'required',
                Rule::unique('sub_categories')->where(function ($query) use ($data) {
                    return $query->where('category_id', $data['category_id']);
                })
            ],
            'category_id'=>['required']
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }


        $subCategory = SubCategory::create($request->all());
        return response()->json(['message'=>'success','result'=>$subCategory]);
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
        //
        $rules = [
            "name"=>[
                "required",
                Rule::unique('sub_categories')->where(function($query) use ($data,$id){
                    $query->where('category_id',$data['category_id'])->where('id','!=',$id])
                })
            ]
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json(['status'=>false,'errors'=>$validator->errors()]);
        }

        $subCategory = SubCategory::find($id)->update($request->all());

        return response()->json(['status'=>true,'result'=>$subCategory]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subCategory = SubCategory::find($id);
        $subCategory->delete();

        return response()->json(['status'=>true,'message'=>'Sub Category Deleted Successfully']);
    }
}
