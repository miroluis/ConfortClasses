<?php
declare(strict_types=1);

namespace app\controller;

use app\controller\Login;
use app\model\Sensor;
use app\model\Dispositivo;
use app\model\UnidadeMedida;

class SensorController
{
    /**
     * Lista sensores de um dispositivo
     * GET index.php?a=sensores&id_dispositivo=1
     */
    public function index(): void
    {
        if (!Login::amIlogged()) {
            header('Location: index.php');
            exit;
        }

        $id_dispositivo = isset($_GET['id_dispositivo']) ? (int)$_GET['id_dispositivo'] : 0;
        if ($id_dispositivo <= 0) {
            header('Location: index.php?a=dispositivos');
            exit;
        }

        $dispositivo = Dispositivo::find($id_dispositivo);
        if (!$dispositivo) {
            header('Location: index.php?a=dispositivos');
            exit;
        }

        $sensores = Sensor::allByDispositivo($id_dispositivo);

        echo renderNtpl(
            'base',
            ['title' => 'Sensores'],
            'sensor_list',
            [
                0 => 'content',
                'id_dispositivo' => $id_dispositivo,
                'dispositivo' => $dispositivo,
                'sensores' => $sensores
            ]
        );
    }

    /**
     * Form criar
     * GET index.php?a=sensor_create&id_dispositivo=1
     */
    public function create(): void
    {
        if (!Login::amIlogged()) {
            header('Location: index.php');
            exit;
        }

        $id_dispositivo = isset($_GET['id_dispositivo']) ? (int)$_GET['id_dispositivo'] : 0;
        if ($id_dispositivo <= 0) {
            header('Location: index.php?a=dispositivos');
            exit;
        }

        $dispositivo = Dispositivo::find($id_dispositivo);
        if (!$dispositivo) {
            header('Location: index.php?a=dispositivos');
            exit;
        }

        $unidades = UnidadeMedida::all();

        echo renderNtpl(
            'base',
            ['title' => 'Novo Sensor'],
            'sensor_form',
            [
                0 => 'content',
                'mode' => 'create',
                'id_dispositivo' => $id_dispositivo,
                'dispositivo' => $dispositivo,
                'unidades' => $unidades,
                'sensor' => [
                    'id_sensor' => null,
                    'id_dispositivo' => $id_dispositivo,
                    'id_unidade' => '',
                    'nome' => '',
                    'tipo_sensor' => '',
                    'token' => '',
                    'ordem_leitura' => '',
                    'ativo' => 1
                ]
            ]
        );
    }

    /**
     * Guardar
     * POST index.php?a=sensor_store
     */
    public function store(): void
    {
        if (!Login::amIlogged()) {
            header('Location: index.php');
            exit;
        }

        $id_dispositivo = (int)($_POST['id_dispositivo'] ?? 0);
        $id_unidade = (int)($_POST['id_unidade'] ?? 0);

        $nome = trim((string)($_POST['nome'] ?? ''));
        $tipo = trim((string)($_POST['tipo_sensor'] ?? ''));
        $token = trim((string)($_POST['token'] ?? ''));
        $ordem = trim((string)($_POST['ordem_leitura'] ?? ''));
        $ativo = isset($_POST['ativo']) ? (int)$_POST['ativo'] : 1;

        $ordem_leitura = ($ordem === '') ? null : (int)$ordem;

        if ($id_dispositivo <= 0 || $id_unidade <= 0 || $token === '') {
            header('Location: index.php?a=sensor_create&id_dispositivo=' . $id_dispositivo);
            exit;
        }

        Sensor::create(
            $id_dispositivo,
            $id_unidade,
            $nome !== '' ? $nome : null,
            $tipo !== '' ? $tipo : null,
            $token,
            $ordem_leitura,
            $ativo
        );

        header('Location: index.php?a=sensores&id_dispositivo=' . $id_dispositivo);
        exit;
    }

    /**
     * Form editar
     * GET index.php?a=sensor_edit&id_sensor=1
     */
    public function edit(): void
    {
        if (!Login::amIlogged()) {
            header('Location: index.php');
            exit;
        }
                $id_sensor = isset($_GET['id_sensor']) ? (int)$_GET['id_sensor'] : 0;
        if ($id_sensor <= 0) {
            header('Location: index.php?a=dispositivos');
            exit;
        }

        $sensor = Sensor::find($id_sensor);
        if (!$sensor) {
            header('Location: index.php?a=dispositivos');
            exit;
        }

        $id_dispositivo = (int)$sensor['id_dispositivo'];
        $dispositivo = Dispositivo::find($id_dispositivo);
        if (!$dispositivo) {
            header('Location: index.php?a=dispositivos');
            exit;
        }

        $unidades = UnidadeMedida::all();

        echo renderNtpl(
            'base',
            ['title' => 'Editar Sensor'],
            'sensor_form',
            [
                0 => 'content',
                'mode' => 'edit',
                'id_dispositivo' => $id_dispositivo,
                'dispositivo' => $dispositivo,
                'unidades' => $unidades,
                'sensor' => $sensor
            ]
        );
    }

    /**
     * Atualizar
     * POST index.php?a=sensor_update&id_sensor=1
     */
    public function update(): void
    {
        if (!Login::amIlogged()) {
            header('Location: index.php');
            exit;
        }

        $id_sensor = isset($_GET['id_sensor']) ? (int)$_GET['id_sensor'] : 0;

        $id_dispositivo = (int)($_POST['id_dispositivo'] ?? 0);
        $id_unidade = (int)($_POST['id_unidade'] ?? 0);

        $nome = trim((string)($_POST['nome'] ?? ''));
        $tipo = trim((string)($_POST['tipo_sensor'] ?? ''));
        $token = trim((string)($_POST['token'] ?? ''));
        $ordem = trim((string)($_POST['ordem_leitura'] ?? ''));
        $ativo = isset($_POST['ativo']) ? (int)$_POST['ativo'] : 1;

        $ordem_leitura = ($ordem === '') ? null : (int)$ordem;

        if ($id_sensor <= 0 || $id_dispositivo <= 0 || $id_unidade <= 0 || $token === '') {
            header('Location: index.php?a=sensor_edit&id_sensor=' . $id_sensor);
            exit;
        }

        Sensor::update(
            $id_sensor,
            $id_dispositivo,
            $id_unidade,
            $nome !== '' ? $nome : null,
            $tipo !== '' ? $tipo : null,
            $token,
            $ordem_leitura,
            $ativo
        );

        header('Location: index.php?a=sensores&id_dispositivo=' . $id_dispositivo);
        exit;
    }

    /**
     * Apagar
     * GET index.php?a=sensor_delete&id_sensor=1
     */
    public function delete(): void
    {
        if (!Login::amIlogged()) {
            header('Location: index.php');
            exit;
        }

        $id_sensor = isset($_GET['id_sensor']) ? (int)$_GET['id_sensor'] : 0;
        $sensor = ($id_sensor > 0) ? Sensor::find($id_sensor) : null;

        if ($sensor) {
            $id_dispositivo = (int)$sensor['id_dispositivo'];
            Sensor::delete($id_sensor);
            header('Location: index.php?a=sensores&id_dispositivo=' . $id_dispositivo);
            exit;
        }

        header('Location: index.php?a=dispositivos');
        exit;
    }
}
