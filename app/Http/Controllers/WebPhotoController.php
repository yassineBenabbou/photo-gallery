<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;


class WebPhotoController extends Controller
{

    public function show(Photo $photo) {
    	$comments = $photo->comments;
    	return view('photo', compact('photo', 'comments'));
    }
}
