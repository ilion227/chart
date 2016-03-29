<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chart | Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="js/Chart.js"></script>
    
</head>
<body>
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit price</h4>
                </div>
                <div class="modal-body">
                    <div class="edit-form">
                        <input required class="form-control" type="number" id="edit-price" name="price" placeholder="Price">
                        <input required class="form-control" type="text" id="edit-color" name="color" placeholder="Color">
                        <input required class="form-control" type="text" id="edit-label" name="label" placeholder="Label">
                        <input hidden id="edit-id" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="edit-button">Edit price</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div id="winner-label">

    </div>
    <div id="above">
        <div id="spinner">

        </div>
        <div id="pointer"></div>

        <button type="button" name="action" id="action" class="btn btn-warning">Start spinning!</button>
        <label id="winner"></label>
    </div>
    <div id="page">
        <div id="content">
            <div id="main" class="container">
                <div id="chart" class="inner">
                    <legend><h3>Chart example</h3></legend>
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <script src="js/chartScript.js"></script>
                </div>
                <h1>Percentage</h1>
                <table id="percentage-table" class="table">
                    <tbody id="percentage-body">
                    </tbody>
                </table>
            </div>
            <div class="side">
                <div class="inner">
                    <legend><h3>Get data from database</h3></legend>
                    <button class="btn btn-success" type="button" id="getData">Update</button>
                    <div class="data-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Price</th>
                                    <th>Tickets</th>
                                    <th>Color</th>
                                    <th>Label</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data-table">
                            </tbody>
                        </table>
                    </div>
                    <div class="form">
                        <label for="price" class="form-label">Price</label>
                        <input required class="form-control" type="number" id="price" name="price" placeholder="Price">
                        <label for="color" class="form-label">Color</label>
                        <input required class="form-control" type="text" id="color" name="color" placeholder="Color">
                        <label for="label" class="form-label">Label</label>
                        <input required class="form-control" type="text" id="label" name="label" placeholder="Label">
                        <button class="btn btn-primary form-control" type="button" name="submit" id="submit">Add price</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer">

        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>