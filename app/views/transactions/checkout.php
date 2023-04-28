<?php require APPROOT . "/views/templates/header.php"; ?>
	<header class="container-fluid col-12 p-0">
		<h1 class="display-5 px-4 py-2" style="background-color: darkblue; color: White">
			Checkout:
		</h1>
	</header>
	
	<div class="container">
		<div class="card card-body mb-3">
			<h4 class="card-title">These are the items added:</h4>
			<table class="table table-sm table-bordered">
				<thead>
				<tr>
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
            <h3 class="d-flex justify-content-center">Total Price: <?php echo $data["totalPrice"] ?></h3>
		</div>
        
        <div class="card card-body mb-3">
			<h4 class="card-title">Check your shipping details:</h4>
            <form action="<?php echo URLROOT."/transactions/checkout" ?>" method="post" style="display: inline">
                <label for="shippingAddress">Shipping Address: <sup>*</sup></label><br/>
                <span class="text-muted">Note: Feel free to change the shipping address to your preferred one.</span>
                <input type="text" name="shippingAddress" class="form-control form-control-lg <?php echo (isset($data["error"]["shippingAddress_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["shippingAddress"]; ?>" required>
                <span class="invalid-feedback"><?php echo (isset($data["error"]["shippingAddress_err"]) ? $data["error"]["shippingAddress_err"] : "") ?></span><br/>
                
                <label for="shippingMethod">Preferred shipping method: <sup>*</sup></label>
                <select class="form-select" name="shippingMethod">
                    <option value="delivery">Delivery</option>
                    <option value="pickup">Pickup</option>
                </select>
                <br/>
    
                <label for="paymentMethod">Preferred payment method: <sup>*</sup></label>
                <select class="form-select" name="paymentMethod">
                    <option value="cash">Cash on Delivery</option>
                    <option value="gcash">GCash</option>
                </select>
                <p class="text-muted">Note: If selecting GCash, please wait for the store to contact you.</p>
                
                <br/>
                <div class="container d-flex justify-content-center">
                    <input type="submit" value="Checkout" class="btn btn-success mx-1">
                    <a class="btn btn-primary mx-1" href="<?php echo URLROOT."/transactions" ;?>">
                        <i class="fa fa-angle-double-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
	</div>

<?php require APPROOT . "/views/templates/footer.php"; ?>