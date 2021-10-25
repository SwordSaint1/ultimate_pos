<style type="text/css">
	fieldset, table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
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
<legend> Transaction</legend>
<table>
<thead>
  <tr>
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
  <td colspan=""></td>
  </tr>
  <tr>
  <td colspan="3" style="text-align:right;">Payment:</td>
  <td colspan=""></td>
  </tr>
  <tr>
  	<td colspan="3" style="text-align:right;">Grand Total:</td>
    <td colspan=""> </td>
  </tr>
  </tfooter>
  
</table>
</fieldset>
		</div>
	</div>
</div>
<script type="text/javascript">


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
				 console.log(product_name);
				 console.log(price);
				 console.log(quantity);

				 $.ajax({
				 url: '../process/processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'save',
            id:x,
            product_name:product_name,
            price:price,
            quantity:quantity	
        },success:function(response){
           console.log(response);
          if(response == 'success'){
   
          	M.toast({html:'Ordered'});

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
        }
    });

}
</script>