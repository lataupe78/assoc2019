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
        // Récupère le controller et l'action de la route en cours
    	app('view')->composer([
    		'layouts.front',
    		'layouts.admin'
    	], function ($view) {
    		$controller = $action = '';

    		$getAction = app('request')->route()->getAction();
            //dd($action);
    		if(isset($getAction['controller'])){
    			$controller = class_basename($getAction['controller']);
    			list($controller, $action) = explode('@', $controller);
    		}

    		$parameters = app('request')->route()->parameters();
    		$view->with(compact('controller', 'action', 'parameters'));
    	});


        // récupère la liste des sections parentes
    	view()->composer([
    		'layouts.front',
    	],
    	"App\Http\ViewComposers\SectionListViewComposer"
    );


        // récupère la liste des admins ( pour dev )
    	view()->composer(
    		"auth.login",
    		"App\Http\ViewComposers\ListAdminsViewComposer"
    	);
    }
}
