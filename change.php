<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $code;
    $quantity;
    session_start();
    if(isset($_POST['code'])){
        $code=$_POST['code'];
        $quantity=$_POST["quantity"];
        $lastkey=array_key_last($_SESSION["shopping_cart"]);
        if(!empty($_SESSION["shopping_cart"])){
            for($i=0;$i<=$lastkey;$i++)
            {          
                
                if(isset($_SESSION["shopping_cart"][$i]["code"]) && $code==$_SESSION["shopping_cart"][$i]["code"]){ 
                    $status = "<div class='box' style='color:red;'>Quantity Changed!</div>"; 
                    $_SESSION["shopping_cart"][$i]["quantity"]=$quantity; 
                }
            }
        }
        echo $status;
        header("Location:cart.php");
    }
}
?>