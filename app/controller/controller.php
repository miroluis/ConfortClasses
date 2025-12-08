<?php
//Retira do JSON | $_GET | $_POST os dados e coloca em variaveis
function get_payload():array{ 
    $method = $_SERVER['REQUEST_METHOD'] ?? 'NONE';
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (str_contains($contentType, 'application/json')) {
        $data = json_decode(file_get_contents('php://input'), true);
        $data = is_array($data) ? $data : [];
        return ['JSON:' . $method, $data];
    } 
    if ($method === 'POST') return ['POST', $_POST];
    if ($method === 'GET') return ['GET', $_GET];
    return ['NONE', []];
}
// Verificar se as keys de um array existem noutro
// retorna as keys existentes
function keyExistsInArray(array $rules, array $input):array{

}

// Verificar se as keys existem e se o conteudo é não nulo
// retorna array vazio se ok, caso contrário erros
function getMissingReqFields(array $rules_required, array $input): array{
    if(array_is_list($rules_required))
        return array_values(array_filter(
            $rules_required, 
            function($v, $k) use ($input): bool { return empty($input[$v]); },
            ARRAY_FILTER_USE_BOTH
        ));
    return array_filter(
        $rules_required, 
        fn($k):bool => empty($input[$k]),
        ARRAY_FILTER_USE_KEY
    );
}

// valida se os campos existem e se os requeridos estão todos
// retorna: [$dados, $erros]
function validate_input(array $rules_required, array $rules, array $input):array{
    if(array_is_list($rules))
        $dados=valuesIsInKeyArray($rules, $input);
    else
        $dados=keyIsInKeyArray($rules, $input);
    $erros=getMissingReqFields($rules_required, $input);
    return [$erros, $dados];
}

// Coloca um prefixo em todas as keys de um array
function prefix_keys(array $arr, string $prefix):array{

}



// vê se os valores de $rules existem nas keys de $input
// retorna de $input os que existentem
function valuesIsInKeyArray(array $rules, array $input):array{
    return array_intersect_key($input, array_flip($rules));
}

// vê se as keys de $rules existem nas keys de $input
// retorna de $input os elementos existentes
function keyIsInKeyArray(array $rules, array $input):array{
    return array_intersect_key($input, $rules);
}

?>