<?php

namespace App;
use Auth;
use Storage;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	protected $fillable = [
		'description', 'filename', 'section_id', 'directory'
	];
    
    public function comments() {
    	return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    public function section() {
    	return $this->belongsTo('App\Section');
    }

    public function addComment($body) {
    	
    	Comment::create([
    			'body' => $body,
    			'photo_id' => $this->id,
    			'user_id' => Auth::user()->id
    		]);
    }

    public function src($type = NULL) {
        $type .= $type ? '_' : '' ;
        return  Storage::url($this->directory . '/'. $type . $this->filename);
    }
}
