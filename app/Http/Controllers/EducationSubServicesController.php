<?php

namespace App\Http\Controllers;

use App\Models\EducationSubServices;
use App\Models\EducationSubServicesTranslate;
use Illuminate\Http\Request;

class EducationSubServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return EducationSubServicesTranslate::where('lang_id', $request->lang_id)->with('education_sub_services')->get();
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
           
            if(isset($request->edu_sub_services_id) && $request->edu_sub_services_id != ''){
                $services = EducationSubServices::findOrFail($request->edu_sub_services_id);
                $services_json = json_decode( $request->education_sub_services, true);
                $services->education_services_id = $services_json['education_services_id'];
            }else {
                $services = new EducationSubServices();
                $services_json = json_decode( $request->education_sub_services, true);
                $services->education_services_id = $services_json['education_services_id'];
            }
            $services->save();

            $translate = new EducationSubServicesTranslate();
            $translate->fill($request->all());
            $translate->edu_sub_services_id = $services->id;
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
        $data = EducationSubServicesTranslate::where('edu_sub_services_id', $id)->where('lang_id', $request->lang_id)->with('education_sub_services')->first();
        if(isset($data)){
            return $data;
        }else{
            $new_data = [];
            $new_data['id'] = '';
            $new_data['lang_id'] = $request->lang_id;
            $new_data['edu_sub_services_id'] = $id;
            $new_data['title'] = '';
            $new_data['education_sub_services'] = EducationSubServices::findOrFail($id);

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
           
            if(isset($request->edu_sub_services_id) && $request->edu_sub_services_id != ''){
                $services = EducationSubServices::findOrFail($request->edu_sub_services_id);
                $services_json = json_decode( $request->education_sub_services, true);
                $services->education_services_id = $services_json['education_services_id'];
            }else {
                $services = new EducationSubServices();
                $services_json = json_decode( $request->education_sub_services, true);
                $services->education_services_id = $services_json['education_services_id'];
            }
            $services->save();

            $translate = EducationSubServicesTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->edu_sub_services_id = $services->id;
            $translate->save();

            return response()->json(['msg'=> 'Services updated successfully.']);
          
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
            $services = EducationSubServices::findOrFail($id);
            $services->delete();

            return response()->json(['msg'=> 'Services has been deleted successfully.']);
        }
    }
}
