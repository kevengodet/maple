<?php

require_once __DIR__.'/bootstrap.php';

use Maple\Maple;
use Maple\Store;

//Maple::mixin('append', function(Store $store, $key, $value) {
//    $v = $store->fetch($key);
//
//    return $store->store($key, $v.$value);
//});
//Maple::mixin('strlen', function(Store $store, $key) {
//    $v = $store->fetch($key);
//
//    return strlen($v);
//});
//Maple::mixin('prefix', function(Store $store, $prefix) {
//    return new \Maple\Transformer\Prefix($store, $prefix);
//});
//$map = Maple::create()->prefix('lol.');
//$map['foo'] = 'bar';
//$map['baz'] += 2;
//$map->append('foo', ' baz');
//var_dump($map->strlen('foo'));
//print_r($map);

$store = Maple::create('memory')
    ->prefix('foo')
    ->proxy(function($key) { return rand(); });

var_dump($store->fetch('foo'));

var_dump($store);