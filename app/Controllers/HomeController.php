<?php
namespace App\Controllers;

class HomeController{
	
    public static function Home(){
        view('home',['somedata'=>["this","is","awesome"]]);

    }
}