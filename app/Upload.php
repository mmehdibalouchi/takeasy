<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    
	protected $fillable = ['uploadable_type', 'uploadable_id', 'type', 'filename', 'mime', 'original_filename'];

    public function uploadable()
    {
    	return $this->morphTo();
    }

}
