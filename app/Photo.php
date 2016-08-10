<?php

namespace App;

use File;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\file\UploadedFile;


class Photo extends Model
{
	/**
    * The associated table
    *
    * @var string
    */

    protected $table = 'flyer_photos';

    /**
    * Fillable fields for a photo.
    *
    * @var array
    */

	protected $fillable = ['name','path', 'thumbnail_path'];
               	
	public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->path = $this->baseDir() .'/'. $name;
        $this->thumbnail_path = $this->baseDir() .'/tn-'. $name;
    }    

    /**
    * A photo belongs to a flyer.
    *
    * @return \Illumiante\Database\Eloquent\Relations\BelongsTo
    */

    public function flyer()
    {
    	return $this->belongsTo('App\Flyer');
    }   

    /**
    * Get the base directory for photo uploads.
    *    
    * @return string
    */

    public function baseDir()
    {
        return 'flyer/photos';
    }

    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
            ]);
        
        parent::delete();
    }

} 
