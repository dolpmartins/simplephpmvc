<?php
namespace App\Models;
use \PDO;
use \PDOException;
use App\Core\ModelBase;
use Exception;

class ProductType extends ModelBase{

    public function add($name, $percentTax) {
        try {
            $query = "INSERT INTO productType (name, percentTax) VALUES (:name, :percentTax)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':percentTax', $percentTax);
            $stmt->execute();
            return $this->conn->lastInsertId();
        }catch( PDOException $Exception ) {
            error_log($Exception, 0);
            return  0;
        }catch (Exception $ex){
            error_log($ex, 0);
            return 0;
        }
    }

    public function getAll() {
        $query = "SELECT * FROM productType";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM productType WHERE ProductTypeId = :ProductTypeId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $percentTax) {
        $query = "UPDATE productType SET name = :name, percentTax = :percentTax WHERE ProductTypeId = :ProductTypeId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':percentTax', $percentTax);
        $stmt->bindParam(':ProductTypeId', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM productType WHERE ProductTypeId = :ProductTypeId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ProductTypeId', $id);
        return $stmt->execute();
    }
}
