<?php

require_once('../../Kipptr.class.php');

use Kipptr\Core,
	Kipptr\Clips;

Core::init('username', 'token');

$resp = Clips::update(1651498, 'http://www.google.de/', 'New Clip Title');

echo('<pre>' . print_r($resp, 1) . '</pre>');