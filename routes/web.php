<?php

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

Route::get('/', function () {
    return view('home');
});

Route::get('user/{id?}', function ($id = Null) {
    if ($id == NULL) {
        return "all";
    }
    return "user " . $id;
});

Route::get('user/{id}/post/{idPost}/{userName}', function ($id, $idPost, $userName) {
    echo "This is post " . $idPost . " of user " . $id . " username: " . $userName;
});

Route::get('/thanhcong/{id}', function ($id) {
    dd("Thành công " . $id);
//   return redirect('/');
});

Route::delete('task/delete/{id}', function ($id) {
    return redirect('/thanhcong/' . $id);
})->name('todo.task.delete');

//Route::prefix('task')->group(function (){
//    Route::delete('delete/{id}', function ($id) {
//        return redirect('/thanhcong/' . $id);
//    })->name('todo.task.delete');
//});

Route::group([
    'prefix' => 'task'
], function () {
    Route::delete('delete/{id}', function ($id) {
        return redirect('/thanhcong/' . $id);
    })->name('todo.task.delete');

    Route::get('complete/3', function () {
        dd("Hoàn Thành");
    })->name('todo.task.complete');

    Route::get('reset/3', function () {
        dd("Làm lại");
    })->name('todo.task.reset');
});

