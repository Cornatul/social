<?php

use Cornatul\Social\Http\GithubController;
use Cornatul\Social\Http\LinkedInController;
use Cornatul\Social\Http\SocialController;

Route::group(['middleware' => ['web','auth'],'prefix' => 'social', 'as' => 'social.'], static function () {


    //generate the index page
    Route::get('/', [SocialController::class, 'index'])->name('index');
    Route::get('/linkedin', [LinkedInController::class, 'index'])->name('linkedin.index');
    Route::get('/linkedin/login', [LinkedInController::class, 'login'])->name('linkedin.login');
    Route::get('/linkedin/callback', [LinkedInController::class, 'callback'])->name('linkedin.callback');
    Route::get('/linkedin/share', [LinkedInController::class, 'share'])->name('linkedin.share');
    Route::post('/linkedin/shareAction', [LinkedInController::class, 'shareAction'])->name('linkedin.shareAction');


    Route::get('/github', [GithubController::class, 'index'])->name('github.index');
    Route::get('/github/login', [GithubController::class, 'login'])->name('github.login');
    Route::get('/github/callback', [GithubController::class, 'callback'])->name('github.callback');
    Route::get('/github/share', [GithubController::class, 'share'])->name('github.share');
    Route::post('/github/shareAction', [GithubController::class, 'shareAction'])->name('github.shareAction');

    //@todo create the google my business
    //todo create share on instagram
    //todo create share on wasup maybe ?



});
