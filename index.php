<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
session_start();

use CoffeeCode\Router\Router;


function site(): string {
    return "http://{$_SERVER['HTTP_HOST']}/projetopwhubi/indiehub";
}


$router = new Router(site());


$router->namespace("Source\\Controllers\\Web");
$router->group(null);
$router->get('/',           "WebController:home",      'web.home');
$router->get('/jogo/{id}',  "WebController:jogo",      'web.jogo');
$router->get('/registro',   "WebController:registro",  'web.registro');
$router->get('/login',      "WebController:login",     'web.login');
$router->get('/sobre',      "WebController:sobre",     'web.sobre');
$router->get('/faq',        "WebController:faq",       'web.faq');
$router->get('/carrinho',   "WebController:carrinho",  'web.carrinho');


$router->namespace("Source\\Controllers\\App");
$router->group('app');
$router->get('/',        "AppController:dashboard", 'app.dashboard');
$router->get('/submit',  "AppController:showForm",  'app.submitForm');
$router->post('/submit', "AppController:submit",    'app.submit');

$router->namespace("Source\\Controllers\\Admin");
$router->group('adm');


$router->get('/',                         "AdminController:dashboard",     'adm.dashboard');
$router->get('/produtos',                 "AdminController:produtos",      'adm.produtos');
$router->post('/produtos/aceitar/{id}',   "AdminController:aceitar",       'adm.aceitar');
$router->post('/produtos/rejeitar/{id}',  "AdminController:rejeitar",      'adm.rejeitar');

$router->get('/jogos',                    "AdminController:jogos",         'adm.jogos');
$router->get('/jogos/criar',              "AdminController:formJogo",      'adm.jogos.criar');
$router->post('/jogos/criar',             "AdminController:criarJogo",     'adm.jogos.criar.post');
$router->get('/jogos/editar/{id}',        "AdminController:editarJogo",    'adm.jogos.editar');
$router->post('/jogos/atualizar',         "AdminController:atualizarJogo",'adm.jogos.atualizar');
$router->post('/jogos/deletar',           "AdminController:deletarJogo",   'adm.jogos.deletar');

$router->namespace("Source\\Controllers\\Api");
$router->group('api');
$router->get('/games',           "GamesApi:index",    'api.games.index');
$router->get('/games/{id}',      "GamesApi:show",     'api.games.show');
$router->post('/games',          "GamesApi:create",   'api.games.create');
$router->put('/games/{id}',      "GamesApi:update",   'api.games.update');
$router->delete('/games/{id}',   "GamesApi:delete",   'api.games.delete');
$router->post('/users/register', "UsersApi:register", 'api.users.register');
$router->post('/users/login',    "UsersApi:login",    'api.users.login');
$router->get('/users/me',        "UsersApi:me",       'api.users.me');


$router->get('/products',                    'Api\\GamesApi:all');
$router->get('/products/product/{id}',       'Api\\GamesApi:find');
$router->post('/products',                   'Api\\GamesApi:store');
$router->put('/products/product/{id}',       'Api\\GamesApi:update');
$router->delete('/products/product/{id}',    'Api\\GamesApi:destroy');


$router->namespace("Source\\Controllers");
$router->group(null);
$router->post('/registro', "AuthController:register", 'auth.register');
$router->post('/login',    "AuthController:login",    'auth.login');
$router->get('/logout',    "AuthController:logout",   'auth.logout');


$router->group('ops');
$router->get('/{errcode}', "WebController:error",       'web.error');


$router->dispatch();


if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
    exit;
}
