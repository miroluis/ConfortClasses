<?php
declare(strict_types=1);

namespace app\controller;

class EmpresaController
{
    /**
     * Lista empresas
     * GET index.php?a=empresas
     */
    public function index(): void
    {
        $empresas = \app\model\Empresa::all();

        echo renderNtpl(
            'base', ['title' => 'Empresas'],
            'empresa_list', [0 => 'content', 'empresas' => $empresas]
        );
    }
    /**
     * Mostra formulário
     * GET index.php?a=empresa_create
     */
    public function create(): void
    {
        echo renderNtpl(
            'base', ['title' => 'Nova Empresa'],
            'empresa_form', 
            [
                0 => 'content',
                'action' => 'empresa_store',
                'empresa' => ['nome' => ''],
                'errors' => []
            ]
        );
    }
    /**
     * Guarda empresa na BD
     * POST index.php?a=empresa_store
     */
    public function store(): void
    {
        if(($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST'){
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
                'base', ['title' => 'Nova Empresa'],
                'empresa_form', 
                [
                    0 => 'content',
                    'action' => 'empresa_store',
                    'empresa' => ['nome' => $nome],
                    'errors' => $errors
                ]
            );
            return;
        }
        // Guardar na BD
        \app\model\Empresa::create($nome);
        // Redirecionar para a lista de empresas
        header('Location: index.php?a=empresas');
        exit;
    }
    /**
     * Apaga empresa
     * GET index.php?a=empresas_delete&id=XX
     */
    public function delete(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if($id <= 0){
            header('Location: index.php?a=empresas');
            exit;
        }

        \app\model\Empresa::delete($id);
        
        // Redirecionar para a lista de empresas
        header('Location: index.php?a=empresas');
        exit;
    }


}
?>
