<?php
declare(strict_types=1);

namespace app\controller;

use app\controller\Login;

use app\model\Dispositivo;
use app\model\Sala;

class DispositivoController
{
    /**
     * Lista dispositivos (opcionalmente filtrados por sala)
     * GET index.php?a=dispositivos&id_sala=1
     */
    public function index(): void
    {
       if(!Login::amIlogged()){
            header('Location: index.php');
            exit;
        }

        $id_sala = isset($_GET['id_sala']) ? (int) $_GET['id_sala'] : 0;
        
        $salas = Sala::all();
        $dispositivos = $id_sala > 0 
            ? Dispositivo::allBySala($id_sala) 
            : Dispositivo::all();

        echo renderNtpl(
                'base', ['title' => 'Dispositivos'],
                'dispositivo_list', 
                [
                    0 => 'content',
                    'salas' => $salas, 
                    'id_sala' => $id_sala,
                    'dispositivos' => $dispositivos
                ]
        );
    }

    /**
     * Form criar
     * GET index.php?a=dispositivo_create&id_sala=1
     */
    public function create(): void
    {
        if(!Login::amIlogged()){
            header('Location: index.php');
            exit;
        }

        $id_sala = isset($_GET['id_sala']) ? (int) $_GET['id_sala'] : 0;

        echo renderNtpl(
            'base', ['title' => 'Novo Dispositivo'],
            'dispositivo_form',
            [
                0 => 'content',
                'mode' => 'create',
                'salas' => Sala::all(),
                'id_sala' => $id_sala,
                'dispositivo' => [
                    'id_dispositivo' => null,
                    'id_sala' => $id_sala,
                    'nome' => '',
                    'descricao' => '',
                    'mac_address' => '',
                    'ativo' => 1
                ]
            ]
        );
    }


    /**
     * Guardar
     * POST index.php?a=dispositivo_store
     */
    public function store(): void
    {
        if(!Login::amIlogged()){
            header('Location: index.php');
            exit;
        }

        
        $id_sala = (int)($_POST['id_sala'] ?? 0);
        $nome = trim((string)($_POST['nome'] ?? ''));
        $descricao = trim($_POST['descricao'] ?? '');
        $mac = trim($_POST['mac_address'] ?? '');
        $ativo = isset($_POST['ativo']) ? (int) $_POST['ativo'] : 1;

        if($id_sala <= 0 || $nome === ''){
            // Erro! Simples, volta ao form
            header('Location: index.php?a=dispositivo_create&id_sala=' . $id_sala);
            exit;
        }

        Dispositivo::create(
            $id_sala,
            $nome,
            $descricao !== '' ? $descricao : null,
            $mac !== '' ? $mac : null,
            $ativo
        );

        header('Location: index.php?a=dispositivos&id_sala=' . $id_sala);
        exit;
    }

    /**
     * Form editar
     * GET index.php?a=dispositivo_edit&id_dispositivo=1
     */
    public function edit(): void
    {   
        if(!Login::amIlogged()){
            header('Location: index.php');
            exit;
        }

        $id_dispositivo = isset($_GET['id_dispositivo']) ? (int) $_GET['id_dispositivo'] : 0;
        $dispositivo = $id_dispositivo > 0 
            ? Dispositivo::find($id_dispositivo) 
            : null;
        
        if (!$dispositivo) {
            // Dispositivo não encontrado
            header('Location: index.php?a=dispositivos');
            exit;
        }

        echo renderNtpl(
            'base', ['title' => 'Editar Dispositivo'],
            'dispositivo_form',
            [
                0 => 'content',
                'mode' => 'edit',
                'salas' => Sala::all(),
                'id_sala' => (int)$dispositivo['id_sala'],
                'dispositivo' => $dispositivo
            ]
        );

    }

    /**
     * Atualizar
     * POST index.php?a=dispositivo_update&id_dispositivo=1
     */

    public function update(): void
    {   
        if(!Login::amIlogged()){
            header('Location: index.php');
            exit;
        }

        $id_dispositivo = isset($_GET['id_dispositivo']) ? (int) $_GET['id_dispositivo'] : 0;
        
        $id_sala = (int)($_POST['id_sala'] ?? 0);
        $nome = trim((string)($_POST['nome'] ?? ''));
        $descricao = trim($_POST['descricao'] ?? '');
        $mac = trim($_POST['mac_address'] ?? '');
        $ativo = isset($_POST['ativo']) ? (int) $_POST['ativo'] : 1;

        if($id_dispositivo <= 0 || $id_sala <= 0 || $nome === ''){
            // Erro! Simples, volta ao form
            header('Location: index.php?a=dispositivo_edit&id_dispositivo=' . $id_dispositivo);
            exit;
        }

        Dispositivo::update(
            $id_dispositivo,
            $id_sala,
            $nome,
            $descricao !== '' ? $descricao : null,
            $mac !== '' ? $mac : null,
            $ativo
        );

        header('Location: index.php?a=dispositivos&id_sala=' . $id_sala);
        exit;
    }


    /**
     * Apagar dispositivo
     * GET index.php?a=dispositivo_delete&id_dispositivo=1
     */
    public function delete(): void
    {
        if(!Login::amIlogged()){
            header('Location: index.php');
            exit;
        }

        $id_dispositivo = isset($_GET['id_dispositivo']) ? (int) $_GET['id_dispositivo'] : 0;

        $dispositivo = $id_dispositivo > 0 
            ? Dispositivo::find($id_dispositivo) 
            : null;

        if ($dispositivo) {
            Dispositivo::delete($id_dispositivo);
            $id_sala = $dispositivo['id_sala'];
            header('Location: index.php?a=dispositivos&id_sala=' . $id_sala);
            exit;
        }

        header('Location: index.php?a=dispositivos');
        exit;
    }

}




?>