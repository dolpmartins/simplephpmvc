CREATE TABLE ProductType (
    ProductTypeId int NOT NULL IDENTITY(1,1) PRIMARY KEY,
    Name varchar(255) NOT NULL,
    PercentTax decimal(18,2) NOT NULL
);