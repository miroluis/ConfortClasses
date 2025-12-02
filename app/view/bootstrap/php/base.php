<?php
// O ficheiro devolve uma função que recebe um array $a.
// Este array contém coisas como:
// $a['title'] → o título da página
// $a['content'] → o HTML gerado por outro template
return function($a){ //trata-se de uma função anónima
return <<< HTML_END_04
    <!DOCTYPE html>
    <html lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,
            initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>$a[title]</title>

        <link href="../third/jscss/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
{$a['menu']}
{$a['content']}
        <script src="../third/jscss/bootstrap.min.js"></script>
    </body>
    </html>
HTML_END_04;
}

//$form
?>


