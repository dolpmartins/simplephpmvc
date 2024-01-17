<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\ProductType;
use App\Models\Product;

class ProductTest extends TestCase
{
    protected $productModel;
    protected $productTypeModel;

    protected function setUp(): void
    {
        $this->productModel = new Product();
        $this->productTypeModel = new ProductType();
    }

    public function testAdd()
    {
        $typeid = $this->productTypeModel->add('Type1', 10);
        $result = $this->productModel->add('Product1', $typeid, 10.99);
        $this->assertGreaterThan(0,$result);
    }

    public function testGetAll()
    {
        $result = $this->productModel->getAll();
        $this->assertIsArray($result);
    }
    public function testUpdate()
    {
        $id = 1;
        $result = $this->productModel->update($id, 'UpdatedProduct', 2, 19.99);
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $id = 1;
        $result = $this->productModel->delete($id);
        $this->assertTrue($result);
    }
}