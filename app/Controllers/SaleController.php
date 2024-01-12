<?php
namespace App\Controllers;
use App\Models\Product;
use App\Models\Sale;

class SaleController{
	
    public function __construct() {
	}


    public function index(){   
        $product = new Product();
        view('sale/index',['products'=> $product->GetAll()]);
    }

    public function save(){
        $sale = new Sale();
        $items = $_POST['items'];
        $return = $sale->save($items);
        if($return){
            $data['alert']['type'] = "success";
            $data['alert']['message'] = "Save sale successfully.";
            
        }else{
            $data['alert']['type'] = "danger";
            $data['alert']['message'] = "Save sale error.";
        }
        echo json_encode($data);
    }
}