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

use App\Post;
use Elasticsearch\ClientBuilder;

Route::resource('Task', 'TaskController');
Route::resource('/pdf', 'pdfController');
Route::get('/mysql', 'MysqlController@index');
Route::get('/word', 'WordController@index');
Route::get('/maps', 'MapsController@index');
Route::get('/search/search', 'SearchController@search');
Route::resource('/search', 'SearchController');
Route::get('/elastic/api', 'ElasticController@api');
Route::resource('/elastic', 'ElasticController');
Route::resource('/udemy', 'UdemySearchController');

Route::get('/', function () {
    
    
    $posts = Post::all();
    $client = ClientBuilder::create()->build();
    echo Post::count();

//    foreach ($posts as $i => $post) {
//        echo $post->title . '<hr>';
//        $params = [
//            'index' => 'post_index',
//            'type' => 'post_type',
//            'id' => $post->id,
//            'body' => [
//                'user_id' => $post->user_id,
//                'title' => $post->title,
//                'body' => $post->body,
//            ],
//        ];
//        $response = $client->index($params);
//        echo $response['created'] .'Number: ' . $i .'<br>';
//    };


//    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
