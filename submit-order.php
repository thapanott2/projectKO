
<!DOCTYPE HTML>
<html>
<head>
<title>KOKO TOUR</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("header.inc.php"); ?>
</head>
<body>
<div class="register_account">
	<div class="wrap">
		<?php
		if($_POST) {
			include("dbconn.inc.php");

			$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$address = nl2br(htmlspecialchars($_POST['address'], ENT_QUOTES));
			$phone = $_POST['phone'];
			$order_date = $_POST['date'];
		  	$email = $_POST['email'];
			$isDelivered = 'No';
			
			$sql = "INSERT INTO customer VALUES
						(0,'$name', '$address', '$phone', '$email', '$order_date', '$isDelivered');";

		@mysql_query($sql) or die(mysql_error());
		    header("Refresh: 3; url=index.php");
		  echo "ข้อมูลถูกจัดเก็บแล้ว จะกลับสู่หน้าหลักใน 3 วินาที";
		}
		?>
<h4 class="title">Check Out Product</h4>

	<form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="col_1_of_2 span_1_of_2">
				<div><input name="name" type="text" id="name" value="Input Your Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Input Your Name';}"></div>
				<div><input name="address" type="text" id="address" value="Input Your Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Input Your Address';}"></div>
				<div>Input Your Date:<input name="date" 	type="date" id="date" value="Input Your Date Order(example YYYY-MM-DD)" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Input Your Date Order YYYY-MM-DD';}"></div>
				<div><input name="email" type="text" id="email" value="Input Your E-Mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Input Your E-Mail';}"></div>
				<div><input name="phone" type="text" id="phone" value="Input Your Phone-Number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Input Your Phone-Number';}"></div>
				<div><input class="grey" type="submit" name="Submit" value="CHECKOUT-ORDER" /> </div>
      </div>
	</form>
 </div>
</div>
<div class="footer">
		<div class="footer-top">
			<div class="wrap">
        <div class="section group example" style="margin-top: 270px;">
				<div class="col_1_of_2 span_1_of_2">
					<ul class="f-list">
					  <li><img src="images/2.png"><span class="f-text">Good Way Good View Good Friend </span><div class="clear"></div></li>
					</ul>
				</div>
				<div class="col_1_of_2 span_1_of_2">
					<ul class="f-list">
					  <li><img src="images/3.png"><span class="f-text">Call us! 08-99898-9898 24 hour </span><div class="clear"></div></li>
					</ul>
				</div>
				<div class="clear"></div>
		      </div>
			</div>
		</div>
		<div class="footer-middle">
			<div class="wrap">
			 <div class="section group example">
			  <div class="col_1_of_f_1 span_1_of_f_1">
				 <div class="section group example">
				   <div class="col_1_of_f_2 span_1_of_f_2">
				      <h3>Facebook</h3>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="like_box">
							<div class="fb-like-box" data-href="https://www.facebook.com/pages/Koko-Chiang-Mai-Tour/1075162135831146" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
						</div>
 				  </div>
				  <div class="col_1_of_f_2 span_1_of_f_2">
						<h3>From Twitter</h3>
				       <div class="recent-tweet">
							<div class="recent-tweet-icon">
								<span> </span>
							</div>
							<div class="recent-tweet-info">
								<p>Ds which don't look even slightly believable. If you are <a href="#">going to use nibh euismod</a> tincidunt ut laoreet adipisicing</p>
							</div>
							<div class="clear"> </div>
					   </div>
					   <div class="recent-tweet">
							<div class="recent-tweet-icon">
								<span> </span>
							</div>
							<div class="recent-tweet-info">
								<p>Ds which don't look even slightly believable. If you are <a href="#">going to use nibh euismod</a> tincidunt ut laoreet adipisicing</p>
							</div>
							<div class="clear"> </div>
					  </div>
				</div>
				<div class="clear"></div>
		      </div>
 			 </div>
			 <div class="col_1_of_f_1 span_1_of_f_1">
			   <div class="section group example">
				 <div class="col_1_of_f_2 span_1_of_f_2">
				    <h3>Information</h3>
						<ul class="f-list1">
						    <li><a href="#">Duis autem vel eum iriure </a></li>
				            <li><a href="#">anteposuerit litterarum formas </a></li>
				            <li><a href="#">Tduis dolore te feugait nulla</a></li>
				             <li><a href="#">Duis autem vel eum iriure </a></li>
				            <li><a href="#">anteposuerit litterarum formas </a></li>
				            <li><a href="#">Tduis dolore te feugait nulla</a></li>
			         	</ul>
 				 </div>
				 <div class="col_1_of_f_2 span_1_of_f_2">
				   <h3>Contact us</h3>
						<div class="company_address">
					                <p>199/99 M.9 T.NaiMueng A.Mueng </p>
							   		<p>Chiang Mai,Thailand</p>
							   		<p>TH</p>
					   		<p>Phone: 000 111 222344</p>
					   		<p>Fax: 000 111 222344</p>
					 	 	<p>Email: Email Kokokuong</p>

					   </div>
					   <div class="social-media">
						     <ul>
						        <li> <span class="simptip-position-bottom simptip-movable" data-tooltip="Google"><a href="#" target="_blank"> </a></span></li>
						        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="Linked in"><a href="#" target="_blank"> </a> </span></li>
						        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="Rss"><a href="#" target="_blank"> </a></span></li>
						        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="Facebook"><a href="https://www.facebook.com/thapanott" target="_blank"> </a></span></li>
						    </ul>
					   </div>
				</div>
				<div class="clear"></div>
		    </div>
		   </div>
		  <div class="clear"></div>
		    </div>
		  </div>
		</div>
	</div>
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
	        				<td align=center><?php echo $item["quantity"]; ?></td>
	        				<td align=center><?php echo "$".$item["price"]; ?></td>
	        				<td align=center><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
	              </tr>
	                <?php
	                $item_total += ($item["price"]*$item["quantity"]);
	        		}
	        		?>
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
	    <div class="txt-heading2"><a id="btnEmpty" href="submit-order.php">CHECK IN ORDER</a></div>
	  </form>
</body>
</html>
