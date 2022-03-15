<?php

namespace App\Http\Controllers;

use App\Models\MainPage;
use App\Models\MainPageTranslate;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = MainPage::first();
        if($data == ''){
            $new_data = [];
            $new_data['id'] = '';
            $new_data['video_link'] = '';
            return $new_data;
        }else{
            return $data;
        }
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
           
            // if(isset($request->main_page_id) && $request->main_page_id != ''){
            //     $main_page = MainPage::findOrFail($request->main_page_id);
            // }else {
            //     $main_page = new MainPage();
            // }
            // if(isset($request->video_link) && $request->video_link != ''){
            //     $main_page->video_link = $request->video_link;
            // }
            $main_page = new MainPage();
            if(isset($request->video_link) && $request->video_link != ''){
                $main_page->video_link = $request->video_link;
            }
            $main_page->save();

            // $translate = new MainPageTranslate();
            // $translate->fill($request->all());
            // $translate->main_page_id = $main_page->id;
            // $translate->save();

            return response()->json(['msg'=> 'Main Page create successfully.']);
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
        //
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
           
            // if(isset($request->main_page_id) && $request->main_page_id != ''){
            //     $main_page = MainPage::findOrFail($request->main_page_id);
            // }else {
            //     $main_page = new MainPage();
            // }
            // if(isset($request->video_link) && $request->video_link != ''){
            //     $main_page->video_link = $request->video_link;
            // }
            // $main_page->save();

            // $translate = MainPageTranslate::findOrFail($id);
            // $translate->fill($request->all());
            // $translate->main_page_id = $main_page->id;
            // $translate->save();

            $main_page = MainPage::findOrFail($id);
            if(isset($request->video_link) && $request->video_link != ''){
                $main_page->video_link = $request->video_link;
            }
            $main_page->save();

            return response()->json(['msg'=> 'Main Page updated successfully.']);
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
