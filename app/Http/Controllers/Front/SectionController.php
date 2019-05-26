<?php

namespace App\Http\Controllers\Front;

use App\Models\Section;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function show(Section $section)
    {
        return view('front.sections.show', [
            'section' => $section,
        ]);
    }
}
