<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Photo;
use Jenssegers\Agent\Agent;

class WebSectionController extends Controller
{
    public function show($slug) {

    	$agent = new Agent();

    	$section = Section::where('slug', $slug)->first();
    	$photos = $section->photos; 	

    	return view('section', compact('section', 'photos', 'agent'));
    }
}
