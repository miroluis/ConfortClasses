<?php
namespace app\view;
include_once __DIR__ . "/../../config/config.php";
class Dashboard {
//--------------
static function render() {

$page = renderNtpl('dashboard', []);

echo $page;

}
//--------------
}
?>


