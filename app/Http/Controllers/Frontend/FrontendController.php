<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BannerCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\Slider;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller {
    
    public function orderTrack(){
        return view('frontend.order-track')->with(['status'=>null,'first_header'=>true]);
    }
    
    public function orderTrackStore(Request $request){
        $data= [];
        $data['first_header'] = true;
        $order = Order::findOrFail($request->track);
        session()->flash('status',$order->order_status);
        return redirect()->route('order.track',$data);
    }
    public function index(Request $request) {
        $data                 = [];
        $data['first_header'] = true;
        $data['slider']       = Slider::where('type', 1)->get();
        $data['left_slider']  = Slider::where('type', 2)->get();
        $data['right_slider'] = Slider::where('type', 3)->get();

        $products      = Product::select(['id', 'name', 'slug', 'selling', 'discount', 'discount_price'])->with('images', 'ratingReviews')->paginate(20);
        $data['malls'] = Brand::where('mall', 1)->get();

        if ($request->ajax()) {
            $html = '';

            foreach ($products as $product) {
                $rating       = (DB::table('rating_reviews')->where('product_id', $product->id)->select('rating')->where('status', 1)->avg('rating')) * 20 ?? 0;
                $rating_count = $product->ratingReviews->where('status', 1)->count();
                $html .= '<div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="product-default">
                        <figure>';
                $html .= '<a href="' . route('productDetails', $product->slug) . '" style="height: 100%;width: 100%;">
                                <img src="' . $product->images->first()->image . '" class="product-image" alt="product">
                            </a>';

                if ($product->discount > 0) {
                    $html .= '<div class="label-group">';
                    $html .= '<div class="product-label label-sale">-';
                    $html .= $product->discount;
                    $html .= '%</div>
                                </div>';
                }

                $html .= '</figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <h3 class="product-title">
                                    <a href="' . route('productDetails', $product->slug) . '">' . $product->name . '</a>
                                </h3>';

                if ($product->discount > 0) {

                    $html .= '<h3 style="font-weight: 400;color: #ff0000;margin: 0;">৳' . number_format($product->discount_price, 2) . '</h3>
                                    <h6 style="color: #a7a9a7;font-weight: inherit; margin: 0;height: 20px;">
                                        <del>৳' . number_format($product->selling, 2) . '</del>
                                        -' . $product->discount . '%
                                    </h6>';
                } else {
                    $html .= '<h3 style="font-weight: 400;color: #ff0000;margin: 0;">৳' . number_format($product->selling, 2) . '</h3>';
                }

                $html .= '<!-- End .price-box -->
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings"
                                            style="width:' . $rating . '%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                        (' . $rating_count . ')
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                </div>';
            }

            return $html;
        }

        $data['subcategory'] = Subcategory::where('status', 1)->with('category')->limit(12)->orderBy('id', 'DESC')->get();
        $data['collections'] = ProductCollection::limit(8)->orderBy('id', 'DESC')->get();
        $data['low_price']   = Product::select(['id', 'name', 'slug', 'selling', 'discount', 'discount_price'])->where('discount', '>', 0)->where('status', 1)->where('low_price', 1)->limit(20)->orderBy('id', 'DESC')->get();
        $data['flash_sale']  = Product::select(['id', 'name', 'slug', 'selling', 'discount', 'discount_price'])->where('discount', '>', 0)->where('status', 1)->where('flash_sale', 1)->limit(20)->orderBy('id', 'DESC')->get();

        return view('frontend.index', $data);
    }

    public function categoryProduct($category, $sub = null, $child = null) {
        $data                  = [];
        $data['second_header'] = true;
        $data['is_shop']       = true;

        $data['category'] = $category = Category::where('slug', $category)->first();

        //category product
        $products = Product::with('images', 'ratingReviews')->where('status', 1)->where('category_id', $category->id);

//category and subcategory product
        if ($sub !== null) {
            $data['subcategory'] = $subcategory = Subcategory::where('slug', $sub)->first();
            $products            = $products->where('subcategory_id', $subcategory->id);
        }

//category, subcategory and childcategory product
        if ($child !== null) {
            $data['childcategory'] = $childcategory = Childcategory::where('slug', $child)->first();
            $products              = $products->where('childcategory_id', $childcategory->id);
        }

//max and min

        $min = request()->input('min');

        $max = request()->input('max');

        if ($min && $max) {

            $products->where('selling', '>', $min)->where('selling', '<', $max);

        }

//brand

        $brand = request()->input('brand');

        if ($brand) {

            $products->where('brand_id', $brand);

        }

        $order = request()->input('order');

        if ($order) {

            $products->orderBy('selling', $order);
        }

        $data['sub']      = $sub;
        $data['child']    = $child;
        $data['products'] = $products->paginate(20);

        if ($sub == null && $child == null) {
            $data['related_menus'] = Subcategory::where('category_id', $category->id)->where('status', 1)->get();
        } else {
            $data['related_menus'] = Childcategory::where('category_id', $category->id)->where('status', 1)->get();
        }
        $data['category_banner'] = Slider::where('category_id', $category->id)->where('type', null)->get();

        return view('frontend.category-product', $data);
    }

    public function productDetails($product) {
        $data                  = [];
        $data['second_header'] = true;

        $data['product'] = $product = Product::with('category', 'subcategory', 'childcategory', 'brand', 'sizes', 'images', 'ratingReviews', 'ratingReviews.user')->where('status', 1)->where('slug', $product)->first();

        $data['related_product'] = Product::with('images', 'ratingReviews')->where('status', 1)->where('category_id', $product->category_id)->orderBy('id', 'DESC')->limit(6)->get();

        $data['partial_product'] = Product::with('images', 'ratingReviews')->where('status', 1)->where('category_id', $product->category_id)->where('subcategory_id', $product->subcategory_id)->where('childcategory_id', $product->childcategory_id)->orderBy('id', 'asc')->limit(4)->get();

        return view('frontend.product-details', $data);
    }

    public function dashboard() {
        $data                  = [];
        $data['second_header'] = true;

        return view('frontend.user.dashboard', $data);
    }

    public function search(Request $request) {

        $search                = $request->input('search');
        $data                  = [];
        $data['second_header'] = true;
        $data['products']      = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->paginate(28);

        return view('frontend.search-product', $data);
    }

    public function page($slug) {
        $second_header = true;
        $page          = Page::where('slug', $slug)->where('status', 1)->first();

        return view('frontend.page', compact('page', 'second_header'));
    }

    public function category() {
        $second_header = true;

        return view('frontend.categories', compact('second_header'));
    }
    
    public function fashionCategory() {
        $second_header = true;

        $fashion = Category::find(15);
        return view('frontend.fashion_category', compact('fashion', 'second_header'));
    }

    public function voucher() {
        $data                  = [];
        $data['second_header'] = true;
        $data['vouchers']      = Voucher::where('validity_from', '<=', today())->where('validity_to', '>=', today())->get();

        return view('frontend.voucher', $data);
    }

    public function bannerCollectionProduct($id) {

        if (!BannerCollection::where('status', 1)->where('banner_collection', $id)->exists()) {
            return redirect()->back();
        }

        $second_header = true;

        $products = Product::with('images', 'ratingReviews')->where('discount', '>', 0)->where('status', 1)->where('subcategory_id', $id)->paginate(20);

        return view('frontend.banner-collection-product', compact('products', 'second_header'));
    }

    public function allMallProduct() {
        $second_header = true;

        $malls = Brand::where('mall', 1)->paginate(20);

        return view('frontend.all-mall', compact('malls', 'second_header'));
    }

    public function mallProduct($id) {

        if (!Brand::where('id', $id)->where('mall', 1)->exists()) {
            return redirect()->back();
        }

        $second_header = true;

        $bazar_mall = Slider::where('type',5)->get();
        $products = Product::where('brand_id', $id)->where('discount', '>', 0)->where('status', 1)->paginate(20);
        $brands   = Brand::where('mall', 1)->limit(20)->get();

        return view('frontend.mall-product', compact('products', 'second_header', 'brands', 'bazar_mall'));
    }

    public function allCollection() {
        $data                  = [];
        $data['second_header'] = true;
        $data['collections']   = ProductCollection::orderBy('id', 'asc')->paginate(30);

        return view('frontend.all-collection', $data);
    }

    public function allProductCollection($id) {
        $second_header = true;

        $products   = [];
        $collection = ProductCollection::find($id);
        $col        = explode(',', $collection->product_collection);

        if (!$collection) {
            return redirect()->back();
        }

        $products = Product::where('status', 1)->where('discount', '>', 0)->whereIn('subcategory_id', $col)->paginate(20);

        // dd($products);

        return view('frontend.collection-product', compact('products', 'second_header'));
    }

    public function allFlashDealProduct() {
        $second_header = true;
        $flash_deal = Slider::where('type',6)->get();
        $products      = Product::where('status', 1)->where('discount', '>', 0)->where('flash_deal', 1);
        $category = request()->category;
        if($category){
            $category_id = Category::where('slug',$category)->first()->id;
            $products = $products->where('category_id',$category_id);
        }
        $products = $products->paginate(20);

        return view('frontend.flash-deal', compact('products', 'second_header','flash_deal'));
    }

    public function allEverydayLowPriceProduct() {
        $second_header = true;
        $everyday = Slider::where('type',7)->get();
        $products      = Product::where('status', 1)->where('discount', '>', 0)->where('low_price', 1)->paginate(20);

        return view('frontend.everyday-low-price', compact('products', 'second_header','everyday'));
    }

    public function allFlashSaleProduct() {
        $second_header = true;
        $products      = Product::where('status', 1)->where('discount', '>', 0)->where('flash_sale', 1)->paginate(20);

        return view('frontend.flash-sale', compact('products', 'second_header'));
    }

    public function allFashionProduct() {
        $second_header = true;
        $fashion = Slider::where('type',7)->get();
        $products      = Product::where('status', 1)->where('discount', '>', 0)->where('fashion', 1)->paginate(20);

        return view('frontend.fashion', compact('products', 'second_header','fashion'));
    }

}
