<?php



/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('task', ['uses' => 'Task\TaskController@index']);

$router->post('task', ['uses' => 'Task\TaskController@store']);

$router->get('task/{id}', ['uses' => 'Task\TaskController@show']);

$router->put('task/{id}', ['uses' => 'Task\TaskController@update']);

$router->delete('task/{id}', ['uses' => 'Task\TaskController@destroy']);

$router->get('search', ['uses' => 'Task\SearchTaskController']);

$router->get('filter', ['uses' => 'Task\FilterTaskController']);
