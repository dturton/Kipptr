<?php

require_once('../../Kipptr.class.php');

use Kipptr\Core,
	Kipptr\Lists;

Core::init('username', 'token');

$resp = Lists::read();

echo('<pre>' . print_r($resp, 1) . '</pre>');