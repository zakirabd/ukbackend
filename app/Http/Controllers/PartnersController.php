<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Models\Partners;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Partners::orderBy('id', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->role == 'admin'){
            $partners = new Partners();
            if ($request->hasFile('image')) {
                $partners->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }
            $partners->save();
            return response()->json(['msg' => "Partners addedd successfully"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Partners::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->role == 'admin'){
            $partners = Partners::findOrFail($id);
            if ($request->hasFile('image')) {
                $partners->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }
            $partners->save();
            return response()->json(['msg' => "Partners Update successfully"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role == 'admin'){
            $partners = Partners::findOrFail($id);
            
            $partners->delete();
            return response()->json(['msg' => "Partners has been deleted successfully"]);
        }
    }
}
