<?php
echo date("l jS \of F Y h:i:s A"),'<br>';

//By default, we assume that PHP is NOT running on windows.
$isWindows = false;
//If the first three characters PHP_OS are equal to "WIN",
//then PHP is running on a Windows operating system.
$J="/";
if(strcasecmp(substr(PHP_OS, 0, 3), 'WIN') == 0){
    $isWindows = true;
    $J="\\";
}

echo "PHP: ", phpversion(),"<br>";
// remove o conteúdo da pasta "third", deixando apenas
// o ficheiro composer.json
// ------------------------
// NÃO REMOVE MAIS NADA...
// ------------------------
error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED 
                & ~E_WARNING & ~E_CORE_WARNING & ~E_USER_WARNING & ~E_STRICT);

$composer_data = [
  'url' => 'https://getcomposer.org/composer.phar',
  'dir' => __DIR__.$J.'third',
  'bin' => __DIR__.$J.'third'.$J.'composer.phar',
  'json' => __DIR__.$J.'third'.$J.'composer.json',
  'conf' => [
    "autoload" => [
    	"psr-4" => ["" => "local".$J]
    ],
    "require"=> [
      "rmccue/requests" => "@stable"
    ]
  ]
];

//-------------------------------------
function delall($cmd1, $cmd2) {
  global $composer_data,$J;
  system($cmd1.escapeshellarg($composer_data['dir'].$J.'cache'));
  system($cmd1.escapeshellarg($composer_data['dir'].$J."local"));
  system($cmd1.escapeshellarg($composer_data['dir'].$J."vendor"));
  system($cmd1.escapeshellarg($composer_data['dir'].$J."jscss"));
  system($cmd1.escapeshellarg($composer_data['dir'].$J."webfonts"));

  $cmd=[$cmd2.escapeshellarg($composer_data['dir'].$J.'composer.phar'),
        $cmd2.escapeshellarg($composer_data['dir'].$J.'.htaccess'),
        $cmd2.escapeshellarg($composer_data['dir'].$J.'..'.$J.'.htaccess'),
        $cmd2.escapeshellarg($composer_data['dir'].$J.'composer.lock')];
  foreach ($cmd as $v) {
    $last_line = system($v, $retval);
    echo '<hr /><pre>',$v,'</pre>'.
      'Last line of the output: ' . $last_line .
       'Return value: ' . $retval;
    system($v);
  }
}
//-------------------------------------
$cmd="rm -rf ";
if($isWindows){
    echo 'This operating system is Windows!<br>';
    delall("rmdir /S /Q ",'erase /Q /S /F ');
} else delall($cmd,$cmd);


echo "<hr /><br>Terminado!";

?>