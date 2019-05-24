<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{


 	public function show(Section $section){
 		return view('front.sections.show', [
 			'section' => $section
 		]);
 	}
}
