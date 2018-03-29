<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Admin as User;
use App\AdminPages;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\AdminUserEditRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
     public $slug = 'users';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
        if(\Auth::guard('admin')->user()->role==2 && !\Auth::guard('admin')->user()->checkPer($this->slug)){
            //die;
          return redirect()->to('admin/dashboard');
        }
         return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
         if(\Auth::guard('admin')->user()->role==2 && !\Auth::guard('admin')->user()->checkPer($this->slug)){
            //die;
          return redirect()->to('admin/dashboard');
        }
         return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        //
        $user               =   new User;
        $user->email        =   $request->email;
        $user->first_name   =   $request->first_name;
        $user->last_name    =   $request->last_name;
        $user->job_title    =   $request->job_title;
        $user->status       =   $request->status;
        $user->role         =   2;
        $user->added_by     =   Auth::guard('admin')->user()->id;
        $user->mobile       =   $request->mobile;
        $user->notes        =   $request->notes;
        if($request->password!=''){
            $user->password     = bcrypt($request->password);   
        }
        $user->save();

        foreach ($request->permissions as $key => $value) {
            # code...
            $adminPages     =       new AdminPages;

            $adminPages->permission_id      =   $value;

            $adminPages->user_id            =   $user->id;

            $adminPages->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

         if(\Auth::guard('admin')->user()->role==2 && !\Auth::guard('admin')->user()->checkPer($this->slug)){
            //die;
          return redirect()->to('admin/dashboard');
        }
         return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserEditRequest $request, User $user)
    {
        //

        $user->email        =   $request->email;
        $user->first_name   =   $request->first_name;
        $user->last_name    =   $request->last_name;
        $user->job_title    =   $request->job_title;
        $user->status       =   $request->status;
        $user->role         =   2;
        $user->added_by     =   Auth::guard('admin')->user()->id;
        $user->mobile       =   $request->mobile;
        $user->notes        =   $request->notes;
        
        if($request->password!=''){

            $user->password     = bcrypt($request->password);  

        }
        $user->save();
        $admideleteperminssion      =   AdminPages::where('user_id',$user->id)->delete();
        foreach ($request->permissions as $key => $value) {
            # code...
            $adminPages     =       new AdminPages;

            $adminPages->permission_id      =   $value;

            $adminPages->user_id            =   $user->id;

            $adminPages->save();
        }
        return redirect()->back();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->userPages()->delete();
        $user->delete();
    }
    public function ajaxLoad(){

        $records    =   array();

        $admins     =   User::where('role',2)->get();

        $i          =   0;

        foreach ($admins as $admin) {

            // Define action variable for language actions
            $action      =  '';

            // Edit action button
            $action     .=  "<a href='".url("admin/users/$admin->id/edit")."' class='btn btn-info'><i class='fa fa-eye'></i></a> ";

             $action     .=  " <a href='".route("users.destroy",['id'=>$admin->id])."' data-method='delete' class='btn btn-danger delete_user' value='".$admin->id."'><i class='fa  fa-times'></i></a>";
            
            $records[$i]['first_name']      =       $admin->first_name;

            $records[$i]['last_name']       =       $admin->last_name;

            $records[$i]['mobile']          =       $admin->mobile;

            $records[$i]['job_title']       =       $admin->job_title;

            $records[$i]['date_added']      =       $admin->created_at->format('d-m-Y');

            $records[$i]['added_by']        =       $admin->parentUser->first_name.' '.$admin->parentUser->last_name;

            $records[$i]['status']          =       $admin->userStatus->name;

            $records[$i]['action']          =       $action;
            $i++;

        }
        $columns    =   array( 
                            array('data'=>'first_name'),
                            array('data'=>'last_name'),
                            array('data'=>'job_title'),
                            array('data'=>'mobile'),
                            array('data'=>'date_added'),
                            array('data'=>'added_by'),
                            array('data'=>'status'),
                            array('data'=>'action'),
                        );
        return \Response::json(compact('records','columns'));

    }
}
