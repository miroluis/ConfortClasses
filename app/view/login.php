<?php
namespace app\view;
class Login {
static function render() {

// $func = include __DIR__ . '/bootstrap/php/aa_defs.php';
$func = include __DIR__ . "/bootstrap/php/login.php";
$form = $func([]);


$func = include __DIR__ . "/bootstrap/php/base.php";


$a = ['title' => 'Login',
    // 'content' => 'o meu conteudo'];
    'content' => $form];
$html = $func($a);
echo $html;
}
}

/*

        $form = <<< END_01
	
       

END_01;
//echo $form;
$page = <<< END_02

END_02;

echo $page;

*/

// //isto era o que tinha antes
//         <!DOCTYPE html>
//         <html lang="pt">
//         <head>
//             <meta charset="utf-8" />
//             <meta http-equiv="X-UA-Compatible" content="IE=edge" />
//             <meta name="viewport" content="width=device-width,
//                 initial-scale=1, shrink-to-fit=no" />
//             <meta name="description" content="" />
//             <meta name="author" content="" />
//             <title>Login</title>

//             <link href="../../third/jscss/bootstrap.min.css" rel="stylesheet" />
//         </head>
//         <body>
//             FICA O FORMULARIO DO LOGIN...
//             <script src="../../third/jscss/bootstrap.min.js"></script>
//         </body>
//         </html>



?>


