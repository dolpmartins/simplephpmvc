<?php
namespace App\Controllers;

use App\Models\ProductType;
use App\Models\Product;

class ProductTypeController{
	
    public function index(){    
        $productType = new ProductType();
        view('productType/index',['productTypes'=> $productType->GetAll()]);
    }

    public function create(){
        view('productType/create');
    }

    public function edit($id){

        
        $productType = new ProductType();

        $foundProductType = $productType->getById($id);

        if($foundProductType){
            view('productType/edit',['productType'=> $foundProductType]);
        }else{
            $_SESSION['alert']['type'] = "danger";
            $_SESSION['alert']['message'] = "product type not found.";
            header('Location: /productType/');
        }


        
    }

    public function save(){
        $productType = new ProductType();
        $return = $productType->add($_POST['name'], $_POST['percentTax']);
        if($return){
            $_SESSION['alert']['type'] = "success";
            $_SESSION['alert']['message'] = "Create product type successfully.";
            header('Location: /productType/');
        }else{
            $_SESSION['alert']['type'] = "danger";
            $_SESSION['alert']['message'] = "Create product type error.";
            view('productType/create',[]);
        }
    }

    public function update($id){
        $productType = new ProductType();
        $return = $productType->update($id[0],$_POST['name'], $_POST['percentTax']);
        if($return){
            $_SESSION['alert']['type'] = "success";
            $_SESSION['alert']['message'] = "update product type successfully.";
            header('Location: /productType/');
        }else{
            $_SESSION['alert']['type'] = "danger";
            $_SESSION['alert']['message'] = "update product type error.";
            header('Location: /productType/edit/'.$id);
        }
    }
    static function delete($id){
        $productType = new ProductType();
        $product = new Product();

        $existsProduct = $product->getByIdProductType($id);
        if(!$existsProduct){
            $return = $productType->delete($id[0]);
            if($return){
                $data['alert']['type'] = "success";
                $data['alert']['message'] = "deleted product type successfully.";
                echo json_encode($data);
            }else{
                $data['alert']['type'] = "danger";
                $data['alert']['message'] = "deleted product type error.";
                echo json_encode($data);
            }
        }else{
            $data['alert']['type'] = "danger";
            $data['alert']['message'] = "Product type is related to product";
            echo json_encode($data);
        }
    }
}