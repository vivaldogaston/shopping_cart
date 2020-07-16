<?php
/**
 * DATABASE SCRIPT
create database shopping_cart;
use shopping_cart;
create table products(id int primary key auto_increment,
description varchar(100), price decimal(10,2), quantity int,photo varchar(100));
*then add your products
*in column "photo" insert only the image name. If you want to insert the whole path you can but don't forget to change src in img tag
*/
 
function getConnection()
{

    $dsn="mysql:host=localhost:3308;dbname=shopping_cart;charset=utf8";//change my host to your host if it is different
    $user="root";//change if it is different
    $pass="";//change if it is different
    try
    {
        $pdo= new pdo($dsn,$user,$pass);
        return $pdo;
    }
   catch(PDOException $ex)
    {
        echo "ERRO:".$ex->getMessage();
    }
}
?>