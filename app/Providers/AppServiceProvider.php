<?php

namespace App\Providers;

use App\Models\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::share('logo',"/img/logo/");
        $rulesList = Rule::select('id','title','slug')->get();
        View::share('rulesList',$rulesList);
        $menu=Rule::orderBy('rule_no','asc')->with(['sections'=>function($q){
             $q->orderBy('section_no','asc');
        }])->get();
        // dd($menu);
        View::share('menu',$menu);
    }
}
