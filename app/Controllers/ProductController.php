<?php
namespace App\Controllers;
use App\Models\ProductType;
use App\Models\Product;
use App\Core\FormValidation;

class ProductController{
	
    private $types = [];
    public function __construct() {
        $producttypes = new ProductType();
        $this->types = $producttypes->GetAll();
	}


    public function index(){    
        $product = new Product();
        view('product/index',['products'=> $product->GetAll()]);
    }

    public function create(){

        view('product/create',['types' => $this->types]);
    }

    public function edit($id){

        
        $product = new Product();

        $foundProduct = $product->getById($id);

        if($foundProduct){
            view('product/edit',['product'=> $foundProduct, 'types' => $this->types]);
        }else{
            $_SESSION['alert']['type'] = "danger";
            $_SESSION['alert']['message'] = "product not found.";
            header('Location: /product/');
        }


        
    }

    public function save(){

        $validator = new FormValidation();

        $validator->validateRequired($_POST['name'], 'Name');
        $validator->validateRequired($_POST['price'], 'Price');
        $validator->validateRequired($_POST['producttypeid'], 'Product Type');
        $validator->validateNumber($_POST['price'], 'Price');
        if ($validator->hasErrors()) {
            $errors = $validator->getErrors();
            $_SESSION['alert']['type'] = "danger";
            $_SESSION['alert']['message'] = "Create product error. Errors: " . implode(';', $errors);
            view('product/create',['types' => $this->types]);            
        }else{
            $product = new Product();
            $return = $product->add($_POST['name'], $_POST['producttypeid'], $_POST['price']);
            if($return){
                $_SESSION['alert']['type'] = "success";
                $_SESSION['alert']['message'] = "Create product successfully.";
                header('Location: /product/');
            }else{
                $_SESSION['alert']['type'] = "danger";
                $_SESSION['alert']['message'] = "Create product error.";
                view('product/create',['types' => $this->types]);
            }
        }
    }

    public function update($id){

        $validator = new FormValidation();

        $validator->validateRequired($_POST['name'], 'Name');
        $validator->validateRequired($_POST['price'], 'Price');
        $validator->validateRequired($_POST['producttypeid'], 'Product Type');
        $validator->validateNumber($_POST['price'], 'Price');
        if ($validator->hasErrors()) {
            $errors = $validator->getErrors();
            $_SESSION['alert']['type'] = "danger";
            $_SESSION['alert']['message'] = "Create product error. Errors: " . implode(';', $errors);
            header('Location: /product/edit/'.$id[0]);       
        }
        else{

            $product = new Product();
            $return = $product->update($id[0],$_POST['name'], $_POST['producttypeid'], $_POST['price']);
            if($return){
                $_SESSION['alert']['type'] = "success";
                $_SESSION['alert']['message'] = "update product successfully.";
                header('Location: /product/');
            }else{
                $_SESSION['alert']['type'] = "danger";
                $_SESSION['alert']['message'] = "update product error.";
                header('Location: /product/edit/'.$id);
            }
        }   
    }
    static function delete($id){
        $product = new Product();
        $return = $product->delete($id[0]);
        if($return){
            $data['alert']['type'] = "success";
            $data['alert']['message'] = "deleted product successfully.";
            echo json_encode($data);
        }else{
            $data['alert']['type'] = "danger";
            $data['alert']['message'] = "deleted product error.";
            echo json_encode($data);
        }
    }
}