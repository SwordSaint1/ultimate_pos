<?php
	include 'conn.php';
	$method = $_POST['method'];

	if ($method == 'save') {
		$id = $_POST['id'];
		$product_name = $_POST['product_name'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];

		$x = $price * $quantity;

		$insert = "INSERT INTO orders (`product_name`,`quantity`,`price`,`total`)
		VALUES ('$product_name', '$price', '$quantity','$x')";
		$stmt = $conn->prepare($insert);
	
		if($stmt->execute()){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	if($method == 'prev_order'){
		$select = "SELECT * FROM orders";
		$stmt = $conn->prepare($select);
		$stmt->execute();

		foreach($stmt->fetchALL() as $j){
			echo '<tr>';
			echo '<td>'.$j['product_name'].'</td>';
			echo '<td>'.$j['price'].'</td>';
			echo '<td>'.$j['quantity'].'</td>';
			echo '<td>'.$j['total'].'</td>';
			echo '</tr>';
		}
	}





?>