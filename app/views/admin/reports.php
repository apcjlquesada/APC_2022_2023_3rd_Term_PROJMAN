<?php require APPROOT.'/views/templates/adminHeader.php'; ?>


<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-3">
            <div class="card border-warning" style="max-width: 30rem;">
                <div class="card-header fw-bold mb-3" style="background-color:gold;">TOTAL TRANSACTIONS</div>
                <div class="card-body">
                    <p class="card-text">-----</p>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" style="background-color: gold;"
                                id="transactionsContent" data-bs-toggle="dropdown" aria-expanded="false">
                            Total Transactions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="transactionsContent">
                            <li><a class="dropdown-item" href="#">Daily</a></li>
                            <li><a class="dropdown-item" href="#">Weekly</a></li>
                            <li><a class="dropdown-item" href="#">Monthly</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mb-3" style="max-width: 30rem;">
                <div class="card-header fw-bold mb-3" style="background-color:gold;">TOTAL CUSTOMERS</div>
                <div class="card-body">
                    <p class="card-text">-----</p>
                    <h5 class="card-title fw-bold">Customers</h5>
                    <div class="container pe-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mb-3" style="max-width: 30rem;">
                <div class="card-header fw-bold mb-3" style="background-color:gold;">TOTAL SALES</div>
                <div class="card-body">
                    <p class="card-text">-----</p>
                    <h5 class="card-title fw-bold">Sales</h5>
                    <div class="container pe-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mb-3" style="max-width: 30rem;">
                <div class="card-header fw-bold mb-3" style="background-color:gold;">TOTAL STOCKS</div>
                <div class="card-body">
                    <p class="card-text">7</p>
                    <h5 class="card-title fw-bold">Stocks</h5>
                    <div class="container pe-3">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>