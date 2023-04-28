<?php require APPROOT.'/views/templates/adminHeader.php'; ?>

    <div class="container">
        <div class="card card-body mb-3">
            <h4 class="card-title">Pending Orders For Payment:</h4>
            <?php foreach($data["forPaymentTransactions"] as $key => $details) : ?>
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Method</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $key + 1; ?></th>
                            <td><?php echo $details->name; ?></td>
                            <td><?php echo $details->transactionId; ?></td>
                            <td><?php echo $details->customerId; ?></td>
                            <td><?php echo $details->amount; ?></td>
                            <td><?php echo $details->status; ?></td>
                            <td><?php echo $details->method; ?></td>
                            <td>
                                <form class="mx-1" action="<?php echo URLROOT."/admin/dashboard/markAsPaid/".$details->transactionId ?>" method="post" style="display: inline">
                                    <input type="submit" value="Mark as Paid" class="btn btn-success">
                                </form>
                                <form class="mx-1" action="<?php echo URLROOT."/transactions/seeDetails/".$details->transactionId ?>" method="post" style="display: inline">
                                    <input type="submit" value="See Details" class="btn btn-primary">
                                </form>
                                <form class="mx-1" action="<?php echo URLROOT."/transactions/cancelOrder/".$details->transactionId ?>" method="post" style="display: inline">
                                    <input type="submit" value="Cancel" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="container">
        <div class="card card-body mb-3">
            <h4 class="card-title">Pending Orders For Shipping:</h4>
			<?php foreach($data["forShippingTransactions"] as $key => $details) : ?>
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Shipping Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Method</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><?php echo $key + 1; ?></th>
                        <td><?php echo $details->name; ?></td>
                        <td><?php echo $details->transactionId; ?></td>
                        <td><?php echo $details->customerId; ?></td>
                        <td><?php echo $details->shippingAddress; ?></td>
                        <td><?php echo $details->status; ?></td>
                        <td><?php echo $details->method; ?></td>
                        <td>
                            <form class="mx-1" action="<?php echo URLROOT."/admin/dashboard/completeOrder/".$details->transactionId ?>" method="post" style="display: inline">
                                <input type="submit" value="Mark as Complete" class="btn btn-success">
                            </form>
                            <form class="mx-1" action="<?php echo URLROOT."/transactions/seeDetails/".$details->transactionId ?>" method="post" style="display: inline">
                                <input type="submit" value="See Details" class="btn btn-primary">
                            </form>
                            <form class="mx-1" action="<?php echo URLROOT."/transactions/cancelOrder/".$details->transactionId ?>" method="post" style="display: inline">
                                <input type="submit" value="Cancel" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
			<?php endforeach; ?>
        </div>
    </div>
    
<?php require APPROOT . "/views/templates/footer.php"; ?>