<?php require APPROOT . "/views/templates/header.php"; ?>
	<header class="container-fluid col-12 p-0">
		<h1 class="display-5 px-4 py-2" style="background-color: darkblue; color: White">
			Transactions:
		</h1>
	</header>
	
    <!--------------------- PENDING - START ---------------------->
    <div class="container">
		<div class="card card-body mb-3">
			<h4 class="card-title">Shopping Cart:</h4>
			<table class="table table-sm table-bordered">
				<thead>
				<tr>
<!--					<th><input type="checkbox" onClick="toggle(this)"/></th>-->
					<th scope="col">#</th>
					<th scope="col">Product Name</th>
					<th scope="col">Color</th>
					<th scope="col">Size</th>
					<th scope="col">Price</th>
					<th scope="col">Quantity</th>
					<th scope="col">Stocks</th>
					<th scope="col">Img</th>
					<th scope="col">Link</th>
					<th></th>
				</tr>
				</thead>
				<?php foreach($data["shoppingCart"] as $key => $order) : ?>
					<tbody>
					<tr>
<!--						<td><input type="checkbox" id="--><?php //echo $order->orderId ?><!--" name="orders" value="--><?php //echo $order->orderId ?><!--"/></td>-->
						<th scope="row"><?php echo $key + 1; ?></th>
						<td><?php echo $order->product_name; ?></td>
						<td><?php echo $order->color; ?></td>
						<td><?php echo $order->size; ?></td>
						<td><?php echo $order->price; ?></td>
						<td class="<?php echo ($order->stock < $order->quantity ? "table-danger" : "") ?>">
							<?php echo $order->quantity; ?>
							<div class="alert-danger"><i><?php echo ($order->stock < $order->quantity ? "This order will not proceed as not enough stocks" : "") ?></i></div>
						</td>
						<td><?php echo $order->stock; ?></td>
						<td>
                            <img class="img-thumbnail" src="<?php echo URLROOT ."/img/products/".$order->img; ?>" style="max-height: 150px">
                        </td>
						<td><a class="link" href="<?php echo URLROOT."/products/show/".$order->productId ?>">Click Here to see details:</a></td>
                        <td>
                            <form action="<?php echo URLROOT."/transactions/removeFromCart/".$order->orderId ?>" method="post" style="display: inline">
                                <input type="submit" value="Remove" class="btn btn-danger">
                            </form>
                        </td>
					</tr>
				<?php endforeach; ?>
			</table>
            <?php if(!empty($data["shoppingCart"])) { ?>
                <h3 class="d-flex justify-content-center">Total Price: <?php echo $data["totalPrice"] ?>php</h3>
                <div class="container d-flex justify-content-center">
                    <a href="<?php echo URLROOT; ?>/transactions/checkout" class="btn btn-primary">
                        Checkout
                    </a>
                </div>
            <?php } ?>
		</div>
		<script>
			function toggle(source) {
                checkboxes = document.getElementsByName('orders');
                for(var i = 0, n=checkboxes.length; i<n; i++){
                    checkboxes[i].checked = source.checked;
				}
			}
		</script>
	</div>
    <!--------------------- PENDING - END ---------------------->

<?php require APPROOT . "/views/templates/footer.php"; ?>