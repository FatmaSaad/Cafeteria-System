<?php include 'adminHeader.php' ?>

<div class="container">

    <div class="row">
        <div class="input-group my-3 col-sm-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="dateFrom">From</span>
            </div>
            <input type="date" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>
        <div class="input-group my-3 col-sm-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="dateTo">To</span>
            </div>
            <input type="date" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>
    </div>
    <button class="btn btn-info mb-4"> Filter </button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Expand</th>
                <th scope="col">Name</th>
                <th scope="col">Total $</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <button type="button" class="btn border border-dark rounded-circle" data-toggle="modal" data-target="#detailsModal">
                        +
                    </button>
                </th>
                <td scope="row">1</td>
                <td>Mark</td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCenterTitle">Modal title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">Total $ Per Day</th>
                            </tr>
                        </thead>
                        <tbody id="accordion">
                            <?php //recieve data and create detailed orders for each entry in the data 
                            ?>
                            <tr>
                                <th scope="row">
                                    <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn border border-dark rounded-circle">
                                        +
                                    </button>
                                    <?php // date of the order 
                                    ?>
                                </th>
                                <td> <?php // total price 
                                        ?> </td>
                            </tr>
                            <tr id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                <td colspan="2">
                                    <?php //detailed orders  
                                    ?>
                                </td>
                            </tr>
                            <?php // end for here 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'adminFooter.php' ?>