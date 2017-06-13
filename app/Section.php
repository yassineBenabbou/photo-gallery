<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	protected $fillable = [
		'title', 'slug'
	];

	public static $folder = 'public/photos';

    public function photos() {
    	return $this->hasMany('App\Photo');
    }

    public function thumbnails($nbr = NULL) {
        if ($nbr && $this->photos->count() < $nbr) $nbr = $this->photos->count();
        return $nbr ? $this->photos->random($nbr) : $this->photos->random();
    }

    public function notEmtpy() {
        return $this->photos->count();
    }
}
