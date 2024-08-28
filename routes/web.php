<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


use App\Http\Controllers\Backend\Auth\AdminLoginController;
use App\Http\Controllers\Backend\Auth\AdminRegistrationController;
use App\Http\Controllers\Backend\BannerCollectionController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\MainMenu\CategoryController;
use App\Http\Controllers\Backend\MainMenu\ChildcategoryController;
use App\Http\Controllers\Backend\MainMenu\SubcategoryController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ProductCollectionController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingChargeController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\VoucherController;
use App\Http\Controllers\Common\OrderController;
use App\Http\Controllers\Common\RatingReviewController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/categories', 'category')->name('category');
    Route::get('/fashion_categor', 'fashionCategory')->name('fashionCategory');
    Route::get('/voucher', 'voucher')->name('voucher');
    Route::get('/product/{product}', 'productDetails')->name('productDetails');
    Route::get('/page/{slug}', 'page')->name('page');
    Route::get('/search/', 'search')->name('search');
    Route::get('/f/{category}/{sub?}/{child?}', 'categoryProduct')->name('categoryProduct');

    //offer
    Route::get('/banner/collection/{id}', 'bannerCollectionProduct')->name('bannerCollectionProduct');
    Route::get('/all-mall-product', 'allMallProduct')->name('allMallProduct');
    Route::get('/mall/collection/{id}', 'mallProduct')->name('mallProduct');
    Route::get('/all-product/all-collection', 'allCollection')->name('allCollection');
    Route::get('/all-product/collection/{id}', 'allProductCollection')->name('allProductCollection');

    Route::get('/flash-deal', 'allFlashDealProduct')->name('allFlashDealProduct');
    Route::get('/everyday-low-price', 'allEverydayLowPriceProduct')->name('allEverydayLowPriceProduct');
    Route::get('/flash-sale', 'allFlashSaleProduct')->name('allFlashSaleProduct');
    Route::get('/fashion', 'allFashionProduct')->name('allFashionProduct');
    Route::get('/order-track','orderTrack')->name('order.track');
    Route::post('/order-track','orderTrackStore');
});

Route::controller(CartController::class)->group(function () {
    //cart
    Route::get('/cart', 'cart')->name('cart');
    Route::post('/add-to-cart', 'addToCart');
    Route::post('/update-cart', 'updateCart')->name('updateCart');
    Route::get('/remove-from-cart/{rowId}', 'removeFromCart')->name('removeFromCart');
    Route::get('/destroy-cart', 'destroyCart')->name('destroyCart');

    //coupon
    Route::post('/apply-coupon', 'applyCoupon')->name('applyCoupon');
    Route::get('/remove-coupon', 'removeCoupon')->name('removeCoupon');
});
Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist']);
Route::post('/add-voucher', [CartController::class, 'applyVoucher']);
Route::middleware('auth')->group(function () {
    //rating and review
    Route::post('/store-rating-review', [RatingReviewController::class, 'storeRatingReview'])->name('storeRatingReview');
    //user dashboard
    Route::get('/user/dashboard', [FrontendController::class, 'dashboard'])->name('user.dashboard');

    //wishlist
    Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');

    Route::get('/remove-from-wishlist/{id}', [WishlistController::class, 'removeFromWishlist'])->name('removeFromWishlist');

    //user profile
    Route::get('/user-profile', [ProfileController::class, 'showProfile'])->name('showProfile');
    Route::post('/store-user-profile/{id}', [ProfileController::class, 'storeProfile'])->name('storeProfile');

    //checkout
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    //adding shipping charge by ajax request
    Route::post('/add-shipping-charge', [CartController::class, 'addshippingCharge']);

    //place order
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('placeOrder');
    Route::get('/order-history', [OrderController::class, 'customerOrderHistory'])->name('orderHistory');
    Route::post('/cancel-order/{id}', [OrderController::class, 'customerCancelOrder'])->name('cancelOrder');
    Route::get('/user-invoice/{id}', [OrderController::class, 'customerInvoice'])->name('invoice');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//backend
Route::prefix('/admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/store-login', [AdminLoginController::class, 'storeLogin'])->name('storeLogin');
});

