CREATE TABLE SaleItem (
    SaleItemId int NOT NULL IDENTITY(1,1) PRIMARY KEY,
    ProductId int NOT NULL FOREIGN KEY REFERENCES Product(ProductId),
    SaleId int NOT NULL FOREIGN KEY REFERENCES Sale(SaleId),
    UnitPrice decimal(18,2) NOT NULL,
    Quantity int NOT NULL,
    Total decimal(18,2) NOT NULL
);
