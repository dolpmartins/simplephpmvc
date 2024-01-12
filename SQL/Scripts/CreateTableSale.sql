CREATE TABLE Sale (
    SaleId int NOT NULL IDENTITY(1,1) PRIMARY KEY,
    SaleDate datetime NOT NULL,
    Total decimal(18,2) NOT NULL
);