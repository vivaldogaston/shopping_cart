<?php
 //remove item from cart
 $status="";
 session_start();
 $lastkey=array_key_last($_SESSION["shopping_cart"]);
 if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['code'])){
        $code=$_POST["code"];
        echo "tou no remove<br>";
        echo "Length ".$length= count($_SESSION["shopping_cart"])."<br>";
        if(!empty($_SESSION["shopping_cart"])) {
            $keys=array_keys($_SESSION["shopping_cart"]);
            for($i=0;$i<=$lastkey;$i++)
            {
                //if(isset($_SESSION["shopping_cart"][$i]["id"]) && $code==$_SESSION["shopping_cart"][$i]["id"]){ 
                if(isset($_SESSION["shopping_cart"][$i]["code"]) && $code==$_SESSION["shopping_cart"][$i]["code"]){ #check if item exist and is part of the array          
                    echo $_SESSION["shopping_cart"][$i]["code"]."<br>";
                    $status = "<div class='box' style='color:red;'>Product is removed from your cart!</div>"; 
                    unset($_SESSION["shopping_cart"][$i]); #remove item       
                }
                if(empty($_SESSION["shopping_cart"])){ 

                    unset($_SESSION["shopping_cart"]);
                }
        }          
        }
    
    }

echo $status;
//if(!empty($_SESSION["shopping_cart"]))echo "LAST:".$lastkey=array_key_last($_SESSION["shopping_cart"])."<BR>";
header("Location:cart.php");
}
?>