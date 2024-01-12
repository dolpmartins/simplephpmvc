CREATE TABLE Product (
    ProductId int NOT NULL IDENTITY(1,1) PRIMARY KEY,
    ProductTypeId int NOT NULL FOREIGN KEY REFERENCES ProductType(ProductTypeId),
    Name varchar(255) NOT NULL,
    Price decimal(18,2) NOT NULL
);
