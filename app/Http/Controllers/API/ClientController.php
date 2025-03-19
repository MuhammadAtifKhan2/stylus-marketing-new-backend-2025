<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $clientData = $request->all();

        $rules = [
            'name'=>'required',
        ]

        if($request->hasFile('logo'))
        {
            $rules['logo'] = 'image|mimes:jpeg,jpg,png,svg';
        }

        $validator = Validator::make($clientData,$rules);

        if($validator->fails())
        {
            return response()->json(['status'=>false,'errors'=>$validator->errors()]);
        }

        if($request->hasFile('logo'))
        {
            $fileName = time().$request->logo->extension();
            $request->logo->move(public_path('images'),$fileName);
            $clienData['logo'] = $fileName;    
        }

        $client = Client::create($clientData);

        return response()->json(['success'=>true,'result'=>$result]);
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
        $clientData = $request->all();

        $rules = [
            'name'=>'required',
        ]

        if($request->hasFile('logo'))
        {
            $rules['logo'] = 'image|mimes:jpeg,jpg,png,svg';
        }

        $validator = Validator::make($clientData,$rules);

        if($validator->fails())
        {
            return response()->json(['status'=>false,'errors'=>$validator->errors()]);
        }

        if($request->hasFile('logo'))
        {
            $fileName = time().$request->logo->extension();
            $request->logo->move(public_path('images'),$fileName);
            $clienData['logo'] = $fileName;    
        }        

        $client = Client::find($id)->update($clientData);

        return response()->json(['success'=>true,'result'=>$result]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
