<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeOption;
use Validator;
use Illuminate\Validation\Rule;

class AttributeOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $attributeOptions = AttributeOption::all();
        return response()->json(['success'=>true,'result'=>$attributeOptions]);
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
            'name'=>[
                'required',
                Rule::unique('attribute_options')->where(function ($query) use ($data) {
                    return $query->where('attribute_id', $data['category_id']);
                })
            ],
            'attribute_id'=>['required']
        ];

        if($request->image)
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';
        }

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }

        if($request->image)
        {
            $imageName = time().$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }


        $attributeOption = AttributeOption::create($data);

        return response()->json(['success'=>true,'result'=>$attributeOption]);


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
        $data = $request->all();
        $rules = [
            'name'=>[
                'required',
                Rule::unique('attribute_options')->where(function ($query) use ($data,$id) {
                    return $query->where('attribute_id', $data['category_id'])->where('id','!=',$id);
                })
            ],
            'attribute_id'=>['required']
        ];

        if($request->image)
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';
        }

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }

        if($request->image)
        {
            $imageName = time().$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

         $attributeOption = AttributeOption::find($id);
         $attributeOption->update($data);

        return response()->json(['success'=>true,'result'=>$attributeOption]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $attributeOption = AttributeOption::find($id);
        $attributeOption->delete();

        return response()->json(['success'=>true,'message'=>'Attribute option deleted successfully']);
    }
}
