<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperiencesController;

Route::post('/signIn', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'show']);
Route::get('/skills', [SkillsController::class, 'ShowAllSkills']);
Route::get('/experiences', [ExperiencesController::class, 'ShowAllExperiences']);
Route::get('/portfolios', [PortfolioController::class, 'ShowAllPortfolios']);
Route::get('/blogs', [BlogsController::class, 'ShowAllBlogs']);
Route::get('/comments/{blog}', [CommentsController::class, 'ShowCommentsWithBlog']);
Route::post('/sendMessage', [ContactController::class, 'SendMessage']);

Route::middleware('auth:sanctum')->group(function () {
    Route::patch('/user', [UserController::class, 'update']);
    Route::prefix('/skills')
        ->controller(SkillsController::class)
        ->group(function () {
            Route::post('/', 'CreateSkill');
            Route::patch('/{skill}', 'UpdateSkill');
            Route::delete('/{skill}', 'DeleteSkill');
        });
    Route::prefix('/experiences')
        ->controller(ExperiencesController::class)
        ->group(function () {
            Route::post('/', 'CreateExperience');
            Route::patch('/{experience}', 'UpdateExperience');
            Route::delete('/{experience}', 'DeleteExperience');
        });
    Route::prefix('/portfolios')
        ->controller(PortfolioController::class)
        ->group(function () {
            Route::post('/', 'CreatePortfolio');
            Route::patch('/{portfolio}', 'UpdatePortfolio');
            Route::delete('/{portfolio}', 'DeletePortfolio');
        });
    Route::prefix('/blogs')
        ->controller(BlogsController::class)
        ->group(function () {
            Route::post('/', 'CreateBlog');
            Route::patch('/{blog}', 'UpdateBlog');
            Route::delete('/{blog}', 'DeleteBlog');
        });
    Route::prefix('/comments')
        ->controller(CommentsController::class)
        ->group(function () {
            Route::post('/', 'CreateComment');
            Route::delete('/{comment}', 'DeleteComment');
        });
});
