<?php

namespace App\Http\Controllers;

use App\Flyer;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Controller;



class FlyersController extends Controller
{

    //use AuthorizesUsers;

    public function __construct()
    {

        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();

    }
     

    public function create()
    {
        //flash()->overlay('Welcome Aboad', 'Thank you for signing up.');
    	return view('flyers.create');

    }

    /**
    *@param Request $request
    *@return Response
    **/

    public function store(FlyerRequest  $request)
    { 
        

        $flyer = $this->user->publish(

            new Flyer($request->all())

            );

        flash()->success('Success!', 'Your flyer has been created.');

        return redirect(flyer_path($flyer));
    }

    /**
    *
    *@param int $id
    *@param Response   
    */

    public function show($zip, $street)
    {

        $flyer = Flyer::locatedAt($zip, $street);
        
        return view('flyers.show', compact('flyer'));

    }    

}


