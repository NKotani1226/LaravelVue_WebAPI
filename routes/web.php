<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotionApiController;

Route::get('/', function () {
    return view('welcome');
});

// Notionデータベースから情報を取得する
Route::get('/notion/database', [NotionApiController::class, 'fetchDatabase']);
Route::get('/notion/send',[NotionApiController::class,'findPostView']);
