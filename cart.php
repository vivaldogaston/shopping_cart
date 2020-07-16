<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="cart.css">
    <link rel="stylesheet" type="text/css" href="css/body.css">
    
</head>
<body>
<?php
session_start();
require("conn.php");
$total=0;
?>
    <div class="div">
    <table border="solid">
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th>Remove</th>
            
        </tr>
        <?php
        if(!empty($_SESSION["shopping_cart"])){
            foreach($_SESSION["shopping_cart"] as $product){ #display cart
        echo" 
      
            
        <tr>
            <td>".$product['description']."</td>
            <form method='post' onchange='this.form.submit()'action='change.php'>
                <input type='hidden' name='code' value='".$product['code']."'>  
                <td><input type='number' name='quantity' id='count' min=1 value=".$product['quantity']."></td>
                <td>".$product['price']."</td>
                <td>".($product['quantity']*$product['price'])."</td>
            </form>
            <form method='post' action='remove.php'>
                <input type='hidden' name='code' value='".$product['code']."'> 
                <td><button type='submit'><img src='images/icons8-trash-26'></button></td>
            </form>
        </tr>";
        $total+=$product['price']*$product['quantity'];
        }}else{ 
            echo "<div style='color:green;margin:50px; border:solid 1px ;background:#f2f2f2; padding:10px'>Cart is empty</div>"; 
            unset($_SESSION["shopping_cart"]);
        }
        ?>
        <tr>
            <td colspan="3">Total</td>
            <td colspan="2"><?php echo $total; ?></td>
            <form ></form>
        </tr>
    </table>
      <a href="clear.php"class="cart">Clear Cart</a>
      <a href="index.php" class="product">Products</a>
 </div>

</body>
</html>
