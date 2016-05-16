<?php


Route::controller('auth/password', 'Auth\PasswordController', [
    'getEmail' => 'auth.password.email',
    'getReset' => 'auth.password.reset'
]);

Route::controller('auth', 'Auth\AuthController', [
    'getLogin' => 'auth.login',
    'getLogout' => 'auth.logout'
]);



Route::get('backend/users/{users}/confirm', ['as' => 'backend.users.confirm', 'uses' => 'Backend\UsersController@confirm']);
Route::resource('backend/users', 'Backend\UsersController', ['except' => ['show']]);

Route::get('backend/pages/{pages}/confirm', ['as' => 'backend.pages.confirm', 'uses' => 'Backend\PagesController@confirm']);
Route::resource('backend/pages', 'Backend\PagesController', ['except' => ['show']]);

Route::get('backend/blog/{blog}/confirm', ['as' => 'backend.blog.confirm', 'uses' => 'Backend\BlogController@confirm']);
Route::resource('backend/blog', 'Backend\BlogController');

Route::get('backend/dashboard', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);

Route::get('frontend/dashboard', ['as' => 'frontend.dashboard', 'uses' => 'Frontend\DashboardController@index']);
Route::post('frontend/dashboard/update_acceptance', ['as' => 'frontend.dashboard.ajax', 'uses' => 'Frontend\DashboardController@updateOpinionAcceptance']);
Route::get('backend/categories/index', ['as' => 'backend.categories.index', 'uses' => 'Backend\CategoriesController@index']);
Route::get('backend/categories/form', ['as' => 'backend.categories.form', 'uses' => 'Backend\CategoriesController@form']);
Route::post('backend/categories/add-categories', ['as' => 'backend.categories.add', 'uses' => 'Backend\CategoriesController@addCategories']);
Route::get('backend/categories/edit-categories/{id}', ['as' => 'backend.categories.edit', 'uses' => 'Backend\CategoriesController@editCategories']);
Route::post('backend/categories/delete-categories', ['as' => 'backend.categories.delete', 'uses' => 'Backend\CategoriesController@deleteCategories']);
Route::post('frontend/dashboard/tag', ['as' => 'frontend.dashboard.tag', 'uses' => 'Frontend\DashboardController@tag']);
Route::post('frontend/dashboard/categories', ['as' => 'frontend.dashboard.categories', 'uses' => 'Backend\CategoriesController@allCategories']);
Route::post('frontend/dashboard/opinion', ['as' => 'frontend.dashboard.tag.category', 'uses' => 'Backend\CategoriesController@saveOpinion']);
Route::get('frontend/profile', ['as' => 'frontend.profile', 'uses' => 'Frontend\DashboardController@profile']);
Route::get('frontend/profile/edit', ['as' => 'frontend.profile.edit', 'uses' => 'Frontend\DashboardController@profileEdit']);