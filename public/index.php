<?php

use Lib\Data\Controllers\MemberController;
use Lib\Data\Enums\SortEnum;

require_once __DIR__.'/../vendor/autoload.php';

$controller = new MemberController();
$controller->read(SortEnum::DESC, true, 'greens');