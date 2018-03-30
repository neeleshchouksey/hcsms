<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('site.service');
    }
    public function event()
    {
        //
        
        return view('site.event');
    }
    public function pricing()
    {
        //
        
        return view('site.pricing');
    }
}
