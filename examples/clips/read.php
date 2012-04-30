<?php

require_once('../../Kipptr.class.php');

use Kipptr\Core,
	Kipptr\Clips;

Core::init('username', 'token');

$resp = Clips::read();

echo('<pre>' . print_r($resp, 1) . '</pre>');