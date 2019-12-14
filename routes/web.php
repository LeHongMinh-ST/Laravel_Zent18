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

Route::get('/', 'HomeController@index');

//Route::get('user/{id?}', function ($id = Null) {
//    if ($id == NULL) {
//        return "all";
//    }
//    return "user " . $id;
//});
//
//Route::get('user/{id}/post/{idPost}/{userName}', function ($id, $idPost, $userName) {
//    echo "This is post " . $idPost . " of user " . $id . " username: " . $userName;
//});
//
//Route::get('/thanhcong/{id}', function ($id) {
//    dd("Thành công " . $id);
////   return redirect('/');
//});
//
//Route::delete('task/delete/{id}', function ($id) {
//    return redirect('/thanhcong/' . $id);
//})->name('todo.task.delete');

//Route::prefix('task')->group(function (){
//    Route::delete('delete/{id}', function ($id) {
//        return redirect('/thanhcong/' . $id);
//    })->name('todo.task.delete');
//});

//Route::group([
//    'prefix' => 'task'
//], function () {
//    Route::delete('delete/{id}', function ($id) {
//        return redirect('thanhcong/' . $id);
//    })->name('todo.task.delete');
//
//    Route::get('complete/3', function () {
//        dd("Hoàn Thành");
//    })->name('todo.task.complete');
//
//    Route::get('reset/3', function () {
//        dd("Làm lại");
//    })->name('todo.task.reset');
//});

//=== buổi 3: view ===

//Route::get('hello1', function (){
//    return view('hello1');
//});
//
//Route::get('sub/hello1', function (){
//    return view('hello.hello1');
//});

//Route::get('hello2', function (){
//    return view('hello2',[
//        'name'=>'Lê Hồng Minh',
//        'year'=>2000,
//        'school'=>'Học viện nông nghiệp',
//        'detail'=>'không phải wibu'
//    ]);
//});

//Route::get('sub/hello2', function (){
//    $records = [1,2,3];
//    return view('hello.hello2')->with('records',$records);
//});

//Route::get('hello2',function (){
//    return view('hello2')->with('name','Lê Hồng Minh');
//});

//Route::get('hello2',function (){
//    return view('hello2')->with([
//        'name'=>'Lê Hồng Minh',
//        'year'=>2000,
//        'school'=>'Vnua'
//    ]);
//});
//Route::get('layout/home',function (){
//    return view('layout.home');
//});
//
//Route::get('layout/detail',function (){
//    return view('layout.detail');
//});

//Bài tập về nhà
Route::get('profile', function () {
    $name = 'Lê Hồng Minh';
    $year = 2000;
    $school = 'VNUA';
    $from = 'Hà Nam';
    $detail = '<b>Yêu màu vàng ghét sự giả dối, biết đàn ca sáo nhị...</b><i>thích con gái tóc ngắn, biết hát quan họ,... miễn là con gái là được</i>';
    $target = 'Ra trường có công ăn việc làm ổn định, có mức lương mơ ước 2000$';

    return view('profile')->with([
        'name' => $name,
        'year' => $year,
        'school' => $school,
        'from' => $from,
        'detail' => $detail,
        'target' => $target
    ]);
});

Route::get('list', function () {
    $list = [
        [
            'name' => 'Học View trong Laravel',
            'status' => 0
        ],
        [
            'name' => 'Học Route trong Laravel',
            'status' => 1
        ],
        [
            'name' => 'Làm bài tập View trong Laravel',
            'status' => -1
        ],
    ];

    return view('list')->with('list', $list);
});

//=== kết thúc ===

//== Buoi 4: Controller==
Route::get('page/{page?}/{page2?}', 'HomeController@page');
Route::get('setting1', 'SettingController@index');


Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {
    Route::get('setting2', 'SettingController@index');
    Route::get('setting3', 'Test\SettingController@index');
    Route::get('dashboard', 'DashboardController@index');

});

//Route::resource('task','Frontend\TaskController');
Route::group([
    'prefix'=>'task'
],function (){
    Route::get('/','Frontend\TaskController@index')->name('task.index');
    Route::get('create','Frontend\TaskController@create')->name('task.create');
    Route::post('store','Frontend\TaskController@store')->name('task.store');
    Route::get('{task?}','Frontend\TaskController@show')->name('task.show');
    Route::put('{task?}','Frontend\TaskController@update')->name('task.update');
    Route::get('{task?}/edit','Frontend\TaskController@edit')->name('task.edit');
    Route::delete('{task?}','Frontend\TaskController@destroy')->name('task.destroy');
    Route::get('{task?}/complete','Frontend\TaskController@complete')->name('task.complete');
    Route::get('{task?}','Frontend\TaskController@reComplete')->name('task.reComplete');

});
//==ket thuc==
