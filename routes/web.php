<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Monolog\Handler\RotatingFileHandler;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;

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

// Register, Login
Route::middleware('adminAuth')->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    // dashboard //
    Route::get('dashboardPage',[AuthController::class,'dashboardPage'])->name('auth#dashboardPage');

    Route::middleware('adminAuth')->group(function(){
         // Admin -> Category //
        Route::prefix('category')->group(function(){
            Route::get('listPage',[CategoryController::class,'listPage'])->name('category#listPage');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('createCategory',[CategoryController::class,'createCategory'])->name('category#createCategory');
            Route::get('readData',[CategoryController::class,'readData'])->name('category#readData');
            Route::get('deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('category#deleteCategory');
            Route::get('updatePage/{id}',[CategoryController::class,'updatePage'])->name('category#updatePage');
            Route::post('updateCategory',[CategoryController::class,'updateCategory'])->name('category#updateCategory');
        });

        // Admin account //
        Route::prefix('account')->group(function(){
            // password change //
            Route::get('passwordChangePage',[AdminController::class,'passwordChangePage'])->name('account#passwordChangePage');
            Route::post('passwordChange',[AdminController::class,'passwordChange'])->name('account#passwordChange');

            // account profile //
            Route::get('profilePage',[AdminController::class,'profilePage'])->name('account#profilePage');
            Route::get('editProfilePage',[AdminController::class,'editProfilePage'])->name('account#editProfilePage');
            Route::post('editProfile/{id}',[AdminController::class,'editProfile'])->name('account#editProfile');

            // accounts list //
            Route::get('accountListPage',[AdminController::class,'accountListPage'])->name('account#accountListPage');
            Route::post('deleteAccount',[AdminController::class,'deleteAccount'])->name('account#deleteAccount');
            Route::get('seperateRole/{role}',[AdminController::class,'seperateRole'])->name('account#seperateRole');
            Route::get('changeAccountRole',[AdminController::class,'changeAccountRole'])->name('account#changeAccountRole');
        });

        // Admin -> Products //
        Route::prefix('product')->group(function(){
            Route::get('listPage',[ProductController::class,'listPage'])->name('product#listPage');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('createProduct',[ProductController::class,'createProduct'])->name('product#createProduct');
            Route::get('search',[ProductController::class,'search'])->name('product#search');
            Route::get('detailPage/{id}',[ProductController::class,'detailPage'])->name('product#detailPage');
            Route::get('deleteProduct/{id}',[ProductController::class,'deleteProduct'])->name('product#deletePage');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('updateProduct',[ProductController::class,'updateProduct'])->name('product#updateProduct');
        });

        // Admin -> Orders //
        Route::prefix('order')->group(function(){
            Route::get('orderListPage',[OrderController::class,'orderListPage'])->name('order#orderListPage');
            Route::get('filterOrderList',[OrderController::class,'filterOrderList'])->name('order#filterOrderList');
            Route::get('updateOrderStatus',[OrderController::class,'updateOrderStatus'])->name('order#updateOrderStatus');
            Route::get('orderListDetail/{order_code}',[OrderController::class,'orderListDetail'])->name('order#orderListDetail');
            Route::get('newOrders',[OrderController::class,'newOrders'])->name('order#newOrders');
        });

        // Admin -> Contacts //
        Route::prefix('contact')->group(function(){
            Route::get('contactListPage',[ContactController::class,'contactListPage'])->name('contact#contactListPage');
            Route::get('replyPage/{id}',[ContactController::class,'replyPage'])->name('contact#replyPage');
            Route::post('replyToCustomer',[ContactController::class,'replyToCustomer'])->name('contact#replyToCustomer');
            Route::get('allMessagePage',[ContactController::class,'allMessagePage'])->name('contact#allMessagePage');
            Route::get('updateContactStatusFromAdmin',[ContactController::class,'updateContactStatusFromAdmin'])->name('contact#updateContactStatusFromAdmin');
            Route::get('notiForAdmin',[ContactController::class,'notiForAdmin'])->name('contact#notiForAdmin');
        });
    });

    Route::middleware('userAuth')->group(function(){
        // User -> home //
        Route::prefix('customer')->group(function(){
            Route::get('homePage',[CustomerController::class,'homePage'])->name('customer#homePage');
            Route::get('profilePage',[CustomerController::class,'profilePage'])->name('customer#profilePage');
            Route::get('editPage',[CustomerController::class,'editPage'])->name('customer#editProfile');
            Route::post('updateProfile',[CustomerController::class,'updateProfile'])->name('customer#updateProfile');
            Route::get('passwordPage',[CustomerController::class,'passwordPage'])->name('customer#passwordPage');
            Route::post('changePassword',[CustomerController::class,'changePassword'])->name('customer#changePassword');
        });

        // User->product //
        Route::prefix('product')->group(function(){
            Route::get('filterList/{id}',[ProductController::class,'filterList'])->name('product#filterList');
            Route::get('productDetailPage/{id}',[ProductController::class,'productDetailPage'])->name('product#productDetailPage');
        });

        // User -> ajax //
        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('orderList',[AjaxController::class,'orderList'])->name('ajax#orderList');
            Route::get('removeCartLists',[AjaxController::class,'removeCartLists'])->name('ajax#removeCartLists');
            Route::get('removeEachCart',[AjaxController::class,'removeEachCart'])->name('ajax#removeEachCart');
            Route::get('viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
            Route::get('updateContactStatusFromUser',[AjaxController::class,'updateContactStatusFromUser'])->name('ajax#updateContactStatusFromUser');
            Route::get('rateProduct',[AjaxController::class,'rateProduct'])->name('ajax#rateProduct');
            Route::get('checkLove',[AjaxController::class,'checkLove'])->name('ajax#checkLove');
        });

        // User -> cart //
        Route::prefix('cart')->group(function(){
            Route::get('cartList',[CartController::class,'cartList'])->name('cart#cartList');
            Route::get('addOneItemToCart/{id}',[CartController::class,'addOneItemToCart'])->name('cart#addOneItemToCart');
        });

        // User -> order //
        Route::prefix('order')->group(function(){
            Route::get('orderHistory',[OrderController::class,'orderHistory'])->name('order#orderHistory');
        });

        // User -> contact //
        Route::prefix('contact')->group(function(){
            Route::get('contactFormPage',[ContactController::class,'contactFormPage'])->name('contact#contactFormPage');
            Route::post('contactToAdmin',[ContactController::class,'contactToAdmin'])->name('contact#contactToAdmin');
            Route::get('directReplyFromAdminPage',[ContactController::class,'directReplyFromAdminPage'])->name('contact#directReplyFromAdminPage');
            Route::get('allReplyFromAdmin',[ContactController::class,'allReplyFromAdmin'])->name('contact#allReplyFromAdmin');
        });

        // User -> rating //
        Route::prefix('rating')->group(function(){
            Route::post('review',[RatingController::class,'review'])->name('rating#review');
            Route::get('reactLove/{id}',[RatingController::class,'reactLove'])->name('rating#reactLove');
        });
    });

});
