<?php
$app->get('/', function () {
    header('Location: /inicio');
});

$app->get('/inicio', 'RegistroController@index');
$app->post('/registro/novo', 'RegistroController@create');
$app->post('/registro/inserir', 'RegistroController@store');
$app->post('/registro/detalhe', 'RegistroController@show');
$app->post('/registro/update', 'RegistroController@update');
$app->post('/registro/delete', 'RegistroController@delete');
$app->post('/arquivo/importar', 'RegistroController@importar');

$app->get('/usuario/novo', 'UsuarioController@create');
$app->post('/usuario/inserir', 'UsuarioController@store');
$app->post('/usuario/detalhe', 'UsuarioController@show');
$app->post('/usuario/update', 'UsuarioController@update');
$app->post('/usuario/delete', 'UsuarioController@delete');

