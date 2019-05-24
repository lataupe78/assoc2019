<?php
namespace App\Http\ViewComposers;


use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class SectionListViewComposer {

	public function compose(View $view) {

		$list_sections = Cache::rememberForever('list_sections', function () {
			return Section::active()->parent()->get(['title', 'slug', 'id']);
		});

		$view->with('list_sections', $list_sections);
	}
}
