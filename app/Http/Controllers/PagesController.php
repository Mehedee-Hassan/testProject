<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {
	public $a = 10;
	
	public function about(){
		// return 'about page';

		$name = "Mehedee <span style=\'color:red\'>Hassan</span>";

		return view('pages.about')->with('name',$name);
	}



	

	public function contact(){

		// $names = ['mehedee','raif','hafsa'];
		$names = [];

		return view('pages.contact')->with('names',$names);


	}


}
