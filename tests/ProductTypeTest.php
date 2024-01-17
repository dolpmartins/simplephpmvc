<?php

use PHPUnit\Framework\TestCase;
use App\Models\ProductType;

class ProductTypeTest extends TestCase
{
    protected $productTypeModel;

    protected function setUp(): void
    {
        $this->productTypeModel = new ProductType();
    }

    public function testAdd()
    {
        $result = $this->productTypeModel->add('Type1', 10);
        $this->assertGreaterThan(0,$result);
    }

    public function testGetAll()
    {
        $result = $this->productTypeModel->getAll();
        $this->assertIsArray($result);
    }

    public function testUpdate()
    {
        $id = 1;
        $result = $this->productTypeModel->update($id, 'UpdatedType', 15);
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $id = 1;
        $result = $this->productTypeModel->delete($id);
        $this->assertTrue($result);
    }
}
