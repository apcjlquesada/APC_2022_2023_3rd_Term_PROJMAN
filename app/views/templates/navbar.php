<nav class="navbar navbar-expand-lg navbar-light" style="background-color: darkblue">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-8" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-2">
                <li class="nav-item px-4">
                    <a class="nav-link text-white" href="<?php echo URLROOT; ?>">Home</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link text-white" href="<?php echo URLROOT; ?>/products">Products</a>
                </li>
<!--                <li class="nav-item px-4">-->
<!--                    <a class="nav-link text-white" href="--><?php //echo URLROOT?><!--/pages/forum">Forum</a>-->
<!--                </li>-->
                <li class="nav-item px-4">
                    <a class="nav-link text-white" href="<?php echo URLROOT?>/pages/faq">FAQs</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link text-white" href="<?php echo URLROOT?>/pages/about">About Villamin</a>
                </li>
                <form class="d-flex px-4">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </ul>
        </div>
        <div class="d-flex align-items-end ms-auto">
            <ul class="navbar-nav mb-2 mb-lg-0 ps-2">
                <?php if(!isset($_SESSION["login"])) { ?>
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="<?php echo URLROOT."/customers/login" ?>">Login</a>
                    </li>
                <?php } else { ?>
<!--                    <button type="button" class="btn position-relative">-->
<!--                        <i class="fa fa-bell-o" style="font-size:24px;color:white"></i>-->
<!--                        <span class="badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>-->
<!--                    </button>-->
                    <button type="button" class="btn">
                        <a href="<?php echo URLROOT."/transactions"; ?>">
                            <i class="fa fa-shopping-cart" style="font-size:24px;color: white"></i>
                        </a>
                    </button>
                    
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="<?php echo URLROOT."/customers/profile" ?>">
                            <i class="fa fa-solid fa-user" style="font-size:24px;color:white">
                                <?php echo $_SESSION["user_info"]->fname ?>
                            </i>
                        </a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="<?php echo URLROOT."/customers/logout" ?>">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>