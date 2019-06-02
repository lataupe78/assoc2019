<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
	public function index(Section $section){
		$subscriptions = Subscription::published()
		//->active()
		->forSection($section)
		->get();

		//dd($subscriptions);

		return view('front.subscriptions.index', [
			'section' => $section,
			'subscriptions' => $subscriptions,
		]);

	}
}
