<?php

namespace app\controller;

class SalaController
{
    /**
     * Lista salas de uma empresa
     * GET index.php?a=salas&id_empresa=XX
     */
    public function index(): void
    {
        $id_empresa = isset($_GET['id_empresa']) ? (int) $_GET['id_empresa'] : 0;
        if ($id_empresa <= 0) {
            header('Location: index.php?a=empresas');
            exit;
        }
        $salas = \app\model\Sala::allByEmpresa($id_empresa);

        echo renderNtpl(
            'base', ['title' => 'Salas'],
            'sala_list', [0 => 'content', 'salas' => $salas, 'id_empresa' => $id_empresa]
        );
    }

    /**
     * Mostra formulário
     * GET index.php?a=sala_create&id_empresa=XX
     */
    public function create(): void
    {
        $id_empresa = isset($_GET['id_empresa']) ? (int) $_GET['id_empresa'] : 0;
        if ($id_empresa <= 0) {
            header('Location: index.php?a=empresas');
            exit;
        }

        echo renderNtpl(
            'base', ['title' => 'Criar Sala'],
            'sala_form',
             [
                0 => 'content',
                'action' => 'sala_store',
                'id_empresa' => $id_empresa,
                'sala' => ['nome' => ''],
                'errors' => []
             ]
        );
    }
    /**
     * Guarda sala na BD
     * POST index.php?a=sala_store
     */
    public function store(): void
    {
        if(($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST'){
            header('Location: index.php?a=empresas');
            exit;
        }

        $id_empresa = isset($_POST['id_empresa']) ? (int) $_POST['id_empresa'] : 0;
        if ($id_empresa <= 0) {
            header('Location: index.php?a=empresas');
            exit;
        }

        $nome = trim($_POST['nome'] ?? '');
        
        $errors = [];
        if($nome === ''){
            $errors['nome'] = 'O nome é obrigatório.';
        }   
        elseif(strlen($nome) > 120 ){
            $errors['nome'] = 'O nome não pode ter mais de 120 caracteres.';
        }
        
        // Se houver erros, mostra o formulário outra vez
        if(!empty($errors)){
            echo renderNtpl(
                'base', ['title' => 'Criar Sala'],
                'sala_form',
                 [
                    0 => 'content',
                    'action' => 'sala_store',
                    'id_empresa' => $id_empresa,
                    'sala' => ['nome' => $nome],
                    'errors' => $errors
                 ]
            );
            return;
        }

        // Guarda na BD
        \app\model\Sala::create($id_empresa, $nome);

        // Redireciona para a lista de empresas
        header("Location: index.php?a=salas&id_empresa=$id_empresa");
        exit;
    }
    /**
     * Apaga sala
     * GET index.php?a=salas_delete&id=YY&id_empresa=XX
     */
    public function delete(): void
    {   
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $id_empresa = isset($_GET['id_empresa']) ? (int) $_GET['id_empresa'] : 0;
        if ($id <= 0 || $id_empresa <= 0) {
            header('Location: index.php?a=empresas');
            exit;
        }

        \app\model\Sala::delete($id);

        // voltar sempre às salas da empresa
        header("Location: index.php?a=salas&id_empresa=" . $id_empresa);

        exit;
    }
    
}

?>