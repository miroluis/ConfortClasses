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
// se indice numerico, faz-o nos values
function prefix_rules(array $rules, string $prefix, string $postfix=''):array{
    if(array_is_list($rules))
        return array_map(
            fn($k):string => $prefix . $k . $postfix,
            $rules
        );
    return array_combine(
        array_map(
        fn($k):string => $prefix . $k . $postfix,
        array_keys($rules)
        ),
        $rules
    );
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

#retorna a primeira lingua suportada pelo browser
function getBrowserLang():string{
    $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en';
    $a=array_map(
        fn($v) => ['lang'=>trim(explode(';', $v)[0]),
                    'q'=> (float)(explode('q=', $v)[1] ?? 1)],
        explode(',', $lang)
    );
    // dbg($a);
    usort($a, fn($a, $b) => $b['q'] <=> $a['q']);
    // dbg($a);
    // usort($a, fn($a, $b) => $a['q'] <=> $b['q']);
    // dbg($a);
    return count($a)>0 ? $a[0]['lang'] : 'en';
}

?>