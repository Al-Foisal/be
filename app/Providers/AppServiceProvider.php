<?php

namespace App\Providers;

use App\Models\BannerCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\CompanyInfo;
use App\Models\FlashSale;
use App\Models\Page;
use App\Models\Size;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('company_infos')) {
            $company = CompanyInfo::find(1);
            view()->share('company', $company);

        };
        $categories = Category::where('status', 1)->with('subcategories', 'subcategories.childcategories')->get();
        view()->share('categories', $categories);

        $pages = Page::where('status', 1)->select(['id', 'title', 'slug'])->get();
        view()->share('pages', $pages);

        $banner_collection = BannerCollection::where('status', 1)->where('id', 1)->first();
        view()->share('banner_collection', $banner_collection);

        $flash_sale = FlashSale::where('id', 1)->first()->end;

// $now        = new DateTime();

// $futureDate = new DateTime($flash_sale);

// $interval = $futureDate->diff($now);

// echo $interval->format("%a,%h,%i");
        // echo $flash_sale->format('Y, m, d');
        $y = $flash_sale->format('Y');
        $m = $flash_sale->format('m');
        $d = $flash_sale->format('d');
        view()->share(['y' => $y, 'm' => $m, 'd' => $d, 'sale' => $flash_sale]);

        $sizes = Size::all();
        view()->share('sizes', $sizes);

        $colors = Color::all();
        view()->share('colors', $colors);

        $brands = Brand::all();
        view()->share('brands', $brands);

        //taking fixed grocery link
        $grocery = Category::find(14);
        view()->share('grocery', $grocery);
        
        Paginator::useBootstrap();
    }
}
