<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutTranslate;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return AboutTranslate::where('lang_id', $request->lang_id)->first();
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
            // if(isset($request->about_id) && $request->about_id != ''){
            //     $about = About::findOrFail($request->about_id);
            // }else {
            //     $about = new About();
            //     $about->save();
            // }
            

            $translate = new AboutTranslate();

            $translate->fill($request->all());
            $translate->about_id = '1';
            $translate->save();
            return response()->json(['msg' => 'About Create Successfully']);
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
        $data = AboutTranslate::where('about_id', $id)->where('lang_id', $request->lang_id)->first();
        if($data){
            return $data;
        }else{
            $new_data = [];
            $new_data['about_id'] = $id;
            $new_data['lang_id'] = $request->lang_id;
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
           
            $translate =  AboutTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->about_id = '1';
            $translate->save();
            return response()->json(['msg' => 'About Updated Successfully']);

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
        //
    }
}
