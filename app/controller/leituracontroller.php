<?php
declare(strict_types=1);

namespace app\controller;

use app\controller\Login;
use app\model\Leitura;
use app\model\Sensor;
use app\model\Dispositivo;

class LeituraController
{
    /**
     * Leituras por sensor
     * GET index.php?a=leituras&id_sensor=1
     */
    public function bySensor(): void
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

        $leituras = Leitura::lastBySensor($id_sensor, 50);

        echo renderNtpl(
            'base',
            ['title' => 'Leituras do Sensor'],
            'leitura_list',
            [
                0 => 'content',
                'modo' => 'sensor',
                'sensor' => $sensor,
                'leituras' => $leituras
            ]
        );
    }

    /**
     * Leituras por dispositivo (agregado)
     * GET index.php?a=leituras_dispositivo&id_dispositivo=1
     */
    public function byDispositivo(): void
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

        $leituras = Leitura::lastByDispositivo($id_dispositivo, 100);

        echo renderNtpl(
            'base',
            ['title' => 'Leituras do Dispositivo'],
            'leitura_list',
            [
                0 => 'content',
                'modo' => 'dispositivo',
                'dispositivo' => $dispositivo,
                'leituras' => $leituras
            ]
        );
    }
}
