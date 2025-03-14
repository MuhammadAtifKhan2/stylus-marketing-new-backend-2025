<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Validator;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $attributes = Attribute::all();
        return response()->json(['success'=>true,'result'=>$attributes]);
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
        $validator = Validator::make($request->all(),['name'=>'required']);
        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }
        $attribute = Attribute::create($request->all());
        return response()->json(['success'=>true,'result'=>$attribute]);
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
        $validator = Validator::make($request->all(),['name'=>'required']);

        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }
        $attribute = Attribute::find($id)->update($request->all());
        return response()->json(['success'=>true,'result'=>$attribute]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $attribute = Attribute::find($id);
        $attribute->delete();

        return response()->json(['status'=>true,'message'=>'Attribute Deleted successfully']);
    }
}
