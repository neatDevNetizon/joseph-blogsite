<?php namespace App\Controller;
class Admin
{
    public function indexAction()
    { 
        // you could add the twig package 'composer require "twig/twig:^2.0"' 
        // and use it as "echo $twig->render('index', ['name' => 'Fabien']);"
        include ("App/View/Admin.php");
    }
    public function loginAction()
    { 
        // you could add the twig package 'composer require "twig/twig:^2.0"' 
        // and use it as "echo $twig->render('index', ['name' => 'Fabien']);"
        include ("App/View/AdminLogin.php");
    }
    public function signin(){
    	echo "adfasdf";
    }
    public function newAction() {
        include ("App/View/AdminNew.php");
    }
    public function listAction() {
        include ("App/View/AdminBlogs.php");
    }

}