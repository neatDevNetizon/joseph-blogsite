<?php namespace App\Controller;
class Vinyl
{
    public function indexAction()
    { 
        // you could add the twig package 'composer require "twig/twig:^2.0"' 
        // and use it as "echo $twig->render('index', ['name' => 'Fabien']);"
        include ("App/View/Vinyl.php");
    }
}