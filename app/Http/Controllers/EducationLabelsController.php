<?php

namespace App\Http\Controllers;

use App\Models\EducationLabel;
use App\Models\EducationLabelTranslate;
use Illuminate\Http\Request;

class EducationLabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return EducationLabelTranslate::where('lang_id', $request->lang_id)->with('education_label')->get();
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
           
            if(isset($request->edu_label_id) && $request->edu_label_id != ''){
                $services = EducationLabel::findOrFail($request->edu_label_id);
                $services_json = json_decode( $request->education_label, true);
                $services->edu_sub_services_id = $services_json['edu_sub_services_id'];
            }else {
                $services = new EducationLabel();
                $services_json = json_decode( $request->education_label, true);
                $services->edu_sub_services_id = $services_json['edu_sub_services_id'];
            }
            $services->save();

            $translate = new EducationLabelTranslate();
            $translate->fill($request->all());
            $translate->edu_label_id = $services->id;
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
        $data = EducationLabelTranslate::where('edu_label_id', $id)->where('lang_id', $request->lang_id)->with('education_label')->first();
        if(isset($data)){
            return $data;
        }else{
            $new_data = [];
            $new_data['id'] = '';
            $new_data['lang_id'] = $request->lang_id;
            $new_data['edu_label_id'] = $id;
            $new_data['title'] = '';
            $new_data['education_label'] = EducationLabel::findOrFail($id);

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
           
            if(isset($request->edu_label_id) && $request->edu_label_id != ''){
                $services = EducationLabel::findOrFail($request->edu_label_id);
                $services_json = json_decode( $request->education_label, true);
                $services->edu_sub_services_id = $services_json['edu_sub_services_id'];
            }else {
                $services = new EducationLabel();
                $services_json = json_decode( $request->education_label, true);
                $services->edu_sub_services_id = $services_json['edu_sub_services_id'];
            }
            $services->save();

            $translate = EducationLabelTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->edu_label_id = $services->id;
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
            $services = EducationLabel::findOrFail($id);
            $services->delete();

            return response()->json(['msg'=> 'Services has been deleted successfully.']);
        }
    }
}
