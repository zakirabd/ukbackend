<?php

namespace App\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Models\News;
use App\Models\NewsTranslate;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return NewsTranslate::where('lang_id', $request->lang_id)->with('news')->get();
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
           
            if(isset($request->news_id) && $request->news_id != ''){
                $news = News::findOrFail($request->news_id);
            }else {
                $news = new News();
            }
            if ($request->hasFile('image')) {
                $news->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }
            $news->save();

            $translate = new NewsTranslate();
            $translate->fill($request->all());
            $translate->news_id = $news->id;
            $translate->save();

            return response()->json(['msg'=> 'News create successfully.']);
        }
    }
    public function getNewsData(Request $request, $id){
        return NewsTranslate::where('news_id', $id)->where('lang_id', $request->lang_id)->with('news')->first();
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = NewsTranslate::where('news_id', $id)->where('lang_id', $request->lang_id)->with('news')->first();
        if(isset($data)){
            return $data;
        }else{
            $new_data = [];
            $new_data['id'] = '';
            $new_data['lang_id'] = $request->lang_id;
            $new_data['news_id'] = $id;
            $new_data['title'] = '';
            $new_data['description'] = '';
            $new_data['label'] = '';
            $new_data['news'] = News::findOrFail($id);

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
          
            if(isset($request->news_id) && $request->news_id != ''){
                $news = News::findOrFail($request->news_id);
            }else {
                $news = new News();
            }
            if ($request->hasFile('image')) {
                $news->image = UploadHelper::imageUpload($request->file('image'), 'uploads');
            }
            $news->save();

            $translate = NewsTranslate::findOrFail($id);
            $translate->fill($request->all());
            $translate->news_id = $news->id;
            $translate->save();

            return response()->json(['msg'=> 'News create successfully.']);
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
            $news = News::findOrFail($id);
            $news->delete();

            return response()->json(['msg'=> 'News has been deleted successfully.']);
        }
    }
}
