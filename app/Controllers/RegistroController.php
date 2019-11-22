<?php


namespace App\Controllers;


use App\Helpers\Helper;
use App\Models\Usuarios;
use App\Models\Registros;
use Carbon\Carbon;

class RegistroController extends Controller
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function index()
    {
        //$page = $_GET['page'] ?? 1;
        $registro = new Registros;
        $registros = $registro->registersForMoth();

        //$registros = $registro->paginate(10, $page, ['id', 'DESC']);

        return $this->view('app.inicio', [
            'registros' => $registros['data']
            //'paginator' => $registros['paginator']
        ]);
    }

    public function create()
    {
        return $this->view('app.form-novo-registro');
    }

    public function store()
    {
        $registro = new Registros;

        try {
            $registro->data = Helper::dataSql($_POST['data']);
            $registro->entrada = $_POST['entrada'];
            $registro->entrada_intervalo = $_POST['entrada_intervalo'];
            $registro->saida_intervalo = $_POST['saida_intervalo'];
            $registro->saida = $_POST['saida'];
            $registro->usuario_id = 1;
            $registro->save();

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

    public function show()
    {
        $registro = new Registros;
        $registro = $registro->find($_POST['id']);

        return $this->view('app.form-update-registro', ['registro' => $registro]);
    }

    public function update()
    {
        $registro = new Registros;
        $registro = $registro->find($_POST['id']);

        if ($registro) {
            try {
                $registro->entrada = $_POST['entrada'];
                $registro->entrada_intervalo = $_POST['entrada_intervalo'];
                $registro->saida_intervalo = $_POST['saida_intervalo'];
                $registro->saida = $_POST['saida'];
                $registro->save();

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

    /**
     * @return array
     */
    public function importar()
    {
        try {
            $data = [];
            $file = new \SplFileObject($_FILES["arquivo"]['tmp_name']);
            $i = 0;

            // Loop until we reach the end of the file.
            while (!$file->eof()) {
                // Echo one line from the file.
                $info = $file->fgets();

                $info =  explode('-', $info);

                $data[$i]['data'] = Helper::dataSql(trim($info[0]));
                $data[$i]['entrada'] = trim($info[1]);

                switch (count($info)) {
                    case 7:
                        $data[$i]['entrada_intervalo'] = trim($info[2]);
                        $data[$i]['saida_intervalo'] = trim($info[3]);
                        $data[$i]['saida'] = trim($info[6]);
                        break;
                    case 6:
                        $data[$i]['entrada_intervalo'] = trim($info[2]);
                        $data[$i]['saida_intervalo'] = trim($info[3]);
                        $data[$i]['saida'] = trim($info[5]);
                        break;
                    default:
                        $data[$i]['entrada_intervalo'] = trim($info[2]);
                        $data[$i]['saida_intervalo'] = trim($info[3]);
                        $data[$i]['saida'] = trim($info[4]);
                        break;
                }

                /*$data[$i]['entrada_intervalo'] = trim($info[2]);
                $data[$i]['saida_intervalo'] = trim($info[3]);
                $data[$i]['saida'] = trim($info[4]);*/

                $i++;
            }

            // Unset the file to call __destruct(), closing the file handle.
            $file = null;

            foreach ($data as $item) {
                $registro = new Registros;
                $registro->data = $item['data'];
                $registro->entrada = $item['entrada'];
                $registro->entrada_intervalo = $item['entrada_intervalo'];
                $registro->saida_intervalo = $item['saida_intervalo'];
                $registro->saida = $item['saida'];
                $registro->usuario_id = 1;
                //$registro->usuario_id = $_POST['usaurio_id'];
                $registro->save();
            }

            return [
                'title' => 'Sucesso!',
                'msg' => 'Registro importados com sucesso.',
                'type' => 'success',
                'reload' => true
            ];

        } catch (\Exception $e) {
            return [
                'title' => 'Erro!',
                'msg' => "Não foi possível importar os registros. <br/>{$e->getMessage()}",
                'type' => 'error',
                'reload'=> true
            ];
        }
    }
}