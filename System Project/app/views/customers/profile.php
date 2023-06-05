<?php require APPROOT . '/views/templates/header.php'; ?>
	<header class="container-fluid col-12 p-0">
		<h5 class="display-5 px-4 py-2" style="background-color: darkblue; color: White">
			<?php echo $data['title']; ?>
		</h5>
	</header>
	
	<!------------------- Start - Customer's Information ----------------->
	<section class="card container p-2 my-3">
        <div>
            <h1 class="card-title">
                Personal Information:
                <a class="btn btn-primary float-end me-1" href="<?php echo URLROOT;?>">
                    <i class="fa fa-angle-double-left"></i> Back
                </a>
                <a href="<?php echo URLROOT."/customers/updateProfile/"; ?>" class="btn btn-primary float-end me-1">
                    <i class="fa fa-pencil"></i> Update
                </a>
            </h1>
        </div>
		<div class="card card-body m-3">
		    <div>
                <h4>
                    Customer's name: <?php echo $data["user_info"]->fname . " " . $data["user_info"]->lname; ?>
                </h4>
                <b>Customer ID:</b> <?php echo $data["user_info"]->id; ?> <br/>
                <b>Contact Number:</b> <?php echo $data["user_info"]->contactNumber; ?> <br/>
                <b>Email Address:</b> <?php echo $data["user_info"]->email; ?> <br/>
                <b>Address:</b> <?php echo $data["user_info"]->streetAddress .", ". $data["user_info"]->city .", ". $data["user_info"]->province .", ". $data["user_info"]->postalCode; ?> <br/>
                <b>Profile Created On:</b> <?php echo $data["user_info"]->createdOn; ?> <br/>
            </div>
		</div>
	</section>
    <!------------------- End - Customer's Information ----------------->

    <section class="card container p-2 my-3">
    <h1 class="card-title">
        Orders:
    </h1>
    
    <!--------------------- FOR PAYMENT - START ---------------------->
    <div class="container">
        <div class="card card-body mb-3">
            <h4 class="card-title">For Payment:</h4>
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Img</th>
                    <th scope="col">Link</th>
                </tr>
                </thead>
				<?php foreach($data["forPaymentOrders"] as $key => $order) : ?>
                <tbody>
                <tr>
                    <th scope="row"><?php echo $key + 1; ?></th>
                    <td><?php echo $order->product_name; ?></td>
                    <td><?php echo $order->color; ?></td>
                    <td><?php echo $order->size; ?></td>
                    <td><?php echo $order->price; ?></td>
                    <td><?php echo $order->quantity; ?></td>
                    <td>
                        <img class="img-thumbnail" src="<?php echo URLROOT ."/img/products/".$order->img; ?>" style="max-height: 150px">
                    </td>
                    <td><a class="link" href="<?php echo URLROOT."/products/show/".$order->productId ?>">Click Here to see details:</a></td>
                </tr>
				<?php endforeach; ?>
            </table>
			<?php if(!empty($data["forPaymentOrders"])) { ?>
                <h5 class="d-flex justify-content-center">Status: <?php echo $data["forPaymentOrders"][0]->status ?></h5>
                <h5 class="d-flex justify-content-center">Total Price: <?php echo $data["totalPrice"] ?>php</h5>
                <h5 class="d-flex justify-content-center">Please wait for the store to contact you for the payment.</h5>
                
                <div class="container d-flex justify-content-center">
                    <form class="mx-1" action="<?php echo URLROOT."/transactions/cancelOrder/".$order->transactionId ?>" method="post" style="display: inline">
                        <input type="submit" value="Cancel" class="btn btn-danger">
                    </form>
                </div>
			<?php } ?>
        </div>
    </div>
    <!--------------------- FOR PAYMENT - END ---------------------->

    <!--------------------- FOR SHIPPING - START ---------------------->
    <div class="container">
        <div class="card card-body mb-3">
            <h4 class="card-title">For Shipping:</h4>
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Img</th>
                    <th scope="col">Link</th>
                </tr>
                </thead>
				<?php foreach($data["forShippingOrders"] as $key => $order) : ?>
                <tbody>
                <tr>
                    <th scope="row"><?php echo $key + 1; ?></th>
                    <td><?php echo $order->product_name; ?></td>
                    <td><?php echo $order->color; ?></td>
                    <td><?php echo $order->size; ?></td>
                    <td><?php echo $order->price; ?></td>
                    <td><?php echo $order->quantity; ?></td>
                    <td>
                        <img class="img-thumbnail" src="<?php echo URLROOT ."/img/products/".$order->img; ?>" style="max-height: 150px">
                    </td>
                    <td><a class="link" href="<?php echo URLROOT."/products/show/".$order->productId ?>">Click Here to see details:</a></td>
                </tr>
				<?php endforeach; ?>
            </table>
        </div>
    </div>
    <!--------------------- FOR SHIPPING - END ---------------------->

    <!--------------------- COMPLETED ORDERS - START ---------------------->
    <div class="container">
        <div class="card card-body mb-3">
            <h4 class="card-title">Completed Orders:</h4>
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Img</th>
                    <th scope="col">Link</th>
                </tr>
                </thead>
				<?php foreach($data["completedOrders"] as $key => $order) : ?>
                <tbody>
                <tr>
                    <th scope="row"><?php echo $key + 1; ?></th>
                    <td><?php echo $order->product_name; ?></td>
                    <td><?php echo $order->color; ?></td>
                    <td><?php echo $order->size; ?></td>
                    <td><?php echo $order->price; ?></td>
                    <td><?php echo $order->quantity; ?></td>
                    <td>
                        <img class="img-thumbnail" src="<?php echo URLROOT ."/img/products/".$order->img; ?>" style="max-height: 150px">
                    </td>
                    <td><a class="link" href="<?php echo URLROOT."/products/show/".$order->productId ?>">Click Here to see details:</a></td>
                </tr>
				<?php endforeach; ?>
            </table>
        </div>
    <!--------------------- COMPLETED ORDERS - END ---------------------->
    </div>
    </section>

<?php require APPROOT . "/views/templates/footer.php"; ?>