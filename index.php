<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
    case "add":
      if(!empty($_POST["quantity"])) {
		if (empty($_SESSION["rollback_state"])) {
		  $_SESSION["rollback_state"] = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
		}
		
        $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
		$quantity = intval($_POST["quantity"]);
		
		if ($productByCode[0]["Stock"] > $quantity) {
		  $productByCode[0]["Stock"] -= $quantity;
		}
		else {
		  $productByCode[0]["Stock"] = 0;
		}
		
		$db_handle->runQuery("UPDATE tblproduct SET Stock = " . $productByCode[0]["Stock"] . " WHERE code = '" . $_GET["code"] . "'");
		
		// var_dump($_SESSION["rollback_state"]);

        $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"],
         'code'=>$productByCode[0]["code"],'DateI'=>$productByCode[0]["DateI"],
         'DateO'=>$productByCode[0]["DateO"],'Stock'=>$productByCode[0]["Stock"],
         'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
//
//
        if(!empty($_SESSION["cart_item"])) {
		  foreach($_SESSION["cart_item"] as $k => $v) {
			if ($productByCode[0]["code"] == $k) {
		   	  $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
		    }
			else {
			  $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
	        }  
		  }
        } else {
          $_SESSION["cart_item"] = $itemArray;
        }
      }
      break;
    case "remove":
      if(!empty($_SESSION["cart_item"])) {
        foreach($_SESSION["cart_item"] as $k => $v) {
            if($_GET["code"] == $k)
              unset($_SESSION["cart_item"][$k]);
            if(empty($_SESSION["cart_item"]))
              unset($_SESSION["cart_item"]);
        }
      }
	  
	  if(!empty($_SESSION["rollback_state"])) {
	  	foreach($_SESSION["rollback_state"] as $k => $v) {
		  if($_GET["code"] == $v["code"]) {
		  	$db_handle->runQuery("UPDATE tblproduct SET Stock = " . $v["Stock"] . " WHERE code = '" . $v["code"] . "'");
			unset($_SESSION["rollback_state"][$k]);
		  }
		  if(empty($_SESSION["cart_item"])) {
		    unset($_SESSION["rollback_state"]);
		  }
		}
	  }
	  
      break;
    case "empty":
      unset($_SESSION["cart_item"]);
	  if(!empty($_SESSION["rollback_state"])) {
	  	foreach($_SESSION["rollback_state"] as $k => $v) {
		  $db_handle->runQuery("UPDATE tblproduct SET Stock = " . $v["Stock"] . " WHERE code = '" . $v["code"] . "'");
		}
	  }
	  unset($_SESSION["rollback_state"]);
	  break;
	case "cs":
	  unset($_SESSION["rollback_state"]);
	  break;
	case "print":
	  var_dump($_SESSION["rollback_state"]);
      break;
  }
}
?>
<?php include("header.inc.php");?>
<?php include("user_login.inc.php");?>
if(session_id() == "" ){
        session_start();
    }

<!-- start slider -->
	<div id="fwslider" style="height: 500px;padding-top: 0px;padding-bottom:
	0px;margin-top: 50px;margin-left: 0px;border-right-width:
	50px;border-bottom-width: 0px;margin-bottom: 50px;margin-right:
	50px;top: 50px;bottom: 50px;left: 50px;right: 50px;width: 1360px;">

			<div class="slider_container">
					<div class="slide">
							<!-- Slide image -->
									<img src="images/banner.jpg" alt=""/>
							<!-- /Slide image -->
							<!-- Texts container -->
							<div class="slide_content">
									<div class="slide_content_wrap">
											<!-- Text title -->
											<h4 class="title">The Dhara Dhevi Chiang Mai </h4>
											<!-- /Text title -->

											<!-- Text description -->
											<p class="description">Luxury in Chiang Mai</p>
											<!-- /Text description -->
									</div>
							</div>
							 <!-- /Texts container -->
					</div>
					<!-- /Duplicate to create more slides -->
					<div class="slide">
							<img src="images/banner1.jpg" alt=""/>
							<div class="slide_content">
									<div class="slide_content_wrap">
											<h4 class="title">Khun Chang Khian Highland  </h4>
											<p class="description">Research Station</p>
									</div>
							</div>
					</div>
					<div class="slide">
							<img src="images/banner2.jpg" alt=""/>
							<div class="slide_content">
									<div class="slide_content_wrap">
											<h4 class="title">Mon Cham</h4>
											<p class="description">Just the WAY you are </p>
									</div>
							</div>
					</div>
					<div class="slide">
							<img src="images/banner3.jpg" alt=""/>
							<div class="slide_content">
									<div class="slide_content_wrap">
											<h4 class="title">Doi Inthanon National Park </h4>
											<p class="description">Best Way Best Friend</p>
									</div>
							</div>
					</div>
					<!--/slide -->
			</div>
			<div class="timers"></div>
			<div class="slidePrev"><span></span></div>
			<div class="slideNext"><span></span></div>
	</div>
	<!--/slider -->


