<?php

namespace App\Http\Controllers;

use App\Staff;
use Mail;
use App\Mail\WelcomeMailStaff;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\StaffEditRequest;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         return view('staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        //
        $staff                  =       New Staff;
        $staff->title           =       $request->title;
        $staff->first_name      =       $request->first_name;
        $staff->last_name       =       $request->last_name;
        $staff->job_title       =       $request->job_title;
        $staff->email           =       $request->email;
        $staff->password        =       bcrypt($request->password);
        $staff->mobile          =       $request->mobile;
        $staff->landline        =       $request->landline;
        $staff->user_id         =       Auth::user()->id;
        $staff->status          =       $request->status;

        $staff->permission      =       implode(',', $request->permission);
        $staff->save();
        Mail::to($request->email)->send(new WelcomeMailStaff($staff));
        return redirect(route('staff.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
        return view('staff.edit',compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(StaffEditRequest $request, Staff $staff)
    {
        //
        $staff->title           =       $request->title;
        $staff->first_name      =       $request->first_name;
        $staff->last_name       =       $request->last_name;
        $staff->job_title       =       $request->job_title;
        $staff->email           =       $request->email;
        $staff->password        =       bcrypt($request->password);
        $staff->mobile          =       $request->mobile;
        $staff->landline        =       $request->landline;
        $staff->user_id         =       Auth::user()->id;
        $staff->status          =       $request->status;

        $staff->permission      =       implode(',', $request->permission);
        $staff->save();
        return redirect(route('staff.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
        $staff->delete();
    }
    public function ajaxLoad(){
        $staffs     =   Staff::where('user_id',\Auth::user()->id)->get();
        $records    =   array();
        $i          =   0;

        foreach ($staffs as $key => $value) {
          //print_r(expression)
          # code...
            $editBtn    =   "<a href='".url("staff/$value->id/edit")."' class='btn btn-info'>Edit</a> ";
            $delteBtn   =   "<a href='".route("staff.destroy",['id'=>$value->id])."' data-method='delete' class='btn btn-danger delete_staff' value='".$value->id."'>Delete</a>";

           
            $records[$i]['title']       =   $value->title;
            $records[$i]['first']       =   $value->first_name;
            $records[$i]['last']        =   $value->last_name;
            $records[$i]['job']         =   $value->job_title;
            $records[$i]['action']      =   $editBtn." ".$delteBtn;
            $i++;
        }

        echo json_encode($records);
        die;
    }

}
