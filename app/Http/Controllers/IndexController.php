<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
    	$sections = Section::all();
    	return view('index', compact('sections'));
    }
}
