<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('site.gallery');
    }
    public function gallery2()
    {
        //
        
        return view('site.gallery-2');
    }
    public function gallery3()
    {
        //
        
        return view('site.gallery-3');
    }
}
