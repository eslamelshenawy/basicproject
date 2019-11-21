<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{



    
    /**
      * Get page dashboard  
      *   
      * @param  array  $data
      * @return  view index
      */
      protected function index()
      {
           return view('dashboard.home.index');
      }



}
