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
        if($language->status==1)
            $language->status   =   2;
        else
            $language->status   =   1;
        $language->save();
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

            if($language->status==1)
            //deactive action button
                $action     .=  " <a href='".route("languages.destroy",['id'=>$language->id])."' data-method='get' class='btn btn-danger delete_language' value='".$language->id."'><i class='fa  fa-times'></i></a>";
            else
                $action     .=  " <a href='".route("languages.destroy",['id'=>$language->id])."' data-method='get' class='btn btn-success delete_language' value='".$language->id."'><i class='fa  fa-check'></i></a>";              
            // Language title
            $records[$i]['title']    =      $language->title;
            

            // Number of patients under in language
            $records[$i]['nop']      =      $language->patients()->count();

            // Get all services
            $service = \App\Service::all();

            // Genereting columns for display values
            foreach ($service as $key => $value) {

                $smsType            =       $value->smsTypes->count();

                $percentage         =       0;
                
                $smsTypesMessage    =       $value->smsTypes()->whereHas('languageMessage',function($q) use($language){ $q->where('language_id',$language->id);})->count();   

                if(!empty($value->smsTypes) && $smsTypesMessage!=0):

                    $smsType        =       $value->smsTypes->count();
                    
                    $percentage     =       round(($smsTypesMessage/$smsType)*100,2);

                endif;

                $records[$i][$value->data]      =     "<a href='javascript:void(0);' class='setSmsMessage' data-language='$language->id' data-service='$value->id'>$percentage%</a>";

            }     

            // // Blood pressure monitoring sms set for this language or not default is no
            // $records[$i]['bpm']     =       '<a href="javascript:void(0)" class="setBpm">N</a>';

            // // Blood sugur Monitoring sms set for this language or not default is no
            // $records[$i]['bsm']     =       'N';

            // Action to be performed for this language
            $records[$i]['action']  =       $action;

            $i++;
        }

        $columns = array( array('data'=>'title'),array('data'=>'nop'));
        $service = \App\Service::all();
        foreach ($service as $key => $value) {
            # code...
            array_push($columns, array('data'=>$value->data));
        }
        array_push($columns, array('data'=>'action'));
       // $columns = array('title','nop','bpm','bsm','action');
        return \Response::json(compact('records','columns'));
    }
}
