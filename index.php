<!DOCTYPE html>
<html>
<head>
    <title>Order Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class='jumbotron'>
    <div class='container'>
        <h2>Acme Accessory Sales</h2>
    </div>
</div>
<form action='processForm.php' method='post'>
    
    <?php include 'menuOrder.html'; //Thanh menu active nút Orderform
    ?> 
    <div class='container'>
        <div class='panel panel-info'>
            <div class='panel-heading'>
                <h2>User</h2>
            </div>
            <div class='panel-body'>
                <div class='form-group'>
                    <label for='name'>Name</label>
                    <input type='text' class='form-control' name='name'/>
                </div>
                <div class='form-group'>
                    <label>Email</label>
                    <input type='email' class='form-control' name='email'/>
                </div>
                <div class='form-group'>
                    <label>Phone number</label>
                    <input type='text' class='form-control' name='pnumber'/>
                </div>
            </div>
        </div>

        <div class='panel panel-success'>
            <div class='panel-heading'>
                <h2 class='modal-title'>Items</h2>
            </div>

            <div class='panel-body'>
                <div class='row'>
                    <div class="col-md-6">
                        <h4 class="#">iPhone 12 case</h4>
                        <p class='#'>$15.50</p>
                    </div>
                    <div class='col-md-3 form-group'>
                        <label>Quantity</label>
                        <select class='form-control' name='i12_q'>
                                <option value='0' selected='selected'>0</option>
                                <?php
                                for ($i=1; $i <= 30; $i++) { 
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                        </select> 
                    </div>
                    <div class='col-md-3'></div>
                </div>  
                <hr>        
                <div class='row'>
                    <div class="col-md-6">
                        <h4 class="#">iPhone 13 case</h4>
                        <p class='#'>$20.00</p>
                    </div>
                    <div class='col-md-3 form-group'>
                        <label>Quantity</label>
                        <select class='form-control' name='i13_q'>
                                <option value='0' selected='selected'>0</option>
                                <?php
                                for ($i=1; $i <= 30; $i++) { 
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select> 
                    </div>
                    <div class='col-md-3'></div>
                </div>
                <hr>
                <div class='row'>
                    <div class="col-md-6">
                        <h4 class="#">Samsung Galaxy case</h4>
                        <p class='#'>$17.50</p>
                    </div>
                    <div class='col-md-3 form-group'>
                        <label>Quantity</label>
                        <select class='form-control' name='sg_q'>
                                <option value='0' selected='selected'>0</option>
                                <?php
                                for ($i=1; $i <= 30; $i++) { 
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                        </select> 
                    </div>
                    <div class='col-md-3'></div>
                </div>
                <hr>
                <div class='row'>
                    <div class="col-md-6">
                        <h4 class="#">Google Pixel case</h4>
                        <p class='#'>$16.50</p>
                    </div>
                    <div class='col-md-3 form-group'>
                        <label>Quantity</label>
                        <select class='form-control' name='gp_q'>
                                <option value='0' selected='selected'>0</option>
                                <?php
                                for ($i=1; $i <= 30; $i++) { 
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select> 
                    </div> 
                    <div class='col-md-3'></div>  
                </div>                
            </div>
        </div>
        <button type='submit' class='btn btn-secondary' name='submit' value='Submit'>Submit</button>
    </div>
</form>
</body>
</html>
