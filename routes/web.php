<?php

use App\Http\Controllers\Admin\AccessDeniedController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\CategoriaProjetoController;
use App\Http\Controllers\Admin\CategoriaProposicaoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmendaController;
use App\Http\Controllers\Admin\OrganogramaController;
use App\Http\Controllers\Site\PostController as SitePostController;
use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\Admin\ProposicaoController;
use App\Http\Controllers\Admin\PaginaInicialController as PaginaInicialContentController;
use App\Http\Controllers\Admin\ProjetoController;
use App\Http\Controllers\Admin\ImportarProposicaoController;
use App\Http\Controllers\Site\PaginaInicialController;
use App\Http\Controllers\Site\OrganogramaController as SiteOrganogramaController;
use App\Http\Controllers\Site\ProposicoesController as SiteProposicoesController;
use App\Http\Controllers\Admin\ServicoController;
use App\Http\Controllers\Admin\PaginaController;
use App\Http\Controllers\Site\PaginaController as SitePaginaController;
use App\Http\Controllers\Site\AgendaController as SiteAgendaController;
use App\Http\Controllers\Site\EmendasController;
use App\Http\Controllers\Admin\DenunciaController;
use App\Http\Controllers\Admin\CategoriaDenunciaController;
use App\Http\Controllers\Admin\AudienciaPublicaController;
use App\Http\Controllers\Site\DenunciasController as SiteDenunciasController;

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



// Route::get('/', function () {
//     return view('welcome');
// })->name('home')->middleware('websiteglobal');

Route::get('/',[PaginaInicialController::class, 'index'])->name('home')->middleware('websiteglobal');

Route::get('/agenda',[SiteAgendaController::class, 'index'])->name('site.agenda')->middleware('websiteglobal');
Route::get('/agenda/eventos',[SiteAgendaController::class, 'eventos'])->name('site.agenda.eventos')->middleware('websiteglobal');
//get evento by id
Route::get('/agenda/evento/{id?}',[SiteAgendaController::class, 'evento'])->name('site.agenda.evento')->middleware('websiteglobal');

//get pagina by slug
Route::get('/pagina/{slug?}',[SitePaginaController::class, 'index'])->name('site.pagina')->middleware('websiteglobal');
//index organograma
Route::get('/organograma',[SiteOrganogramaController::class, 'index'])->name('site.organograma')->middleware('websiteglobal');
//index proposicoes
Route::get('/proposicoes',[SiteProposicoesController::class, 'index'])->name('site.proposicoes')->middleware('websiteglobal');
//Proposicoes por categoria
Route::get('/proposicoes/{slug}',[SiteProposicoesController::class, 'porCategoria'])->name('site.proposicoes.por-categoria')->middleware('websiteglobal');

//denuncias
Route::get('/denuncias',[SiteDenunciasController::class, 'index'])->name('site.denuncias')->middleware('websiteglobal');
Route::post('/denuncias/save',[SiteDenunciasController::class, 'save'])->name('site.denuncias.save')->middleware('websiteglobal');

Route::get('/emendas',[EmendasController::class, 'index'])->name('site.emenda')->middleware('websiteglobal');

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

//categorias de proposição
Route::get('/categoria-proposicao',[CategoriaProposicaoController::class, 'index'])->name('admin.categoria-proposicao')->middleware('authpermission:Administrador');
//create a route to save a category model using CategoryController
Route::post('/categoria-proposicao/save',[CategoriaProposicaoController::class, 'save'])->name('admin.categoria-proposicao.save')->middleware('authpermission:Administrador');

Route::get('/categoria-proposicao/data_table',[CategoriaProposicaoController::class, 'data_table'])->name('admin.categoria-proposicao.data_table')->middleware('authpermission:Administrador');
//create a route to delete a category
Route::get('/categoria-proposicao/delete/{id?}',[CategoriaProposicaoController::class, 'delete'])->name('admin.categoria-proposicao.delete')->middleware('authpermission:Administrador');
//create a route to edit a category
Route::get('/categoria-proposicao/edit/{id?}',[CategoriaProposicaoController::class, 'edit'])->name('admin.categoria-proposicao.edit')->middleware('authpermission:Administrador');
//create a route to update a category
Route::post('/categoria-proposicao/update',[CategoriaProposicaoController::class, 'update'])->name('admin.categoria-proposicao.update')->middleware('authpermission:Administrador');


//categorias de proposição
Route::get('/agenda',[AgendaController::class, 'index'])->name('admin.agenda')->middleware('authpermission:Administrador');
//create a route to save a category model using CategoryController
Route::post('/agenda/save',[AgendaController::class, 'save'])->name('admin.agenda.save')->middleware('authpermission:Administrador');

