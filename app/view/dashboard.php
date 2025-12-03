<?php
namespace app\view;
include __DIR__ . "/../../config/config.php";
class Dashboard {
//--------------
static function render() {

$page = renderNtpl('dashboard', []);

echo $page;

}
//--------------
}
?>


