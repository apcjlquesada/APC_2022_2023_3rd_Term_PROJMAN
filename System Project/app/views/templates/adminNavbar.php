<nav class="navbar navbar-expand-lg navbar-light mb-3" style="background-color: darkblue">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-8" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-2">
				<?php if(!isset($_SESSION["admin_login"])) { ?>
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="<?php echo URLROOT."/admin/login" ?>">Login</a>
                    </li>
				<?php } else { ?>
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="<?php echo URLROOT; ?>/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="<?php echo URLROOT; ?>/admin/customers">Customers</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="<?php echo URLROOT; ?>/admin/products">Products</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="<?php echo URLROOT; ?>/admin/reports">Reports</a>
                    </li>
            </ul>
                    <div class="d-flex justify-content-end">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-2">
                            <li class="nav-item px-2">
                                <a class="nav-link text-white" href="<?php echo URLROOT."/admin/profile" ?>">
                                    <i class="fa fa-solid fa-user" style="font-size:24px;color:white">
										<?php echo $_SESSION["admin_info"]->fname ?>
                                    </i>
                                </a>
                            </li>
                            <li class="nav-item px-4">
                                <a class="nav-link text-white" href="<?php echo URLROOT."/admin/login/logout" ?>">Logout</a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
        </div>
    </div>
</nav>