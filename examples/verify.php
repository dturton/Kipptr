<?php

require_once('../Kipptr.class.php');

use Kipptr\Core;

Core::init('username', 'token');

$resp = Core::verify();

echo('<pre>' . print_r($resp, 1) . '</pre>');