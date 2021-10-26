<?php
	include 'conn.php';
	$method = $_POST['method'];
//GENERATE TRANSACTION CODE
	if($method == 'generateTrCode'){
		$prefix = "TR:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}
//SAVE ORDER
	if ($method == 'save') {
		$id = $_POST['id'];
		$product_name = $_POST['product_name'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$tr = trim($_POST['tr']);

		$x = $price * $quantity;

		$insert = "INSERT INTO orders (`transaction_no`,`product_name`,`price`,`quantity`,`total`)
		VALUES ('$tr','$product_name', '$price', '$quantity','$x')";
		$stmt = $conn->prepare($insert);
	
		if($stmt->execute()){
			echo 'success';
		}else{
			echo 'error';
		}
	}

//PREVIEW ORDER
	if($method == 'prev_order'){
		$c = 0;
		$select = "SELECT *,sum(quantity) as quantity, sum(total) as total from orders group by product_name ORDER BY id DESC";
		$stmt = $conn->prepare($select);
		$stmt->execute();
		
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr>';
			echo '<td>'.$c.'</td>';
			echo '<td>'.$j['product_name'].'</td>';
			echo '<td>'.$j['price'].'</td>';
			echo '<td>'.$j['quantity'].'</td>';
			echo '<td class="subtotal">'.$j['total'].'</td>';
			echo '</tr>';
		}
	}





?>