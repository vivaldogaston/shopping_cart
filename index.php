<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/body.css">
    <link rel="stylesheet" type="text/css" href="cart.css">
    
</head>
<body>
<?php

use function PHPSTORM_META\map;
session_start();
require("conn.php");
    ?>
 
    <div class="content">
    
        <div style="margin-left:100px;">
            <?php
       
            $conn=getConnection();
            try {
                $conn=getConnection();
                $query="select * from products";
                $stmt=$conn->prepare($query);
                $stmt->execute();
                $rows=$stmt->rowCount();
                $result=$stmt->fetchAll();
                $i=0;
                foreach($result as $data)
                {
                  
                  echo"
                    <a style='color:black;'>
                        <div class='display-meias'>
                            <div style='display:grid;place-items:center;'>
                                <img src='images/".$data[4]."' width=250 height=200>
                                <label name='name'>".$data[1]."</label>
                                <label name='price'>".$data[2]." Akz</label>
                                <form method='post'>
                                <input type='hidden' name='code' value='$data[0]'>
                                <input type='hidden' name='action' value='add'>
                                <button class='buttoncart' type='submit'>Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </a>
                    ";
                    $i++;
                }
                } catch(PDOException $ex)
                {
                    echo "ERRO:".$ex->getMessage();
                }
           
            ?>
    

        </div>
        <div style="display: grid; place-items:center;">
            <a href="clear.php" class="cart" >Clear Cart</a>
            <a href="cart.php" class="product">See Cart</a>
        </div>
    </div>

</body>
</html>

<?php
    $status="";
    $total=0;
    $status1="";
if($_SERVER['REQUEST_METHOD']=='POST')
{   
    if(isset($_POST['code']) && $_POST['action']=="add"){
 
        $added=false;
        $code=$_POST['code'];
        $query="select * from products where id=?";
        $conn=getConnection();
        $stmt=$conn->prepare($query);
        $stmt->bindValue(1,$code);
        $stmt->execute();
        $result=$stmt->fetchAll();     
        $cartArray;
        foreach($result as $product)
        {
        $cartArray = array($code=>array(            
            'code'=>$product['id'],
            'description'=>$product['description'],
            'price'=>$product['price'],
            'quantity'=>1,
            'image'=>$product['photo']
           
        )); 
        }
      
        if(empty($_SESSION["shopping_cart"]))
        {
            $_SESSION["shopping_cart"]=$cartArray;
            $status = "Product is added to your cart!";
            echo "<script>alert('Product is added to your cart!');</script>";

        }else{
      
            foreach($_SESSION["shopping_cart"] as $array){
                if($code==$array["code"]){                 
                    $status = "<div class='box' style='color:red;'>Product is already added to your cart!</div>"; 
                    echo "<script>alert('Product is already added to your cart!');</script>";
                    $added=true;
                    break;
                }        
            }
            if($added==false){
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
                $status = "<div class='box'>Product is added to your cart!</div>";         
                echo "<script>alert('Product is added to your cart!');</script>";

            }   
        } 

    } 
   
    $conn=null;
    $query=null;
}
?>