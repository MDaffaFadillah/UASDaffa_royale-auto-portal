<?php
$_ENV['VERCEL'] = 1;
$_SERVER['VERCEL'] = 1;
putenv('VERCEL=1');

require __DIR__ . '/../public/index.php';
