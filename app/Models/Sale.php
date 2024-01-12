<?php
namespace App\Models;
use \PDO;
use \PDOException;
use App\Core\ModelBase;
use Exception;

class Sale extends ModelBase{



    public function save($items) {
        try {
            $totalItems = 0;
            foreach ($items as $item) {
                $totalItems += $item['total'];
            }

            $query = "INSERT INTO sale (saledate, total) VALUES (GetDate(), :total)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':total', $totalItems);
            $stmt->execute();
            $ultimoID = $this->conn->lastInsertId();

            
            foreach ($items as $item) {
                $product = $item['product'];
                $quantity = $item['quantity'];
                $unitPrice = $item['unitprice'];
                $total = $item['total'];
                $saleId = $ultimoID;
        
                $query = "INSERT INTO SaleItem (productId,saleId, quantity,unitPrice,total) VALUES (:productId,:saleId, :quantity, :unitPrice, :total)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':productId', $product);
                $stmt->bindParam(':saleId', $saleId);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':unitPrice', $unitPrice);
                $stmt->bindParam(':total', $total);
                
                $stmt->execute();
            }
            return 1;
        }catch( PDOException $Exception ) {
            error_log($Exception, 0);
            return  0;
        }catch (Exception $ex){
            error_log($ex, 0);
            return 0;
        }
    }

    public function getAll() {
        $query = "SELECT p.*, pt.Name as Type, pt.PercentTax FROM Sale p INNER JOIN SaleType pt on pt.SaleTypeId = p.SaleTypeId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM Sale WHERE SaleId = :SaleId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByIdSaleType($id) {
        $query = "SELECT * FROM Sale WHERE SaleTypeId = :SaleId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id, $name, $Saletypeid) {
        $query = "UPDATE Sale SET name = :name, Saletypeid = :Saletypeid WHERE SaleId = :SaleId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':Saletypeid', $Saletypeid);
        $stmt->bindParam(':SaleId', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM Sale WHERE SaleId = :SaleId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':SaleId', $id);
        return $stmt->execute();
    }
}
