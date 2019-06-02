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

	public function show(Section $section, Subscription $subscription){
		if($subscription->is_active){
			return redirect()->route('subscriptions.index', ['section' => $section])
			->withErrors(__('Inactive subscription'));
		}

		return view('front.subscriptions.show', [
			'section' => $section,
			'subscription' => $subscription,
		]);



	}

}
