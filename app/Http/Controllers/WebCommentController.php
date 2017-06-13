<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Photo;
use Auth;


use Illuminate\Http\Request;

class WebCommentController extends Controller
{

	public function __construct() {
		$this->middleware('auth')->except('index', 'ajaxComments');
	}

	public function index(Photo $photo) {
		$comments = $photo->comments;
		return view('comments', compact('comments', 'photo'));
	}

    public function ajaxComments(Photo $photo) {
        $comments = $photo->comments;
        return view('ajaxComments', compact('comments'));
    }

    public function store(Photo $photo) {

    	$this->validate(request(), ['body' => 'required|min:2']);
    	$photo->addComment(request('body'));

    	return back();
    }

    public function destroy(Comment $comment) {

        if(Auth::user()->id == $comment->user_id) {
            $comment->delete();
            return back();
        }
        else
            return route('restricted');
    }



}
