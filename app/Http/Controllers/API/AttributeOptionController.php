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
        $attributeData = $request->all();
        $rules = [
            'name'=>[
                'required',
                Rule::unique('attribute_options')->where(function ($query) use ($attributeData) {
                    return $query->where('attribute_id', $attributeData['attribute_id']);
                })
            ],
            // 'attribute_id'=>['required']
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }



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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
