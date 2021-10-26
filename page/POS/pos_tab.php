<style type="text/css">
	fieldset, table, th, td {
  border: 2px solid gray;
  border-collapse: collapse;

}

th{
	background-color: #1565c0;
	color: white;
}

table{
	font-family: ubuntu;
}

</style>

<div class="col l12 m12 s12">
	<div class="row">
		<div class="col l8 m8 s8">

			<div class="row">

				<?php
				require '../process/conn.php';
					$c = 0;
				$select =" SELECT * FROM products";
				$stmt = $conn->prepare($select);
				$stmt->execute();
				foreach($stmt->fetchALL()as $j){
						$c++;
			echo'	<div class="col l4 m12 s12">
					 <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title center"><h4 id="product_name'.$j['id'].'">'.$j['product_name'].'</h4></span>
   					    	<span class="card-title center">Price:<h4 id="price'.$j['id'].'">'.$j['price'].'</h4></span>
         <p class="center"><span>QTY</span>
     
         <button onclick="minus_qty(&quot;'.$j['id'].'&quot;)"> - </button>  <button onclick="add_qty(&quot;'.$j['id'].'&quot;)"> + </button>
         <input type="number" name="qty" value="1" class="white-text center qty" id="quantity'.$j['id'].'"> 

         </p>  
        </div>
        <div class="card-action center">
          <button class="btn" name="order" id="order" onclick="order(&quot;'.$j['id'].'&quot;)"> Order</button>
        
        </div>
      </div>
				</div>';
}
				?>
		
			</div>
		</div>


		<div class="col l4 m12 s12">
			
			<fieldset>
<legend id="TRID" name="TRID"> Transaction</legend>
<table class="striped highlight centered">
<thead>
  <tr>
  	<th>#</th>
    <th>Product Name</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total </th>
  </tr>
  </thead>
  <tbody id="orders">
 
  </tbody>


  <tfooter>
  <tr>
  	  <td colspan="3" style="text-align:right;">Sub Total:</td>
  <td colspan="2" id="subtotal_data"></td>
  </tr>
  <tr>
  <td colspan="3" style="text-align:right;">Payment:</td>
  <td colspan="2"><input type="number" name="payment" id="payment" onchange="payment('subtotal_data')"></td>
  </tr>
  <tr>
  	<td colspan="3" style="text-align:right;">Change:</td>
    <td colspan="2" id="change"> </td>
  </tr>
   <tr>
  	<td colspan="3" style="text-align:right;">Grand Total:</td>
    <td colspan="2" id="grand_total"> </td>
  </tr>
  </tfooter>
</table>

</fieldset>
		</div>
	</div>
</div>
<script type="text/javascript">
	// GENERATE TR Code
const generateTr =()=>{
    $.ajax({
        url: '../process/processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'generateTrCode'
        },success:function(response){
            $('#TRID').html(response);
        }
    });
} 



	const add_qty =(x)=>{
			var prod_qty = document.getElementById('quantity'+x).value;
			prod_qty = parseInt(prod_qty) + 1;

			var new_prod_qty = document.getElementById('quantity'+x).value = prod_qty;
			console.log(prod_qty);
	}

	const minus_qty =(x)=>{
				var prod_qty2 = document.getElementById('quantity'+x).value;
				prod_qty2 = parseInt(prod_qty2) - 1;
				if(prod_qty2 < 0){
					prod_qty2 = 0;
				}
			var new_prod_qty = document.getElementById('quantity'+x).value = prod_qty2;
			console.log(prod_qty2);
	}

	const order =(x)=>{
				 var product_name = document.querySelector('#product_name'+x).innerHTML;
				  var price = document.querySelector('#price'+x).innerHTML;
				   var quantity = document.querySelector('#quantity' +x).value;
						var tr = document.querySelector('#TRID').innerHTML;
				 console.log(product_name);
				 console.log(price);
				 console.log(tr);

				 $.ajax({
				 url: '../process/processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'save',
            id:x,
            product_name:product_name,
            price:price,
            quantity:quantity,
            tr:tr
        },success:function(response){
           console.log(response);
          if(response == 'success'){
   	
          	M.toast({html:'Ordered'});
          	setTimeout(load_order, 1000);
          	$('#quantity'+x).val('1');
          }else{
          	M.toast({html:'Error'});
          }
        }
				 }); 		
		}

const load_order =()=>{

				 $.ajax({
        url:'../process/processor.php',
        type:'POST',
        cache:false,
        data:{
            method:'prev_order'
        },success:function(response){
            $('#orders').html(response);
            var subtotal = [];
            $('.subtotal').each(function(){
            	subtotal.push($(this).html());
            });

            $('#subtotal_data').html(eval(subtotal.join('+')));
            $('#grand_total').html(eval(subtotal.join('+')));
        }
    });

}

function payment(subtotal){
	var subtotal =  document.getElementById(subtotal).innerHTML;
	var payment = document.getElementById('payment').value;
	
	var compute = parseFloat(payment - subtotal);

	$('#change').html(compute);
	console.log(compute);
	
}
</script>