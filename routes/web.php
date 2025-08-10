<?php

use Illuminate\Support\Facades\Route;

// call admin first, there are multiple slug based route in front, they might send to 404 URI when /admin* is accessed
require __DIR__.'/admin/admin.php';
require __DIR__.'/front/auth.php';
require __DIR__.'/front/front.php';
