<?php
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\aloalo;
use App\Models\Article;
use App\Http\Controllers\CustomerController;
use Carbon\Factory;
use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

Route::get('/', [aloalo::class ,'mainpagearticle']);
Route::get('/articles/{articleslug_fa}' ,[aloalo::class ,'SinglePostView']);
Route::get('/about' ,[aloalo::class ,'AboutUs']);

Route::resource('customers', CustomerController::class);


Route::prefix('admin')->group(function(){
   
    
    Route::post('/articles/create' ,[aloalo::class,'articlecreatepost']);
    Route::get('/articles/{articleslug_fa}/update' ,[aloalo::class,'Update'] );
    Route::put('/articles/{article}/update' ,[aloalo::class,'PutUpdate']);
    Route::get('/articles' ,[aloalo::class,'GetAllArticles']);
    Route::delete('/articles/{article}' , [aloalo::class,'DeleteArticle']);
});
















