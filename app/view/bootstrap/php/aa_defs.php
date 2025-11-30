<?php
return function($a){ //trata-se de uma função anónima
    return <<< HTML_END_01
        $a[title]<br>
        {$a['content']}
    HTML_END_01; 
}
?>