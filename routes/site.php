<?php

use App\Page;

$app->get('/', function () {

	$page = new Page();

	$page->setTpl("index");

});

?>