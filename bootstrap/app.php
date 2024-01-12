<?php
require_once 'vendor/autoload.php';
require_once 'config/config.php';

/**
 *
 * Initialize the twig library
 */
function render($view,$data){
    $loader=new \Twig\Loader\FilesystemLoader('resources/views/');

    if(!$loader->exists($view)){ $view='errors/500.twig';}

    $twig = new \Twig\Environment($loader, []);
    //dd($_SESSION);
    $twig->addGlobal('session', $_SESSION);

    try {
        echo $twig->render($view, $data);
    } catch (\Twig\Error\LoaderError $e) {
        var_dump($e);
    } catch (\Twig\Error\RuntimeError $e) {
        var_dump($e);

    } catch (\Twig\Error\SyntaxError $e) {
        var_dump($e);

    }
    $_SESSION['alert']['type'] = "";
    $_SESSION['alert']['message'] = "";
}

/**
 * @param $name :the name of the view
 * @param array $data :optional data to be passed to the view
 */
function view( $name ,$data=[]) {

    /*twig rendering now comes into play*/
    render($name.'.twig',$data);

}


/*
 * Die and Dump
 *
 * @param $data
 */
function dd( $data = [] ) {
    echo '<pre>';
    die( var_dump( $data ).'</pre>' );

}

?>