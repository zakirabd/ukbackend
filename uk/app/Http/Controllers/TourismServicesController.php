<?php

namespace App\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Models\TourismServices;
use App\Models\TourismServicesInformation;
use App\Models\TourismServicesTranslate;
use Illuminate\Http\Request;

class TourismServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return TourismServicesTranslate::where('lang_id', $request->lang_id)->with('tourism_services')->get();
        
    }
    public function addUserTourismServices(Request $request){
        $services = new TourismServicesInformation();
        $services->fill($request->all());

        
        $services->save();
        if($request->services && $request->services !== ''){
            $services->tourism_user_services()->attach(explode(',', $request->services));
        }

        return response()->json(['msg' => '1']);
        // 
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
           
            if(isset($request->tourism_services_id) && $request->tourism_services_id != ''){
                $services = TourismServices::findOrFail($request->tourism_services_id);
            }else {
                $services = new TourismServices();
            }
            $services->save();

            $translate = new TourismServicesTranslate();
            $translate->fill($request->all());
            $translate->tourism_services_id = $services->id;
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
        $data = TourismServicesTranslate::where('tourism_services_id', $id)->where('lang_id', $request->lang_id)->with('tourism_services')->first();
        if(isset($data)){
            return $data;
        }else{
            $new_data = [];
            $new_data['id'] = '';
            $new_data['lang_id'] = $request->lang_id;
            $new_data['tourism_services_id'] = $id;
            $new_data['name'] = '';
           
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
           
            if(isset($request->tourism_services_id) && $request->tourism_services_id != ''){
                $services = TourismServices::findOrFail($request->tourism_services_id);
            }else {
                $services = new TourismServices();
            }
                // if ($request->hasFile('image')) {
                //     $services->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
                // }else{
                //     $services->image = 'image';
                // }
            $services->save();

            $translate = TourismServicesTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->tourism_services_id = $services->id;
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
            $services = TourismServices::findOrFail($id);
            $services->delete();

            return response()->json(['msg'=> 'Services has been deleted successfully.']);
        }
    }
}
