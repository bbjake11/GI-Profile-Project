<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\RecommendedPlanController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\KeywordController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use App\Http\Controllers\Admin\PlaceImageController;
use App\Http\Controllers\Admin\PlaceKeywordController;
use App\Http\Controllers\Admin\TopController as AdminTopController;
use App\Http\Controllers\SuggestPlansController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PlaceFavoriteController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanFavoriteController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\SearchController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\TopController::class, 'index'])->name('top');

//Search
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/place', [SearchController::class, 'search'])->name('search.place');

# Place Detail Pages
Route::get('/{id}/placedetails',[PlaceController::class, 'index'])->name('placedetails');

# Login routes are handled by Auth::routes() below, but we override the view

# Social Login (kept for backward compatibility, but not used in navigation)
Route::get('/social_login', [SocialLoginController::class, 'social_login'])->name('social_login');
Route::post('/social_login/save-in-session/ajax', [SocialLoginController::class, 'saveInSession']); 
Route::get('/auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [SocialLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);

Route::group(['middleware' => 'auth'], function(){

    # For Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
        # Admin Top
        Route::get('/top', [AdminTopController::class, 'top'])->name('top');

        # Users
        Route::get('/users', [UsersController::class, 'index'])->name('users');
        Route::patch('/users/{user}/update', [UsersController::class, 'update'])->name('users.update');

        #KEYWORD
        Route::get('/keywords', [KeywordController::class, 'index'])->name('keywords');
        Route::get('/keywords/create', [KeywordController::class, 'create'])->name('keywords.create');
        Route::post('/keywords/store', [KeywordController::class, 'store'])->name('keywords.store');
        Route::get('/keywords/edit/{id}', [KeywordController::class, 'edit'])->name('keywords.edit');
        Route::patch('/keywords/{id}/update', [KeywordController::class,'update'])->name('keywords.update');
        Route::delete('/keywords/{id}/destroy', [KeywordController::class, 'destroy'])->name('keywords.destroy');

        #PLACE
        Route::get('/places',[AdminPlaceController::class, 'index'])->name('place.index');
        Route::get('/places/create',[AdminPlaceController::class, 'create'])->name('place.create');
        Route::post('/places/store',[AdminPlaceController::class, 'store'])->name('place.store');
        Route::get('/places/{place}/edit', [AdminPlaceController::class, 'edit'])->name('place.edit');
        Route::post('/places/{place}/update', [AdminPlaceController::class, 'update'])->name('place.update');
        Route::delete('/places/{place}/destroy', [AdminPlaceController::class, 'destroy'])->name('place.destroy');
        Route::post('/places/getPrefecturesByArea', [AdminPlaceController::class, 'getPrefecturesByArea'])->name('ajax.getPrefecturesByArea');
        Route::post('/places/getCitiesByPrefecture', [AdminPlaceController::class, 'getCitiesByPrefecture'])->name('ajax.getCitiesByPrefecture');

        #PLACE IMAGES
        Route::get('/place_images/{place}/show',[PlaceImageController::class, 'show'])->name('place_image.show');
        Route::get('/place_images/{place}/create', [PlaceImageController::class, 'create'])->name('place_image.create');
        Route::post('/place_images/{place}/store',[PlaceImageController::class, 'store'])->name('place_image.store');
        Route::get('/place_image/{place_image}/edit', [PlaceImageController::class, 'edit'])->name('place_image.edit');
        Route::patch('/place_image/{place_image}/update', [PlaceImageController::class, 'update'])->name('place_image.update');
        Route::delete('/place_image/{place_image}/destroy', [PlaceImageController::class, 'destroy'])->name('place_image.destroy');

        #Place Keyword
        Route::get('/place_keywords/{place}/index',[PlaceKeywordController::class, 'index'])->name('place_keyword.index');
        Route::post('/place_keywords/{place}/store',[PlaceKeywordController::class, 'store'])->name('place_keyword.store');
        Route::patch('/place_keyword/{place}/{keyword}/update', [PlaceKeywordController::class, 'update'])->name('place_keyword.update');
        Route::delete('/place_keyword/{place}/{keyword}/destroy', [PlaceKeywordController::class, 'destroy'])->name('place_keyword.destroy');

        #GENRE MANAGEMENT
        Route::get('/genres', [GenreController::class, 'index'])->name('genres');
        Route::post('/genres/store', [GenreController::class, 'store'])->name('genres.store');
        Route::patch('/genres/{genre}/update', [GenreController::class, 'update'])->name('genres.update');
        Route::delete('/genres/{genre}/destroy', [GenreController::class, 'destroy'])->name('genres.destroy');
        
        #ADMIN-RECOMMENDED PLAN
        Route::get('/recommended/plans',[RecommendedPlanController::class, 'index'])->name('recommended_plans');
        Route::post('/recommended/plans/store', [RecommendedPlanController::class, 'store'])->name('recommended_plans.store');
        Route::patch('/recommended/plans/{recommended_plan}/update', [RecommendedPlanController::class, 'update'])->name('recommended_plans.update');
        Route::delete('/recommended/plans/{recommended_plan}/destroy', [RecommendedPlanController::class, 'destroy'])->name('recommended_plans.destroy');
        
        #ADMIN-RECOMMENDED PLAN DETAILS
        Route::get('/recommended/plan/details/{plan}',[RecommendedPlanController::class, 'showDetail'])->name('show.plan_details');
        Route::get('recommended/plan/detail/create/{planID?}',[RecommendedPlanController::class, 'createDetail'])->name('planDetail.create');
        Route::get('/recommended/plan/detail/place/create',[RecommendedPlanController::class, 'createPlace'])->name('create.place');
        Route::get('/recommended/plan/detail/place/search/', [RecommendedPlanController::class, 'search'])->name('search');
        Route::post('recommended/plan/detail/store/',[RecommendedPlanController::class, 'storeDetail'])->name('planDetail.store');
        Route::get('/recommended/plan/detail/edit',[RecommendedPlanController::class, 'editDetail'])->name('planDetail.edit');
        Route::get('/recommended/plan/detail/edit/{plan_details?}/{place_id?}',[RecommendedPlanController::class, 'editDetail'])->name('planDetail.edit');
        Route::get('/recommended/plan/detail/place/filter/{plan_detail_id?}', [RecommendedPlanController::class, 'filter'])->name('filter');
        Route::get('/recommended/plan/detail/place/update/{plan_detail_id}',[RecommendedPlanController::class, 'updatePlace'])->name('update.place');
        Route::patch('/recommended/plan/detail/{plan_details}/update',[RecommendedPlanController::class, 'updateDetail'])->name('planDetail.update');
        Route::delete('/recommended/plan/detail/{plan_details}/destroy',[RecommendedPlanController::class, 'destroyDetail'])->name('planDetail.destroy');
        
        #ADMIN RECOMMENDED PLAN KEYWORDS LIST
        Route::get('/recommended/plan/keywords/{plan}',[RecommendedPlanController::class, 'showKeyword'])->name('show.plan_keywords');
        Route::post('/recommended/plan/keywords/store/{plan}', [RecommendedPlanController::class, 'storeKeyword'])->name('plan_keyword.store');
        Route::patch('/recommended/plan/keywords/{keyword}/update', [RecommendedPlanController::class, 'updateKeyword'])->name('plan_keyword.update');
        Route::delete('/recommended/plan/keywords/{keyword}/destroy', [RecommendedPlanController::class, 'destroyKeyword'])->name('plan_keyword.destroy');
        
        #QUESTION
        Route::get('/questions',[QuestionController::class, 'index'])->name('question');
        Route::get('/questions/create',[QuestionController::class, 'create'])->name('question.create');
        Route::post('/questions/store',[QuestionController::class, 'store'])->name('question.store');
        Route::get('/questions/{question}/edit',[QuestionController::class, 'edit'])->name('question.edit');
        Route::patch('/questions/{question}/update',[QuestionController::class, 'update'])->name('question.update');
        Route::delete('/questions/{question}/destroy',[QuestionController::class, 'destroy'])->name('question.destroy');
        #ANSWER
        Route::get('/answers/{question}',[AnswerController::class, 'index'])->name('answer');
        Route::get('/answers/{question}/create',[AnswerController::class, 'create'])->name('answer.create');
        Route::post('/answers/{question}/store',[AnswerController::class, 'store'])->name('answer.store');
        Route::get('/answers/{question}/{answer}/edit',[AnswerController::class, 'edit'])->name('answer.edit');
        Route::patch('/answers/{question}/{answer}/update',[AnswerController::class, 'update'])->name('answer.update');
        Route::delete('/answers/{answer}/destroy',[AnswerController::class, 'destroy'])->name('answer.destroy');

    });
    
    // for displaying PLAN DETAILS(for LOGGED IN USER)
    Route::get('/myplans', [PlanController::class, 'showMyPlan'])->name('plans');
    //for displaying PLAN DETAILS(for GUEST USER)
    Route::get('/plan/details/{id}', [PlanController::class, 'showPlan'])->name('show.plan');
    Route::post('/plans/store/{planId}',[PlanFavoriteController::class, 'store'])->name('store.plan');
    Route::delete('/plans/destroy/{planId}',[PlanFavoriteController::class,'destroy'])->name('destroy.plan');

    # Place Favorite
    Route::post('/favorite/{place_id}/store', [PlaceFavoriteController::class, 'store'])->name('place_favorite.store');
    Route::delete('/favorite/{place_id}/destroy', [PlaceFavoriteController::class, 'destroy'])->name('place_favorite.destroy'); 
    
    # MyPage
    Route::get('/my_page', [MyPageController::class, 'index'])->name('my_page');
    Route::get('/my_page/keywords', [MyPageController::class, 'keywordIndex'])->name('my_page.keywords');
    Route::post('/my_page/interests/store', [MyPageController::class, 'storeInterest'])->name('my_page.interests.store');
    Route::delete('/my_page/interests/{id}/destroy', [MyPageController::class, 'destroyInterest'])->name('my_page.interests.destroy');
    Route::delete('/my_page/place_favorites/{place_id}/destroy', [MyPageController::class, 'destroyPlaceFavorite'])->name('my_page.place_favorites.destroy');
    Route::delete('/my_page/plan_favorites/{id}/destroy', [MyPageController::class, 'destroyPlanFavorite'])->name('my_page.plan_favorites.destroy');
    Route::delete('/my_page/my_plan/{id}/destroy', [MyPageController::class, 'destroyMyPlan'])->name('my_page.my_plan.destroy');
    Route::patch('/my_page/update_profile', [MyPageController::class, 'updateProfile'])->name('my_page.update_profile');

    // Suggest Plans
    Route::get('/suggest-plans/questions', [SuggestPlansController::class, 'index'])->name('suggest-plans.questions');
    Route::get('/suggest-plans/plan_detail/{user_id}', [SuggestPlansController::class, 'createPlan'])->name('suggest-plans.show');
    Route::get('/suggest-plans/edit/plan_detail/{user_id}', [SuggestPlansController::class, 'editPlan'])->name('suggest-plans.edit');
    Route::post('/suggest-plans/edit/ajax/reload-other-places', [SuggestPlansController::class, 'searchPlaces']);
    Route::post('/suggest-plans/store/plan_detail/{user_id}', [SuggestPlansController::class, 'storePlan'])->name('suggest-plans.store');
});