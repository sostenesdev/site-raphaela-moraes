<?php

use App\Http\Controllers\Admin\AccessDeniedController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrganogramaController;
use App\Http\Controllers\Site\PostController as SitePostController;
use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\Admin\ProposicaoController;
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
    return view('welcome');
})->name('home')->middleware('websiteglobal');

//route to get post by slug
Route::get('/post/{slug?}',[SitePostController::class, 'post'])->name('site.post')->middleware('websiteglobal');
//get posts by category
Route::get('/ultimos-posts',[SitePostController::class, 'latestPosts'])->name('site.latest-posts')->middleware('websiteglobal');
Route::get('/categoria/{slug?}',[SitePostController::class, 'postsByCategory'])->name('site.category')->middleware('websiteglobal');
//route that searchs a post by title
Route::get('/search',[SitePostController::class, 'search'])->name('site.search')->middleware('websiteglobal');
//route to get the birth chart form
// Route::get('/mapa-astral',[BirthChartController::class, 'birthChart'])->name('site.birth-chart')->middleware('websiteglobal');
//get arquivo by id
// Route::get('/arquivo/{id}',[ArquivoController::class, 'getById'])->name('site.arquivo_by_id')->middleware('websiteglobal');
Route::get('/arquivo/{nome}',[ArquivoController::class, 'getByName'])->name('site.arquivo')->middleware('websiteglobal');




Route::prefix('admin')->group(function(){
Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/login',[LoginController::class, 'authenticate'])->name('admin.login.authenticate');
Route::get('/logout',[LogoutController::class, 'perform'])->name('admin.logout');
Route::get('/',[DashboardController::class, 'index'])->name('admin.dashboard')->middleware('authpermission:Administrador');
Route::get('/access_denied',[AccessDeniedController::class, 'index'])->name('admin.access_denied');
Route::get('/user',[UserController::class, 'index'])->name('admin.user')->middleware('authpermission:Administrador');
Route::get('/user/data_table',[UserController::class, 'data_table'])->name('admin.user.data_table')->middleware('authpermission:Administrador');
//create a route to save the image
Route::post('/file/save_image',[FileController::class, 'saveImage'])->name('admin.user.save_image')->middleware('authpermission:Administrador');

Route::get('/posts',[PostController::class, 'index'])->name('admin.posts')->middleware('authpermission:Administrador');
Route::get('/posts/new',[PostController::class, 'new'])->name('admin.posts.new')->middleware('authpermission:Administrador');
//route that saves a post
Route::post('/posts/save',[PostController::class, 'save'])->name('admin.posts.save')->middleware('authpermission:Administrador');
//post route to datatable posts
Route::get('/posts/data_table',[PostController::class, 'data_table'])->name('admin.posts.data_table')->middleware('authpermission:Administrador');
//route that edits a post
Route::get('/posts/edit/{id?}',[PostController::class, 'edit'])->name('admin.posts.edit')->middleware('authpermission:Administrador');
//route that updates a post
Route::post('/posts/update',[PostController::class, 'update'])->name('admin.posts.update')->middleware('authpermission:Administrador');
//route that deletes a post
Route::get('/posts/delete/{id?}',[PostController::class, 'delete'])->name('admin.posts.delete')->middleware('authpermission:Administrador');
//create a route to list categories
Route::get('/category',[CategoryController::class, 'index'])->name('admin.categories')->middleware('authpermission:Administrador');
//create a route to save a category model using CategoryController
Route::post('/category/save',[CategoryController::class, 'save'])->name('admin.categories.save')->middleware('authpermission:Administrador');

//create a route to datatable categories
Route::get('/category/data_table',[CategoryController::class, 'data_table'])->name('admin.categories.data_table')->middleware('authpermission:Administrador');
//create a route to delete a category
Route::get('/category/delete/{id?}',[CategoryController::class, 'delete'])->name('admin.categories.delete')->middleware('authpermission:Administrador');
//create a route to edit a category
Route::get('/category/edit/{id?}',[CategoryController::class, 'edit'])->name('admin.categories.edit')->middleware('authpermission:Administrador');
//create a route to update a category
Route::post('/category/update',[CategoryController::class, 'update'])->name('admin.categories.update')->middleware('authpermission:Administrador');
//route to save an image
Route::post('/file/save_image',[FileController::class, 'saveImage'])->name('admin.file.save_image')->middleware('authpermission:Administrador');
//ro to save a user
Route::post('/user/save',[UserController::class, 'save'])->name('admin.user.save')->middleware('authpermission:Administrador');
//route to update a user
Route::post('/user/update',[UserController::class, 'update'])->name('admin.user.update')->middleware('authpermission:Administrador');
//delete a user
Route::get('/user/delete/{id?}',[UserController::class, 'delete'])->name('admin.user.delete')->middleware('authpermission:Administrador');
//edit user
Route::get('/user/edit/{id?}',[UserController::class, 'edit'])->name('admin.user.edit')->middleware('authpermission:Administrador');

//listar organogramas
Route::get('/organograma',[OrganogramaController::class, 'index'])->name('admin.organograma')->middleware('authpermission:Administrador');
//cadastrar organograma
Route::get('/organograma/new',[OrganogramaController::class, 'new'])->name('admin.organograma.new')->middleware('authpermission:Administrador');
//salvar organograma
Route::post('/organograma/save',[OrganogramaController::class, 'save'])->name('admin.organograma.save')->middleware('authpermission:Administrador');
//datatable para listar organograma
Route::get('/organograma/data_table',[OrganogramaController::class, 'data_table'])->name('admin.organograma.data_table')->middleware('authpermission:Administrador');
//editar organograma
Route::get('/organograma/edit/{id?}',[OrganogramaController::class, 'edit'])->name('admin.organograma.edit')->middleware('authpermission:Administrador');
//route that updates a post
Route::post('/organograma/update',[OrganogramaController::class, 'update'])->name('admin.organograma.update')->middleware('authpermission:Administrador');
//route that deletes a post
Route::get('/organograma/delete/{id?}',[OrganogramaController::class, 'delete'])->name('admin.organograma.delete')->middleware('authpermission:Administrador');

//listar proposicoes
Route::get('/proposicao',[ProposicaoController::class, 'index'])->name('admin.proposicao')->middleware('authpermission:Administrador');
//cadastrar proposicao
Route::get('/proposicao/new',[ProposicaoController::class, 'new'])->name('admin.proposicao.new')->middleware('authpermission:Administrador');
//salvar proposicao
Route::post('/proposicao/save',[ProposicaoController::class, 'save'])->name('admin.proposicao.save')->middleware('authpermission:Administrador');
//datatable para listar proposicao
Route::get('/proposicao/data_table',[ProposicaoController::class, 'data_table'])->name('admin.proposicao.data_table')->middleware('authpermission:Administrador');
//editar proposicao
Route::get('/proposicao/edit/{id?}',[ProposicaoController::class, 'edit'])->name('admin.proposicao.edit')->middleware('authpermission:Administrador');
//atualizar proposicao
Route::post('/proposicao/update',[ProposicaoController::class, 'update'])->name('admin.proposicao.update')->middleware('authpermission:Administrador');
//deletar proposicao
Route::get('/proposicao/delete/{id?}',[ProposicaoController::class, 'delete'])->name('admin.proposicao.delete')->middleware('authpermission:Administrador');


});

//route to get a image by name
Route::get('/file/image/{name?}',[FileController::class, 'getImage'])->name('admin.file.get_image');
