<?php
/**
 * Created by PhpStorm.
 * User: abdosaeed
 * Date: 02/08/17
 * Time: 07:43 م
 */
require_once('./vendor/autoload.php');
//use \SampleApp\HeroAgencyController;
$router = new \Zaphpa\Router();

$router->addRoute(
    array(
        'path' => '/heroes',
        'get'  => array( '\SampleApp\HeroAgencyController', 'getAll'),
        'post' => array( '\SampleApp\HeroAgencyController', 'hire')
    )
);
//    'path'     => '/heroes',
//    'handlers' => array(
//        'id'         => \Zaphpa\Constants::, //enforced to be numeric
//    ),
//    'get'      => array('\SampleApp\HeroAgencyController', 'getAll'),);

try {
    $router->route();
} catch (\Zaphpa\InvalidPathException $ex) {
    header("Content-Type: application/json;", TRUE, 404);
    $out = array("error" => "not found");
    die(json_encode($out));
}