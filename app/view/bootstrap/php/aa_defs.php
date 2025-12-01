<?php
// Este ficheiro devolve uma função anónima.
// Essa função recebe um array $a e devolve HTML com:
// $a['title']
// $a['content']

return function($a){ //trata-se de uma função anónima
    return <<< HTML_END_01
        $a[title]<br>
        {$a['content']}
    HTML_END_01; 
}
?>