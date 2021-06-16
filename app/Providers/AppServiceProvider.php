<?php

namespace App\Providers;

use App\Models\Categories;
use App\Models\Province;
use Illuminate\Support\ServiceProvider;
use Spatie\Analytics\Period;
use Spatie\Analytics\AnalyticsFacade as Analytics;
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
        $data['categories'] = Categories::all();
        $data['analyticsData'] = Analytics::fetchVisitorsAndPageViews(Period::days(1));
        view()->share($data);
    }
}
