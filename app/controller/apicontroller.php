<?php
declare(strict_types=1);

namespace app\controller;

use app\model\Sensor;
use app\model\Leitura;

class ApiController
{
    /**
     * POST index.php?a=api_leitura
     * Body (form-data ou x-www-form-urlencoded):
     *  - token (obrigatório)
     *  - valor (obrigatório)
     *  - data_hora (opcional, default NOW)
     */
    public function leitura(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $token = trim((string)($_POST['token'] ?? ''));
        $valor_raw = trim((string)($_POST['valor'] ?? ''));
        $data_hora = trim((string)($_POST['data_hora'] ?? ''));

        if ($token === '' || $valor_raw === '' || !is_numeric($valor_raw)) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'token e valor são obrigatórios']);
            return;
        }

        $sensor = Sensor::findByToken($token);
        if (!$sensor) {
            http_response_code(404);
            echo json_encode(['ok' => false, 'error' => 'token inválido']);
            return;
        }

        if ($data_hora === '') {
            $data_hora = date('Y-m-d H:i:s');
        }

        $id = Leitura::create((int)$sensor['id_sensor'], (float)$valor_raw, $data_hora);

        echo json_encode([
            'ok' => true,
            'id_leitura' => $id,
            'id_sensor' => (int)$sensor['id_sensor'],
            'data_hora' => $data_hora
        ]);
    }
}
