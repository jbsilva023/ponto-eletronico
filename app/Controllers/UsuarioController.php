<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Usuarios;

class UsuarioController extends Controller
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $usuario = new Usuarios;
        $usuarios = $usuario->paginate(10, $page, ['id', 'DESC']);

        return $this->view('app.inicio', ['usuarios' => $usuarios['data'], 'paginator' => $usuarios['paginator']]);
    }

    public function show()
    {
        $id = $_POST['id'];
        $usuario = new Usuarios;
        $usuario = $usuario->find($id);

        return $this->view('app.form-update-usuario', ['usuario' => $usuario]);
    }

    public function create()
    {
        return $this->view('app.form-novo-usuario');
    }

    public function store()
    {
        $usuario = new Usuarios;

        try {
            $usuario->nome = $_POST['nome'];
            $usuario->email = $_POST['email'];
            $usuario->documento = Helper::unmask($_POST['documento']);
            $usuario->save();

            return [
                'title' => 'Sucesso!',
                'msg' => 'Registro cadastrado com sucesso.',
                'type' => 'success',
                'reload' => true,
            ];

        } catch (\Exception $e) {
            return [
                'title' => 'Erro!',
                'msg' => "Não foi possível cadastrar o registro. <br/>Erro: {$e->getMessage()}",
                'type' => 'error',
                'reload' => true,
            ];
        }
    }

    public function update()
    {
        $usuario = new Usuarios;
        $usuario = $usuario->find($_POST['id']);

        if ($usuario) {
            try {
                $usuario->nome = $_POST['nome'];
                $usuario->email = $_POST['email'];
                $usuario->documento = Helper::unmask($_POST['documento']);
                $usuario->save();

                return [
                    'title' => 'Sucesso!',
                    'msg' => 'Registro atualizado com sucesso.',
                    'type' => 'success',
                    'reload' => true
                ];

            } catch (\Exception $e) {
                return [
                    'title' => 'Erro!',
                    'msg' => "Não foi possível atualizar o registro. <br/>Erro: {$e->getMessage()}",
                    'type' => 'error',
                    'reload' => true
                ];
            }
        }

        return [
            'title' => 'Erro!',
            'msg' => "Não foi possível localizar o registro.",
            'type' => 'error',
            'reload' => true
        ];
    }

    public function delete()
    {
        $usuario = new Usuarios;
        $usuario = $usuario->find($_POST['id']);

        if ($usuario) {
            $usuario->delete();

            return [
                'title' => 'Sucesso!',
                'msg' => 'Registro removido com sucesso.',
                'type' => 'success',
                'reload' => true
            ];
        }

        return [
            'title' => 'Erro!',
            'msg' => "Não foi possível localizar o registro.",
            'type' => 'error',
            'reload' => true
        ];
    }
}
