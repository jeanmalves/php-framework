<?php

$app->middleware('before', function ($c) {
    session_start();
});

$app->middleware('before', function ($c) {
    header('content-type: text/plain');
});

$app->middleware('after', function ($c) {
    echo 'after';
});