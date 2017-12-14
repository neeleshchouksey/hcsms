<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $language           =   new Language;
        $language->title    =   $request->title;
        $language->user_id  =   \Auth::guard('admin')->user()->id;
        $language->save();
        return redirect(route('languages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
        return view('admin.languages.edit',compact('language'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        //
        $language->title    =   $request->title;
        
        $language->save();

        return redirect(route('languages.index'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        //
        $language->delete();
    }
    public function ajaxLoad(){

        // Define empty array for records
        $records     =   array();

        // Fetch all languages from database
        $languages  =   Language::all();

        // Intialize varible
        $i          =   0;

        foreach ($languages as $language) {

            // Define action variable for language actions
            $action      =  '';

            // Edit action button
            $action     .=  "<a href='".url("admin/languages/$language->id/edit")."' class='btn btn-info'><i class='fa fa-eye'></i></a> ";

            //Delete action button
            $action     .=  " <a href='".route("languages.destroy",['id'=>$language->id])."' data-method='delete' class='btn btn-danger delete_language' value='".$language->id."'><i class='fa  fa-trash'></i></a>";
                       
            // Language title
            $records[$i]['title']    =      $language->title;
            
            // Number of patients under in language
            $records[$i]['nop']      =      0;

            // Blood pressure monitoring sms set for this language or not default is no
            $records[$i]['bpm']     =       '<a href="javascript:void(0)" class="setBpm">N</a>';

            // Blood sugur Monitoring sms set for this language or not default is no
            $records[$i]['bsm']     =       'N';

            // Action to be performed for this language
            $records[$i]['action']  =       $action;
            $i++;
        }

        $columns = array( array('data'=>'title'),array('data'=>'nop'),array('data'=>'bpm'),array('data'=>'bsm'),array('data'=>'action'));
        return \Response::json(compact('records','columns'));
    }
}
