<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Service;
use Illuminate\Http\Request;
use App\PatientService;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\PatientEditRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        //
        $patient                =       new Patient;
        $patient->code          =       "HCS".rand();
        $patient->ref_code      =       $request->code;
        $patient->mobile        =       $request->mobile;
        $patient->name          =       $request->name;
        $patient->language_id   =       $request->language;
        $patient->note          =       $request->note;
        $patient->user_id       =       \Auth::user()->id;
        $patient->agree         =       $request->agree;
        $patient->save();
        return redirect(route('patient.edit',$patient->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patient.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientEditRequest $request, Patient $patient)
    {
        //
        
        $patient->ref_code      =       $request->code;
        $patient->mobile        =       $request->mobile;
        $patient->name          =       $request->name;
        $patient->language_id   =       $request->language;
        $patient->note          =       $request->note;
        $patient->user_id       =       \Auth::user()->id;
        $patient->agree         =       $request->agree;
        // $patient->services  =   implode(',', $request->service);
        $patient->save();
        return redirect(route('patient.edit',$patient->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
        $patient->delete();
    }
    public function ajaxLoad(){

        $patients    =   Patient::where('user_id',\Auth::user()->id)->get();
        $records     =   array();
        $i           =   0;

        foreach ($patients as $key => $value) {

            $services   =   Service::whereIn('id',explode(',',$value->services))->pluck('name')->toArray();
            $editBtn    =   "<a href='".url("patient/$value->id/edit")."' class='btn btn-info'>Edit</a> ";
            $delteBtn   =   "<a href='".route("patient.destroy",['id'=>$value->id])."' data-method='delete' class='btn btn-danger delete_patient' value='".$value->id."'>Delete</a>";

           
            $records[$i]['code']        =   $value->code;
            $records[$i]['mobile']      =   $value->mobile;
            $records[$i]['name']        =   $value->name;
            $records[$i]['update_at']   =   $value->updated_at->format('d-m-Y H:i:s');
            $records[$i]['action']      =   $editBtn." ".$delteBtn;
            $i++;
        }

        echo json_encode($records);
        die;
    }
}
