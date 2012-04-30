<?php

require_once('../../Kipptr.class.php');

use Kipptr\Core,
	Kipptr\Lists;

Core::init('username', 'token');

$resp = Lists::read_by_id(46269);

echo('<pre>' . print_r($resp, 1) . '</pre>');