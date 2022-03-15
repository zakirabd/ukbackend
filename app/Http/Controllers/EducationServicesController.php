<?php

namespace App\Http\Controllers;

use App\Models\EducationLabelTranslate;
use App\Models\EducationServices;
use App\Models\EducationServicesTranslate;
use App\Models\EducationSubServicesTranslate;
use Illuminate\Http\Request;

class EducationServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return EducationServicesTranslate::where('lang_id', $request->lang_id)->with('education_services')->get();
    }


    public function getFullEducationServices(Request $request){
        $services = EducationServicesTranslate::where('lang_id', $request->lang_id)->with('education_services')->get();
        foreach($services as $service){

            $sub_services = EducationSubServicesTranslate::where('lang_id', $request->lang_id)
            ->whereHas('education_sub_services', function ($q) use ($service){
                $q->where('education_services_id', $service->education_services_id);
            })->get();

            if(isset($sub_services) && count($sub_services) != 0){
                $service->sub_services = $sub_services;

                foreach($sub_services as $sub_service){
                    $labels = EducationLabelTranslate::where('lang_id', $request->lang_id)
                    ->whereHas('education_label', function ($q) use ($sub_service){
                        $q->where('edu_sub_services_id', $sub_service->edu_sub_services_id);
                    })->get();

                    if(isset($labels) && count($labels) != 0){
                        $sub_service->labels = $labels;
                    }else{
                        $sub_service->labels = [];
                    }
                }
            }else {
                $service->sub_services = [];
            }
        }
        return $services;
        
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
           
            if(isset($request->education_services_id) && $request->education_services_id != ''){
                $services = EducationServices::findOrFail($request->education_services_id);
            }else {
                $services = new EducationServices();
            }
            $services->save();

            $translate = new EducationServicesTranslate();
            $translate->fill($request->all());
            $translate->education_services_id = $services->id;
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
        $data = EducationServicesTranslate::where('education_services_id', $id)->where('lang_id', $request->lang_id)->with('education_services')->first();
        if(isset($data)){
            return $data;
        }else{
            $new_data = [];
            $new_data['id'] = '';
            $new_data['lang_id'] = $request->lang_id;
            $new_data['education_services_id'] = $id;
            $new_data['title'] = '';
            $new_data['description'] = '';
           
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
           
            if(isset($request->education_services_id) && $request->education_services_id != ''){
                $services = EducationServices::findOrFail($request->education_services_id);
            }else {
                $services = new EducationServices();
            }
            $services->save();

            $translate = EducationServicesTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->education_services_id = $services->id;
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
            $services = EducationServices::findOrFail($id);
            $services->delete();

            return response()->json(['msg'=> 'Services has been deleted successfully.']);
        }
    }
}
