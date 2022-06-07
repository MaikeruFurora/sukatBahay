<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ReviseYearController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
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



/**
 * 
 * Authenticate user access
 * 
 */
Route::middleware(['guest:web', 'preventBackHistory'])->name('auth.')->group(function () {
    Route::get('/login', function () {return view('auth/login');})->name('login');
    Route::get('/register', function () {return view('auth/register');})->name('register');
    Route::post('/login/post', [AuthController::class, 'login_post'])->name('login_post');
    Route::post('/register/post', [AuthController::class, 'regiter_post'])->name('register_post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


/* This is a route that is not using a controller. It is just a simple route that returns a view. */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about-us', function () {
    return view('about');
})->name('aboutUs');

Route::get('search/auto-suggest', [SearchController::class, 'autoSuggest']);
Route::get('search/force', [SearchController::class, 'searchForce'])->name('search.force');
Route::get('section-content/{section:slug}/{keyword?}', [SearchController::class, 'sectionContent']);
Route::get('rule-content/{rule:slug}/{section:slug}/{keyword?}', [SearchController::class, 'ruleContent'])->name('rule.content');
Route::get('bookmark/content/{content}', [UserController::class, 'bookmark'])->name('content.bookmark');


Route::middleware((['auth:web','preventBackHistory']))->name('user')->prefix('user/')->group(function(){

});


Route::middleware(['auth:web','preventBackHistory','administrator'])->name('admin.')->prefix('admin/')->group(function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('dashboard');

    /**
     * 
     * User route
     * 
     */
    Route::get('user',[AdminController::class,'users'])->name('user');// view user.blade.php
    Route::post('user/list',[AdminController::class,'userList']);// dataTable serverside process


    /**
     * 
     * Admins
     * 
     */

    Route::get('account',[AdminController::class,'account'])->name('account');// view admin.blade.php


    /**
     * 
     * Rules route
     * 
     */

    Route::get('rule',[RuleController::class,'rules'])->name('rule');//view rule.blade.php
    Route::post('rule/list',[RuleController::class,'ruleList']);// dataTable serverside process
    Route::post('rule/store',[RuleController::class,'ruleStore']);// store and update process
    Route::get('rule/edit/{rule}',[RuleController::class,'ruleEdit']);// edit and get data

    /**
     * 
     * Sections route
     * 
     */
    Route::get('section/{rule_id}',[SectionController::class,'index'])->name('section');//view section.blade.php
    Route::post('section/list/{id}',[SectionController::class,'sectionList']);// dataTable serverside process
    Route::post('section/store',[SectionController::class,'sectionStore']);// store and update process
    Route::get('section/edit/{section}',[SectionController::class,'sectionEdit']);// edit and get data

     /**
     * 
     * Content route
     * 
     */
    Route::get('section/content/{section}',[ContentController::class,'index'])->name('content');//view content.blade.php
    Route::get('section/content/list/{section}/{year?}',[ContentController::class,'contentList']);// dataTable serverside process
    Route::get('section/content/edit/{content}',[ContentController::class,'contentEdit']);// edit and get data
    Route::delete('section/content/delete/{id}',[ContentController::class,'contentDelete'])->name('content.delete');// edit and get data
    // Route::get('section/content/create/{section}',[ContentController::class,'contentCreate'])->name('content.create');// edit and get data
    Route::post('section/content/store',[ContentController::class,'contentStore'])->name('content.store');// store and update process

    /**
     * 
     * Excercises route
     * 
     */
    Route::get('exercises/{rule}',[ExerciseController::class,'index'])->name('exercises');//view content.blade.php
    Route::post('exercises/store',[ExerciseController::class,'create']);//view content.blade.php
    Route::get('exercises/list/{rule}',[ExerciseController::class,'list']);//view content.blade.php
    Route::get('exercises/edit/{exercise}',[ExerciseController::class,'edit']);//view content.blade.php
    Route::delete('exercises/delete/{exercise}',[ExerciseController::class,'destroy']);//view content.blade.php

    /**
     * 
     * Revise Year route
     * 
     */
    Route::post('revise-year/list',[ReviseYearController::class,'list']);// dataTable serverside process
    Route::post('revise-year/store',[ReviseYearController::class,'create']);// store and update process
    Route::get('revise-year/edit/{reviseYear}',[ReviseYearController::class,'edit']);// get info for edit process

});
