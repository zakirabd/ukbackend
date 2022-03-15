<?php

namespace App\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Models\Services;
use App\Models\ServicesTranslate;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ServicesTranslate::where('lang_id', $request->lang_id)->with('service')->get();
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
           
            if(isset($request->services_id) && $request->services_id != ''){
                $services = Services::findOrFail($request->services_id);
            }else {
                $services = new Services();
            }
            if ($request->hasFile('image')) {
                $services->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }else{
                $services->image = 'image';
            }
            $services->save();

            $translate = new ServicesTranslate();
            $translate->fill($request->all());
            $translate->services_id = $services->id;
            $translate->save();

            return response()->json(['msg'=> 'Services create successfully.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = ServicesTranslate::where('services_id', $id)->where('lang_id', $request->lang_id)->with('service')->first();
        if(isset($data)){
            return $data;
        }else{
            $new_data = [];
            $new_data['id'] = '';
            $new_data['lang_id'] = $request->lang_id;
            $new_data['services_id'] = $id;
            $new_data['title'] = '';
            $new_data['description'] = '';
            // $new_data['news'] = News::findOrFail($id);

            return $new_data;
        }
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
           
            if(isset($request->services_id) && $request->services_id != ''){
                $services = Services::findOrFail($request->services_id);
            }else {
                $services = new Services();
            }
            if ($request->hasFile('image')) {
                $services->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }else{
                $services->image = 'image';
            }
            $services->save();

            $translate = ServicesTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->services_id = $services->id;
            $translate->save();

            return response()->json(['msg'=> 'Services create successfully.']);
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
            $services = Services::findOrFail($id);
            $services->delete();

            return response()->json(['msg'=> 'Services has been deleted successfully.']);
        }
    }
}
