<?php

namespace App\Forms;
use App\Thumbnail;
use App\Flyer;
use App\Photo;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class AddPhotoToFlyer {
	/**
	*
	* @var Flyer
	*/
	protected $flyer;

	/**
	*
	* @var UploadedFile instance.
	*/
	protected $file;

	protected $thumbnail;

	/**
	* Create a new AddPhotoToFlyer from object
	* 
	* @param Flyer          $flyer
	* @param UploadedFile   $file
	* @param Thumbnail|null $thumbnail
	*/
	public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
	{
		$this->flyer = $flyer;
		$this->file = $file;
		$this->thumbnail = $thumbnail ?: new Thumbnail;
	}


	/**
	* Process the form.
	*
	* @return void
	*/
	public function save()
	{
		//Attach the photo to the flyer
		$photo = $this->flyer->addPhoto($this->makephoto());
		$this->file->move($photo->baseDir(), $photo->name);
		$this->thumbnail->make($photo->path, $photo->thumbnail_path); 

		// Image::make($this->path)
  //           ->fit(200)
  //           ->save($this->thumbnail_path);

	}

	/**
	* Make a new photo instance.
	*
	* @return Photo
	*/
	protected function makePhoto()
	{
		return new Photo(['name' => $this->makeFileName()]);
	}

	/**
	* Make a file name, based on the uploaded file.
	* 
	* @return string
	*/
	protected function makeFileName()
	{

        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return $this->fileName = "{$name}.{$extension}";
    
	}
}