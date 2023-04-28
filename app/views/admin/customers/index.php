<?php require APPROOT . "/views/templates/adminHeader.php"; ?>

    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Customers</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/admin/customers/add" class="btn btn-primary float-end">
                <i class="fa fa-plus"></i> Add Customer
            </a>
        </div>
    </div>
    <?php foreach($data["customers"] as $customer) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title">
                Customer's Name: <?php echo $customer->fname . " " . $customer->lname; ?>
<!--                <form action="--><?php //echo URLROOT."/admin/customers/delete/".$customers->id; ?><!--" method="post" style="display: inline">-->
<!--                    <input type="submit" value="Delete" class="btn btn-danger float-end me-1">-->
<!--                </form>-->
                <a href="<?php echo URLROOT."/admin/customers/edit/".$customer->id; ?>" class="btn btn-primary float-end me-1">
                    <i class="fa fa-pencil"></i> Update
                </a>
                <a class="btn btn-primary float-end me-1" href="<?php echo URLROOT."/admin/customers/show/".$customer->id; ?>">
                    <i class="fa fa-eye"></i> View
                </a>
            </h4>
        </div>

    <?php endforeach; ?>
<?php require APPROOT . "/views/templates/footer.php"; ?>