<br /><div class="txt-heading">Products</div><br />
	<div class="tour">

  <?php
  	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
  	if (!empty($product_array)) {
  		foreach($product_array as $key=>$value) {
  	?>

    <form class="place" method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
      <a href=tour1.php><img src="<?php echo $product_array[$key]["image"]; ?>"></a>
      <div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
      <div class="date-chkin"><strong>DATE-CHK-IN:<?php echo $product_array[$key]["DateI"]; ?></strong></div>
      <div class="date-chkout"><strong>DATE-CHK-OUT:<?php echo $product_array[$key]["DateO"]; ?></strong></div>
      <div class="product-price"><?php echo $product_array[$key]["price"] ."Baht" ; ?> </div>
      <strong>Quota</strong>(<?php echo $product_array[$key]["Stock"]; ?>)
      <div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
    </form>

  <?php
  			}
  	}
  ?>
  </div>
<br/>
<div id="shopping-cart">
  <form action="submit-order.php" method="post">
    <div class="txt-heading">Shopping Cart <a id="btnEmpty" href="index.php?action=empty">DELETE ALL</a></div>
    <?php
    if(isset($_SESSION["cart_item"])){
        $item_total = 0;
    ?>
    <table cellpadding="10" cellspacing="1">
      <thead>
        <tr class="txt-heading2">
          <th><strong>Name</strong></th>
          <th><strong>Code</strong></th>
          <th><strong>Check-In</strong></th>
          <th><strong>Check-Out</strong></th>
          <th><strong>Quantity</strong></th>
          <th><strong>Price</strong></th>
          <th><strong>Action</strong></th>
        </tr>
      </thead>
      <tbody>
        <?php
            foreach ($_SESSION["cart_item"] as $item){
        		?>
        			<tr class="txt-heading3">
        				<td align=center><strong><?php echo $item["name"]; ?></strong></td>
        				<td align=center><?php echo $item["code"]; ?></td>
                <td align=center class="date-chkin"><?php echo $item["DateI"]; ?></td>
                <td align=center class="date-chkout"><?php echo $item["DateO"]; ?></td>
        				<td align=center><?php echo $item["quantity"]; ?></td>
        				<td align=center><?php echo "$".$item["price"]; ?></td>
        				<td align=center><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
              </tr>
                <?php
                $item_total += ($item["price"]*$item["quantity"]);
        		}
        		?>
             //hidden session
             <input type="hidden" name="order-items" value="
              <?php
                foreach ($_SESSION["cart_item"] as $item) {
                  echo $item["name"] . ";" . $item["code"] . ";" . $item["quantity"] . ";" . $item["price"] . "|";
                }
              ?>
            ">
            <input type="hidden" name="total_price" value="<?php echo $item["price"]*$item["quantity"]; ?>">
        <tr class="txt-heading3">
          <td colspan="5" align=right><strong><br />Total:</strong> <?php echo "$".$item_total; ?></td>
        </tr>
      </tbody>
    </table>
      <?php
    }
    ?>
    <br />
    <div class="txt-heading2"><a id="btnEmpty" href="submit-order.php">ORDER</a></div>
  </form>
</div>

<!-- ตารางที่ใช้วางโครงสินค้าและรถเข็น-->
<br/><br/><div class="wrapper2">
<?php include("footer.inc.php");?>
</div>
</body>
</html>