Route::get('/agenda/data_table',[AgendaController::class, 'data_table'])->name('admin.agenda.data_table')->middleware('authpermission:Administrador');
//create a route to delete a category
Route::get('/agenda/delete/{id?}',[AgendaController::class, 'delete'])->name('admin.agenda.delete')->middleware('authpermission:Administrador');
//create a route to edit a category
Route::get('/agenda/edit/{id?}',[AgendaController::class, 'edit'])->name('admin.agenda.edit')->middleware('authpermission:Administrador');
//create a route to update a category
Route::post('/agenda/update',[AgendaController::class, 'update'])->name('admin.agenda.update')->middleware('authpermission:Administrador');



$tipos_pagina = [
        (object)['nome' => 'projeto', 'controller' =>ProjetoController::class], 
        (object)['nome' => 'servico', 'controller' =>ServicoController::class], 
        (object)['nome' => 'pagina', 'controller' =>PaginaController::class], 
    ];
foreach($tipos_pagina as $tipo_pagina){
//Projetos
    Route::get('/'.$tipo_pagina->nome.'s',[$tipo_pagina->controller, 'index'])->name('admin.'.$tipo_pagina->nome)->middleware('authpermission:Administrador');
    Route::get('/'.$tipo_pagina->nome.'s/new',[$tipo_pagina->controller, 'new'])->name('admin.'.$tipo_pagina->nome.'.new')->middleware('authpermission:Administrador');
    //route that saves a post
    Route::post('/'.$tipo_pagina->nome.'s/save',[$tipo_pagina->controller, 'save'])->name('admin.'.$tipo_pagina->nome.'.save')->middleware('authpermission:Administrador');
    //post route to datatable posts
    Route::get('/'.$tipo_pagina->nome.'s/data_table',[$tipo_pagina->controller, 'data_table'])->name('admin.'.$tipo_pagina->nome.'.data_table')->middleware('authpermission:Administrador');
    //route that edits a post
    Route::get('/'.$tipo_pagina->nome.'s/edit/{id?}',[$tipo_pagina->controller, 'edit'])->name('admin.'.$tipo_pagina->nome.'.edit')->middleware('authpermission:Administrador');
    //route that updates a post
    Route::post('/'.$tipo_pagina->nome.'s/update',[$tipo_pagina->controller, 'update'])->name('admin.'.$tipo_pagina->nome.'.update')->middleware('authpermission:Administrador');
    //route that deletes a post
    Route::get('/'.$tipo_pagina->nome.'s/delete/{id?}',[$tipo_pagina->controller, 'delete'])->name('admin.'.$tipo_pagina->nome.'.delete')->middleware('authpermission:Administrador');
}
//create a route to list categories
Route::get('/categoria-projeto',[CategoriaProjetoController::class, 'index'])->name('admin.categoria-projeto')->middleware('authpermission:Administrador');
//create a route to save a category model using CategoryController
Route::post('/categoria-projeto/save',[CategoriaProjetoController::class, 'save'])->name('admin.categoria-projeto.save')->middleware('authpermission:Administrador');

//create a route to datatable categories
Route::get('/categoria-projeto/data_table',[CategoriaProjetoController::class, 'data_table'])->name('admin.categoria-projeto.data_table')->middleware('authpermission:Administrador');
//create a route to delete a category
Route::get('/categoria-projeto/delete/{id?}',[CategoriaProjetoController::class, 'delete'])->name('admin.categoria-projeto.delete')->middleware('authpermission:Administrador');
//create a route to edit a category
Route::get('/categoria-projeto/edit/{id?}',[CategoriaProjetoController::class, 'edit'])->name('admin.categoria-projeto.edit')->middleware('authpermission:Administrador');
//create a route to update a category
Route::post('/categoria-projeto/update',[CategoriaProjetoController::class, 'update'])->name('admin.categoria-projeto.update')->middleware('authpermission:Administrador');
//EndProjetos

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

//listar denuncias
Route::get('/denuncia',[DenunciaController::class, 'index'])->name('admin.denuncia')->middleware('authpermission:Administrador');
//cadastrar denuncia
Route::get('/denuncia/new',[DenunciaController::class, 'new'])->name('admin.denuncia.new')->middleware('authpermission:Administrador');
//salvar denuncia
Route::post('/denuncia/save',[DenunciaController::class, 'save'])->name('admin.denuncia.save')->middleware('authpermission:Administrador');
//datatable para listar denuncia
Route::get('/denuncia/data_table',[DenunciaController::class, 'data_table'])->name('admin.denuncia.data_table')->middleware('authpermission:Administrador');
//editar denuncia
Route::get('/denuncia/edit/{id?}',[DenunciaController::class, 'edit'])->name('admin.denuncia.edit')->middleware('authpermission:Administrador');
//atualizar denuncia
Route::post('/denuncia/update',[DenunciaController::class, 'update'])->name('admin.denuncia.update')->middleware('authpermission:Administrador');
//deletar denuncia
Route::get('/denuncia/delete/{id?}',[DenunciaController::class, 'delete'])->name('admin.denuncia.delete')->middleware('authpermission:Administrador');
//download arquivo denuncia
Route::get('/denuncia/arquivo/{id}',[DenunciaController::class, 'download_arquivo'])->name('admin.denuncia.download_arquivo')->middleware('authpermission:Administrador');

