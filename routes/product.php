<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

//category route 
Route::controller(ProductController::class)->group(function() {
    Route::get('/products', 'products');
    Route::get('/create-product', 'create_product');
    Route::post('/store-product', 'store_product');
    
});

?>