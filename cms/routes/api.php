<?php

use App\Http\Controllers\Question\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/questions', [App\Http\Controllers\Api\QuestionApiController::class, 'getApiQuestions']);


Route::post('/submit-survey', [\App\Http\Controllers\Api\AnswerController::class, 'submit']);