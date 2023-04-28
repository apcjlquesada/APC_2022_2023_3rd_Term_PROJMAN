<?php require APPROOT . '/views/templates/adminHeader.php'; ?>

<?php if(!$data['customer']){
    echo "<div class='card card-body mb-3 text-center'><b>Not able to get any data! Please Contact Support.</b></div>";}

else{ ?>
    <h1>
        Customer's Details:
    </h1>
    <div class="card card-body mb-3">
        <h4 class="card-title">
            Customer's name: <?php echo $data['customer']->fname . " " . $data['customer']->lname; ?>
<!--            <form action="--><?php //echo URLROOT; ?><!--/admin/customers/delete/--><?php //echo $data['customer']->id; ?><!--" method="post" style="display: inline">-->
<!--                <input type="submit" value="Delete" class="btn btn-danger float-end me-1">-->
<!--            </form>-->
            <a class="btn btn-primary float-end me-1" href="<?php echo URLROOT;?>/admin/customers">
                <i class="fa fa-angle-double-left"></i> Back
            </a>
            <a href="<?php echo URLROOT; ?>/admin/customers/edit/<?php echo $data['customer']->id; ?>" class="btn btn-primary float-end me-1">
                <i class="fa fa-pencil"></i> Update
            </a>
        </h4>
        <div class="card-body bg-light p-2 mb-3">
            <b>Customer ID:</b> <?php echo $data['customer']->id; ?> <br/>
            <b>Contact Number:</b> <?php echo $data['customer']->contactNumber; ?> <br/>
            <b>Email Address:</b> <?php echo $data['customer']->email; ?> <br/>
            <b>Address:</b> <?php echo $data['customer']->streetAddress .", ". $data['customer']->city .", ". $data['customer']->province .", ". $data['customer']->postalCode; ?> <br/>
            <b>Profile Created On:</b> <?php echo $data['customer']->createdOn; ?> <br/>
        </div>
    </div>
    <h3>Customer's Feedbacks and Reviews</h3>
    <p>Under Construction</p>
    <h3>Customer's Order History</h3>
    <p>Under Construction</p>

<?php } ?>

<?php require APPROOT . '/views/templates/footer.php'; ?>
