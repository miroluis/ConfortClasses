<?php
define("LF","<br>");
echo date("l jS \of F Y h:i:s A"),'<br>';
echo "PHP: ", phpversion(),"<br>";
$NOT_INC_AUTOLOAD=true;


define("APP_FOLDER", dirname($_SERVER['SCRIPT_NAME']));
define("APP_PATH", dirname(__FILE__)) ;
define("LF", "<br>");

error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED 
                & ~E_WARNING & ~E_CORE_WARNING & ~E_USER_WARNING & ~E_STRICT);
//---------------------------------------
//---------------------------------------
function get_composer_third() {
	$composer_data = [
	  'url' => 'https://getcomposer.org/composer.phar',
	  'dir' => __DIR__.'/third',
	  'bin' => __DIR__.'/third/composer.phar',
	  'json' => __DIR__.'/third/composer.json',
	  'conf' => [
	    "autoload" => [
	    	"psr-4" => ["" => "local/"]
	    ]
	    //,"require"=> [
	    //  "rmccue/requests" => "@stable"
	    //]
	  ]
	];
	
	if (!@mkdir($composer_data['dir'],0777,true)) {
		$error = error_get_last();
		echo "ERROR: mkdir ", "{$composer_data['dir']} | ", "{$error['message']}", LF;
	}
	if (!@mkdir("{$composer_data['dir']}/local",0777,true)) {
		$error = error_get_last();
		echo "ERROR: mkdir ", "{$composer_data['dir']}/local | ", "{$error['message']}", LF;
	}
	if (!@mkdir("{$composer_data['dir']}/jscss",0777,true)) {
		$error = error_get_last();
		echo "ERROR: mkdir ", "{$composer_data['dir']}/jscss | ", "{$error['message']}", LF;
	}

	//copy('https://getcomposer.org/composer.phar', 'composer.phar');
	echo copy($composer_data['url'],$composer_data['bin']);
	require_once "phar://{$composer_data['bin']}/src/bootstrap.php";
	
	//$conf_json = json_encode($composer_data['conf'],JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
	//file_put_contents($composer_data['json'],$conf_json);
	chdir($composer_data['dir']);
	putenv("COMPOSER_HOME={$composer_data['dir']}");
	putenv("OSTYPE=OS400"); //force to use php://output instead of php://stdout
	$app = new \Composer\Console\Application();
	
	$factory = new \Composer\Factory();
	$output = $factory->createOutput();
	
	$input = new \Symfony\Component\Console\Input\ArrayInput(array(
	  'command' => 'update',
	));
	//$app->setAutoExit(false);
	$input->setInteractive(false);
	
	echo "<pre>";
	try{
		$cmdret = $app->doRun($input,$output); //unfortunately ->run() call exit() so we use doRun()
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}
	echo "end!";
	
	chdir('..');
}
//---------------------------------------
function fix_htaccess() {
$dir=APP_FOLDER;

/*Order deny,allow
Deny from all
Options -Indexes*/
$data=<<<END
Order deny,allow
Deny from all
Options -Indexes
<Files "bulma.min.css">
    Allow from all
</Files>
<Files "fontawesome.js">
    Allow from all
</Files>
<Files "fontawesome.css">
    Allow from all
</Files>
<Files "chart.min.js">
    Allow from all
</Files>
<Files "chart.min.css">
    Allow from all
</Files>
END;
file_put_contents("third/.htaccess", $data);

$conteudo="Satisfy Any\r\n".
"Allow from all";

file_put_contents("third/vendor/.htaccess", $conteudo);
file_put_contents("third/jscss/.htaccess", $conteudo);
file_put_contents("public/.htaccess", $conteudo);
file_put_contents("lib/templates/js/.htaccess", $conteudo);
file_put_contents("lib/templates/css/.htaccess", $conteudo);

$conteudo=<<<END
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase $dir
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php [QSA,L]
</IfModule>

<IfModule inacio01.c>
RewriteEngine On
RewriteBase $dir
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . index.php [L]
</IfModule>
END;

file_put_contents(".htaccess", $conteudo);
}
//---------------------------------------
function download_app_files() {

	$f=file_get_contents('third/composer.json');
	$f=json_decode($f);
	$a=false;
	$t="third/composer.json  <- secção: app_download".LF;
	$conteudo_htaccess="Satisfy Any\r\n". "Allow from all";

	if (isset($f->app_download))
	foreach ($f->app_download as $k1 => $v1) {
		if (!isset($v1->target) || !isset($v1->files)) continue;
		$dir=APP_PATH."/".$v1->target;
		if (!is_dir($dir)) continue;
		file_put_contents($dir."/.htaccess", $conteudo_htaccess);
		foreach($v1->files as $k => $v ) {
			$nome=basename($v);
			$nome=$k;
			if (file_exists($dir."/".$nome)) continue;
			$conteudo=file_get_contents($v);
			$t.=" 100%  $k -> $v1->target/$nome vindo de: $v".LF;
			$a=true;
			file_put_contents($dir."/".$nome, $conteudo);
		}
	}
	if (!$a) $t.="Nada para instalar ou alterar".LF;
	echo LF,LF,'--------------------',LF,$t,'End!',LF,LF;
}
//---------------------------------------
function create_app_folders() {
	
	$f=file_get_contents('third/composer.json');
	$f=json_decode($f);
	$a=false;
	$t="third/composer.json  <- secção: app_folder_structure".LF;
	if (isset($f->app_folder_structure))
	foreach ($f->app_folder_structure as $v) {
		if (! is_string($v)) continue;
		$arr=explode("/",$v);
		$m=false;
		foreach($arr as $folder)
			if ($folder=="." || $folder==".." || $folder=='') { 
				$m=true;
				break;
			}
		if ($m) continue;
		if (is_dir($v)) continue;
		$a=true;
		$t.="creating folder: $v". LF;
		if (!@mkdir($v,0777,true)) {
			$error = error_get_last();
			echo "ERROR: mkdir "," $v  | ","{$error['message']}",LF;
		}
	}
	if (!$a) $t.="Nenhum folder para criar".LF;
	echo LF,LF,'--------------------',LF,$t,'End!',LF,LF;
}
//---------------------------------------
//fix_htaccess();
echo "Creating App Folders<br>";
create_app_folders();
download_app_files();
echo "Get Composer<br>";
get_composer_third();
?>