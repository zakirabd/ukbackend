<?php

namespace App\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Models\Teams;
use App\Models\TeamsTranslate;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return TeamsTranslate::where('lang_id', $request->lang_id)->with('teams')->get();
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
            if(isset($request->teams_id) && $request->teams_id != ''){
                $teams = Teams::findOrFail($request->teams_id);
            }else {
                $teams = new Teams();
            }
            if ($request->hasFile('image')) {
                $teams->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }
            $teams->save();

            $translate = new TeamsTranslate();
            $translate->fill($request->all());
            $translate->teams_id = $teams->id;
            $translate->save();

            return response()->json(['msg'=> 'Teams create successfully.']);
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
        $data = TeamsTranslate::where('teams_id', $id)->where('lang_id', $request->lang_id)->with('teams')->first();
        if(isset($data)){
            return $data;
        }else{
            $new_data = [];
            $new_data['id'] = '';
            $new_data['lang_id'] = $request->lang_id;
            $new_data['teams_id'] = $id;
            $new_data['name'] = '';
            $new_data['position'] = '';
            $new_data['teams'] = Teams::findOrFail($id);

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
            if(isset($request->teams_id) && $request->teams_id != ''){
                $teams = Teams::findOrFail($request->teams_id);
            }else {
                $teams = new Teams();
            }
            if ($request->hasFile('image')) {
                $teams->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }
            $teams->save();

            $translate = TeamsTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->teams_id = $teams->id;
            $translate->save();

            return response()->json(['msg'=> 'Teams updated successfully.']);
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
            $teams = Teams::findOrFail($id);
            $teams->delete();

            return response()->json(['msg'=> 'Teams has been deleted successfully.']);
        }
    }
}
