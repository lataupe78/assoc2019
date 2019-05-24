<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    	app('view')->composer([
    		'layouts.front',
    	],
    	"App\Http\ViewComposers\SectionListViewComposer"
    );
    }
}