//categorias de denúncia
Route::get('/categoria-denuncia',[CategoriaDenunciaController::class, 'index'])->name('admin.categoria-denuncia')->middleware('authpermission:Administrador');
//salvar categoria de denúncia
Route::post('/categoria-denuncia/save',[CategoriaDenunciaController::class, 'save'])->name('admin.categoria-denuncia.save')->middleware('authpermission:Administrador');
//datatable categorias de denúncia
Route::get('/categoria-denuncia/data_table',[CategoriaDenunciaController::class, 'data_table'])->name('admin.categoria-denuncia.data_table')->middleware('authpermission:Administrador');
//deletar categoria de denúncia
Route::get('/categoria-denuncia/delete/{id?}',[CategoriaDenunciaController::class, 'delete'])->name('admin.categoria-denuncia.delete')->middleware('authpermission:Administrador');
//editar categoria de denúncia
Route::get('/categoria-denuncia/edit/{id?}',[CategoriaDenunciaController::class, 'edit'])->name('admin.categoria-denuncia.edit')->middleware('authpermission:Administrador');
//atualizar categoria de denúncia
Route::post('/categoria-denuncia/update',[CategoriaDenunciaController::class, 'update'])->name('admin.categoria-denuncia.update')->middleware('authpermission:Administrador');

//audiências públicas
Route::get('/audiencia-publica',[AudienciaPublicaController::class, 'index'])->name('admin.audiencia-publica')->middleware('authpermission:Administrador');
//nova audiência pública
Route::get('/audiencia-publica/new',[AudienciaPublicaController::class, 'new'])->name('admin.audiencia-publica.new')->middleware('authpermission:Administrador');
//salvar audiência pública
Route::post('/audiencia-publica/save',[AudienciaPublicaController::class, 'save'])->name('admin.audiencia-publica.save')->middleware('authpermission:Administrador');
//datatable audiências públicas
Route::get('/audiencia-publica/data_table',[AudienciaPublicaController::class, 'data_table'])->name('admin.audiencia-publica.data_table')->middleware('authpermission:Administrador');
//editar audiência pública
Route::get('/audiencia-publica/edit/{id?}',[AudienciaPublicaController::class, 'edit'])->name('admin.audiencia-publica.edit')->middleware('authpermission:Administrador');
//atualizar audiência pública
Route::post('/audiencia-publica/update',[AudienciaPublicaController::class, 'update'])->name('admin.audiencia-publica.update')->middleware('authpermission:Administrador');
//deletar audiência pública
Route::get('/audiencia-publica/delete/{id?}',[AudienciaPublicaController::class, 'delete'])->name('admin.audiencia-publica.delete')->middleware('authpermission:Administrador');
//download documento audiência pública
Route::get('/audiencia-publica/documento/{id}',[AudienciaPublicaController::class, 'download_documento'])->name('admin.audiencia-publica.download_documento')->middleware('authpermission:Administrador');

//listar proposicoes
Route::get('/emenda',[EmendaController::class, 'index'])->name('admin.emenda')->middleware('authpermission:Administrador');
//cadastrar proposicao
Route::get('/emenda/new',[EmendaController::class, 'new'])->name('admin.emenda.new')->middleware('authpermission:Administrador');
//salvar proposicao
Route::post('/emenda/save',[EmendaController::class, 'save'])->name('admin.emenda.save')->middleware('authpermission:Administrador');
//datatable para listar proposicao
Route::get('/emenda/data_table',[EmendaController::class, 'data_table'])->name('admin.emenda.data_table')->middleware('authpermission:Administrador');
//editar proposicao
Route::get('/emenda/edit/{id?}',[EmendaController::class, 'edit'])->name('admin.emenda.edit')->middleware('authpermission:Administrador');
//atualizar proposicao
Route::post('/emenda/update',[EmendaController::class, 'update'])->name('admin.emenda.update')->middleware('authpermission:Administrador');
//deletar proposicao
Route::get('/emenda/delete/{id?}',[EmendaController::class, 'delete'])->name('admin.emenda.delete')->middleware('authpermission:Administrador');



//ImportarProposicaoController
Route::get('/importar-proposicao',[ImportarProposicaoController::class, 'index'])->name('admin.importar-proposicao')->middleware('authpermission:Administrador');
//ImportarProposicaoController processar
Route::post('/importar-proposicao/processar',[ImportarProposicaoController::class, 'processarArquivoCSV'])->name('admin.importar-proposicao.processar')->middleware('authpermission:Administrador');



//get pagina inicial
Route::get('/pagina_inicial',[PaginaInicialContentController::class, 'index'])->name('admin.pagina_inicial')->middleware('authpermission:Administrador');
//save pagina inicial
Route::post('/pagina_inicial/save',[PaginaInicialContentController::class, 'save'])->name('admin.pagina_inicial.save')->middleware('authpermission:Administrador');





});

//route to get a image by name
Route::get('/file/image/{name?}',[FileController::class, 'getImage'])->name('admin.file.get_image');
