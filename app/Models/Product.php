<?php
namespace App\Models;
use \PDO;
use \PDOException;
use App\Core\ModelBase;
use Exception;

class Product extends ModelBase{

    public function add($name, $producttypeid, $price) {
        try {
            $query = "INSERT INTO product (name, producttypeid, price) VALUES (:name, :producttypeid,:price)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':producttypeid', $producttypeid);
            $stmt->bindParam(':price', $price);
            return $stmt->execute();
        }catch( PDOException $Exception ) {
            error_log($Exception, 0);
            return  0;
        }catch (Exception $ex){
            error_log($ex, 0);
            return 0;
        }
    }

    public function getAll() {
        $query = "SELECT p.*, pt.Name as Type, pt.PercentTax FROM product p INNER JOIN productType pt on pt.ProductTypeId = p.ProductTypeId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM product WHERE productId = :productId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByIdProductType($id) {
        $query = "SELECT * FROM product WHERE productTypeId = :productId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id, $name, $producttypeid, $price) {
        $query = "UPDATE product SET name = :name, price = :price ,producttypeid = :producttypeid WHERE productId = :productId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':producttypeid', $producttypeid);
        $stmt->bindParam(':productId', $id);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM product WHERE productId = :productId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':productId', $id);
        return $stmt->execute();
    }
}
