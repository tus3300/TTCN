<?php

/**
 * NukeViet Content Management System
 * @version 5.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2025 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_MODULES')) {
    exit('Stop!!!');
}

$sql_drop_module = [];
$sql_drop_module[] = 'SET FOREIGN_KEY_CHECKS = 0;';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_OrderDetails;';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_Orders;';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_Products;';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_Categories;';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_Discounts;';
$sql_drop_module[] = 'SET FOREIGN_KEY_CHECKS = 1;';


$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_Categories` (
    CategoryID INT PRIMARY KEY AUTO_INCREMENT,
    CategoryName VARCHAR(255) NOT NULL
)";

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_Products` (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,
    ProductName VARCHAR(255) NOT NULL,
    CategoryID INT,
    Description TEXT,
    DetailedDescription TEXT,
    ImageURL VARCHAR(255),
    Quantity INT NOT NULL,
    Price INT NOT NULL,
    Status ENUM('Hidden', 'Visible') NOT NULL DEFAULT 'Visible',
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (CategoryID) REFERENCES `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_Categories` (CategoryID) ON DELETE SET NULL
)";

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_Orders` (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone VARCHAR(20) NOT NULL,
    TotalAmount INT NOT NULL,
    OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PaymentMethod VARCHAR(50) NOT NULL,
    Status ENUM('Pending', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending'
)";

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_OrderDetails` (
    OrderDetailID INT PRIMARY KEY AUTO_INCREMENT,
    OrderID INT,
    ProductID INT,
    Quantity INT NOT NULL,
    Price INT NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_Orders` (OrderID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_Products` (ProductID) ON DELETE CASCADE
)";

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data ."_Discounts` (
    DiscountID INT PRIMARY KEY AUTO_INCREMENT,
    Code VARCHAR(50) NOT NULL UNIQUE,
    DiscountPercentage INT CHECK (DiscountPercentage BETWEEN 0 AND 100),
    ExpiryDate DATE NOT NULL,
    Status ENUM('Active', 'Expired') NOT NULL DEFAULT 'Active'
)";

?>