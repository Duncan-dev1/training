<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title='welcome to my awesome page';
        return view('pages.index')->with('title',$title);
    }
   
    public function services(){
        $data=array(
            'title'=>'services',
            'services'=>['web design','programming','SEO']);
        return view('pages.services')->with($data);

        
    }
    public function about(){
        $title='It is all about me';
        return view('pages.about')->with('title',$title);
    }
}
