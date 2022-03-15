<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactsTranslate;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       return Contact::first();
        
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
           
            if(isset($request->id) && $request->id != ''){
                $contact = Contact::findOrFail($request->id);

            }else {
                $contact = new Contact();
            }
            $contact->fill($request->all());
            $contact->save();
            return response()->json(['msg'=> 'Contact create successfully.']);
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
        return Contact::findOrFail($id);
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
           
            if(isset($request->id) && $request->id != ''){
                $contact = Contact::findOrFail($request->id);

            }else {
                $contact = new Contact();
            }
            $contact->fill($request->all());
            $contact->save();

            return response()->json(['msg'=> 'Contact updated successfully.']);
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
            $contact = Contact::findOrFail($id);
            $contact->delete();

            return response()->json(['msg'=> 'Contact has been deleted successfully.']);
        }
    }
}