Route::prefix('/admin')->as('admin.')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //admin management
    Route::controller(AdminRegistrationController::class)->middleware('admin_user')->group(function () {
        Route::get('/admin-list', 'adminList')->name('adminList');
        Route::get('/create-admin', 'createAdmin')->name('createAdmin');
        Route::post('/store-admin', 'storeAdmin')->name('storeAdmin');
        Route::get('/edit-admin/{admin}', 'editAdmin')->name('editAdmin');
        Route::post('/update-admin/{admin}', 'updateAdmin')->name('updateAdmin');
        Route::post('/admin/active-admin/{admin}', 'activeAdmin')->name('activeAdmin');
        Route::post('/admin/inactive-admin/{admin}', 'inactiveAdmin')->name('inactiveAdmin');
        Route::delete('/delete-admin/{admin}', 'deleteAdmin')->name('deleteAdmin');

        Route::get('/customer-list', 'customerList')->name('customerList');
    });
    Route::middleware('main_menu')->group(function () {
        //slider
        Route::controller(SliderController::class)->group(function () {
            Route::get('/slider', 'allSlider')->name('allSlider');
            Route::get('/create-slider', 'createSlider')->name('createSlider');
            Route::post('/store-slider', 'storeSlider')->name('storeSlider');
            Route::get('/edit-slider/{slider}', 'editSlider')->name('editSlider');
            Route::put('/update-slider/{slider}', 'updateSlider')->name('updateSlider');
            Route::delete('/delete-slider/{slider}', 'deleteSlider')->name('deleteSlider');
        });

        //main menu
        //category
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'category')->name('category');
            Route::get('/create-category', 'createCategory')->name('createCategory');
            Route::post('/store-category', 'storeCategory')->name('storeCategory');
            Route::get('/edit-category/{id}', 'editCategory')->name('editCategory');
            Route::patch('/update-category/{id}', 'updateCategory')->name('updateCategory');
            Route::post('/active-category/{id}', 'activeCategory')->name('activeCategory');
            Route::post('/inactive-category/{id}', 'inactiveCategory')->name('inactiveCategory');
        });

        //subcategory
        Route::controller(SubcategoryController::class)->group(function () {
            Route::get('/subcategory', 'subcategory')->name('subcategory');
            Route::get('/create-subcategory', 'createSubcategory')->name('createSubcategory');
            Route::post('/store-subcategory', 'storeSubcategory')->name('storeSubcategory');
            Route::get('/edit-subcategory/{id}', 'editSubcategory')->name('editSubcategory');
            Route::patch('/update-subcategory/{id}', 'updateSubcategory')->name('updateSubcategory');
            Route::post('/active-subcategory/{id}', 'activeSubcategory')->name('activeSubcategory');
            Route::post('/inactive-subcategory/{id}', 'inactiveSubcategory')->name('inactiveSubcategory');
        });

        //childcategory
        Route::controller(ChildcategoryController::class)->group(function () {
            Route::get('/childcategory', 'childcategory')->name('childcategory');
            Route::get('/create-childcategory', 'createChildcategory')->name('createChildcategory');
            Route::post('/store-childcategory', 'storeChildcategory')->name('storeChildcategory');
            Route::get('/edit-childcategory/{id}', 'editChildcategory')->name('editChildcategory');
            Route::patch('/update-childcategory/{id}', 'updateChildcategory')->name('updateChildcategory');
            Route::post('/active-childcategory/{id}', 'activeChildcategory')->name('activeChildcategory');
            Route::post('/inactive-childcategory/{id}', 'inactiveChildcategory')->name('inactiveChildcategory');
            Route::delete('/delete-childcategory/{id}', 'deleteChildcategory')->name('deleteChildcategory');
        });
    });
    //product, color, size, brand, product-images, shipping-charge route
    //product

    Route::middleware('product')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/products', 'index')->name('index');
            Route::get('/products/stock', 'productStock')->name('productStock');
            Route::get('/create-product', 'createProduct')->name('createProduct');
            Route::post('/store-product', 'storeProduct')->name('storeProduct');
            Route::get('/edit-product/{id}', 'editProduct')->name('editProduct');
            Route::patch('/update-product/{id}', 'updateProduct')->name('updateProduct');
            Route::post('/active-product/{id}', 'activeProduct')->name('activeProduct');
            Route::post('/inactive-product/{id}', 'inactiveProduct')->name('inactiveProduct');
            Route::get('/edit-product-image/{id}', 'editProductImage')->name('editProductImage');
            Route::put('/update-product-image', 'updateProductImage')->name('updateProductImage');
            Route::delete('/delete-product/{id}', 'deleteProduct')->name('deleteProduct');
        });

        //size and color and brand
        Route::resource('/sizes', SizeController::class)->except(['show']);
        Route::post('/brands/active-in-mall/{mall}', [BrandController::class, 'activeInMall'])->name('activeInMall');
        Route::post('/brands/inactive-in-mall/{mall}', [BrandController::class, 'inactiveInMall'])->name('inactiveInMall');
        Route::resource('/colors', ColorController::class)->except(['show']);
        Route::resource('/brands', BrandController::class)->except(['show']);

        //shipping Charge
        Route::controller(ShippingChargeController::class)->group(function () {
            Route::get('/shipping-charge', 'showShippingCharge')->name('showShippingCharge');
            Route::post('/store-shipping-charge', 'storeShippingCharge')->name('storeShippingCharge');
        });
        //rating and review
        Route::controller(RatingReviewController::class)->group(function () {
            Route::get('/rating-reviews', 'showRatingReview')->name('showRatingReview');
            Route::get('/rating-reviews/active/{rating}', 'activeRatingReview')->name('activeRatingReview');
            Route::delete('/rating-reviews/delete/{rating}', 'deleteRatingReview')->name('deleteRatingReview');
        });
    });

    //product collection
    Route::middleware('collection')->group(function () {
        Route::controller(ProductCollectionController::class)->group(function () {
            Route::get('/product-collection', 'productCollection')->name('productCollection');
            Route::get('/create-product-collection', 'createProductCollection')->name('createProductCollection');
            Route::post('/store-product-collection', 'storeProductCollection')->name('storeProductCollection');
            Route::get('/edit-product-collection/{product_collection}', 'editProductCollection')->name('editProductCollection');
            Route::put('/update-product-collection/{coll}', 'updateProductCollection')->name('updateProductCollection');
            Route::delete('/delete-product-collection/{coll}', 'deleteProductCollection')->name('deleteProductCollection');
        });
        //banner Collection
        Route::controller(BannerCollectionController::class)->group(function () {
            Route::get('/banner-collection', 'bannerCollection')->name('bannerCollection');
            Route::post('/store-banner-collection', 'storeBannerCollection')->name('storeBannerCollection');
        });
    });

    Route::middleware('company')->group(function () {
        //flash sale timer Collection
        Route::controller(FlashSaleController::class)->group(function () {
            Route::get('/flash-sale-timer', 'flashSaleTimer')->name('flashSaleTimer');
            Route::post('/store-flash-sale-timer', 'storeFlashSaleTimer')->name('storeFlashSaleTimer');
        });

        // coupon
        Route::resource('/coupons', CouponController::class)->except(['show', 'edit', 'update']);

        //voucher
        Route::controller(VoucherController::class)->group(function () {
            Route::get('/voucher', 'voucherList')->name('voucherList');
            Route::get('/create-voucher', 'createVoucher')->name('createVoucher');
            Route::post('/store-voucher', 'storeVoucher')->name('storeVoucher');
            Route::get('/edit-voucher/{voucher}', 'editVoucher')->name('editVoucher');
            Route::patch('/update-voucher/{voucher}', 'updateVoucher')->name('updateVoucher');
            Route::delete('/delete-voucher/{voucher}', 'deleteVoucher')->name('deleteVoucher');
        });
    });

    //order
    Route::controller(OrderController::class)->middleware('order_history')->group(function () {
        Route::get('/cancel-order', 'cancelOrder')->name('cancelOrder');
        Route::get('/pending-order', 'pendingOrder')->name('pendingOrder');
        Route::post('/order-confirm-for-customer/{id}', 'orderConfirmForCustomer')->name('orderConfirmForCustomer');
        Route::get('/confirm-order', 'confirmOrder')->name('confirmOrder');
        Route::post('/order-shipped-for-customer/{id}', 'orderShippedForCustomer')->name('orderShippedForCustomer');
        Route::get('/shipped-order', 'shippedOrder')->name('shippedOrder');
        Route::get('/admin-invoice/{id}', 'invoice')->name('invoice');
    });

    Route::middleware('company')->group(function () {
        //company info
        Route::controller(CompanyInfoController::class)->group(function () {
            Route::get('/company-info', 'showCompanyInfo')->name('showCompanyInfo');
            Route::post('/store-company-info', 'storeCompanyInfo')->name('storeCompanyInfo');
        });
        //pages
        Route::controller(PageController::class)->group(function () {
            Route::get('/pages', 'pageList')->name('pageList');
            Route::get('/create-pages', 'pageCreate')->name('pageCreate');
            Route::post('/store-pages', 'pageStore')->name('pageStore');
            Route::get('/edit-pages/{page}', 'pageEdit')->name('pageEdit');
            Route::put('/update-pages/{page}', 'pageUpdate')->name('pageUpdate');
            Route::delete('/delete-pages/{page}', 'pageDelete')->name('pageDelete');
            Route::post('/active-pages/{page}', 'pageActive')->name('pageActive');
            Route::post('/inactive-pages/{page}', 'pageInactive')->name('pageInactive');
        });
    });
});
//ajax route
Route::get('/get-subcategory/{id}', [GeneralController::class, 'getSubcategory']);
Route::get('/get-childcategory/{category_id}/{subcategory_id}', [GeneralController::class, 'getChildcategory']);
