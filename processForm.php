<!DOCTYPE html>
<html>
<head>
    <title>Process Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<!--
    - Cố truy cập processForm.php không thông qua orderForm.php:
        + Đưa cho người dùng 1 link trở lại orderForm.php, 
        + Hiện 1 tin nhắn rằng để mua thì cần phải điền trang orderForm.php.    
    - Kiểm tra: tên và số điện thoại đầy đủ, đặt ít nhất 1 mặt hàng (emty($_POST['quantity'])).
        + Nếu không thõa, hiện link trở lại orderForm (<a href='orderForm.php'></a>)
    - Tính toán: thành tiền chưa tính thuế, tiền thuế, tổng tiền phải trả, tổng thanh toán.\
    - Nếu tổng thanh toán trên 65$ thì miễn ship.
    - Trình bày: Thông tin người mua, thông tin đơn hàng, thành tiền chưa tính thuế, tiền thuế, tiền ship, tổng thanh toán và thời gian xử lý.
        + Tạo danh sách đồ đã mua.
        + Hiện tin nhắn báo miễn ship
        + Trình bày ngày tháng, thời gian đơn hàng được xử lý
    - Thông báo rằng họ sẽ được liên lạc trong ngày kinh doanh tiếp theo.
    - Lưu thông tin vào caseOrder.txt.
        + Thông tin được phân tách bới 1 /t 
        + /r/n mỗi cuối đơn hàng để xuống dòng
           VD:Jim Bowers        902-222-2222     jbowers@hollandcollege.com      2   iPhone 12   0   iPhone 13   0   Samsung    0   Pixels      1/30/2021     2:46pm    35.65$
        + Đảm bảo khóa tệp tin trước khi lưu trữ thêm, và mở khóa nó sau đó.
    
-->
<body>
<div class='jumbotron'>
    <div class='container'>
        <h2>Acme Accessory Sales</h2>
    </div>
</div>
<?php include 'menuProcess.html'; ?>
<div class='container'>
<?php
//- Cố truy cập processForm.php không thông qua orderForm.php:
//  + Đưa cho người dùng 1 link trở lại orderForm.php (action='orderForm.php'), 
//  + Hiện 1 tin nhắn rằng để mua thì cần phải điền trang orderForm.php.
if (empty($_POST['name']) && empty($_POST['email']) && empty($_POST['pnumber']) && empty($_POST['i12_q']) && empty($_POST['i13_q']) && empty($_POST['sg_q']) && empty($_POST['gp_q'])){
    echo 
    "
    <div class='panel panel-warning'>
        <div class='panel-heading'>
            <h2>Notice!</h2>
        </div>
        <div class='panel-body'>In order to buy something you need to fill out the Order Form page first.</div>
        <div class='panel-footer'>
            <a href='orderForm.php' class='btn btn-default'>Back</a>
        </div>
    </div>
    ";
    exit;
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone_number = $_POST['pnumber'];
$i12_quantity = $_POST['i12_q'];
$i13_quantity = $_POST['i13_q'];
$sg_quantity = $_POST['sg_q'];
$gp_quantity = $_POST['gp_q'];
$i12_cost = 15.50;
$i13_cost = 20.00;
$sg_cost = 17.50;
$gp_cost = 16.50;
$tax_rate = 15;
$delivery_amount = 5.00;

//- Kiểm tra: tên, số điện thoại đầy đủ và đặt ít nhất 1 mặt hàng (emty($i12_quantity))
//  + Nếu không thõa, hiện link trở lại orderForm (href='orderForm.php')
$message = '';
#Không đặt hàng
if (empty($i12_quantity) && empty($i13_quantity) && empty($sg_quantity) && empty($gp_quantity)){
    $message .= 'There must be at least one thing ordered.<br>';
};
#Không điền tên và số điện thoại
if (empty($name) || empty($phone_number)){
    $message .= 'Name and phone number must be filled in.<br>';
}
if ($message != ''){
    echo 
    "
    <div class='panel panel-warning'>
        <div class='panel-heading'>
            <h2>Notice!</h2>
        </div>
        <div class='panel-body'>$message</div>
        <div class='panel-footer'>
            <a href='orderForm.php' class='btn btn-default'>Back</a>
        </div>
    </div>
    ";
    exit;
}



//- Tính toán: thành tiền chưa tính thuế, tiền thuế, tổng thanh toán.
$net_amount = $i12_cost*$i12_quantity + $i13_cost*$i13_quantity + $sg_cost*$sg_quantity + $gp_cost*$gp_quantity;
$tax_amount = $net_amount * ($tax_rate/100);
$total_amount = $net_amount + $tax_amount;
//- Nếu tổng thanh toán trên 65$ thì miễn ship.
if ($total_amount > 65){
    $delivery_amount = 0;
};
$total_amount += $delivery_amount;

//- Trình bày: thông tin người mua, thông tin đơn hàng, thành tiền chưa tính thuế, tiền thuế, tiền ship, tổng thanh toán.
//  + Danh sách đồ được mua.
$items = '<p><b>Items</b></p>';
$quantity = '<p><b>Quantity</b></p>';
if ($i12_quantity != 0){
    $items .= '<p>iPhone 12 case</p>';
    $quantity .= "<p>$i12_quantity</p>";
};
if ($i13_quantity != 0){
    $items .= '<p>iPhone 12 case</p>';
    $quantity .= "<p>$i13_quantity</p>";
};
if ($sg_quantity != 0){
    $items .= '<p>Samsung Galaxy case</p>';
    $quantity .= "<p>$sg_quantity</p>";
};
if ($gp_quantity != 0){
    $items .= '<p>Google Pixel case</p>';
    $quantity .= "<p>$gp_quantity</p>";
};

//  + Tin nhắn free ship
if ($delivery_amount == 0){
    $delivery_amount = "$delivery_amount$ (delivery is free)";
}else{
    $delivery_amount = "$delivery_amount$";
};

// Lưu ngày tháng, thời gian xử lý
$date = date('jS F Y');
$time = date('H:i');

//  + Trình bày
echo 
"
<div class='panel panel-primary'>
    <div class='panel-heading'>
        <h1>Your bill</h1>
    </div>
    <div class='panel-body'>
        <div class='row'>
            <div class='col-md-6'>
                <p><b>Name</b></p>
                <p><b>Email</b></p>
                <p><b>Phone number</b></p>
            </div>
            <div class='col-md-6'>
                <p>$name</p>
                <p>$email</p>
                <p>$phone_number</p>
            </div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-md-6'>$items</div>
            <div class='col-md-6'>$quantity</div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-md-6'><b>Net amount</b></div>
            <div class='col-md-6'>$net_amount$</div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-md-6'><b>Tax amount</b></div>
            <div class='col-md-6'>$tax_amount$</div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-md-6'><b>Delivery amount</b></div>
            <div class='col-md-6'>$delivery_amount</div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-md-6'><b>Total amount</b></div>
            <div class='col-md-6'>$total_amount$</div>
        </div>
    </div>
    <div class='panel-footer'>
        <div class='row'>
            <div class='col-md-12'>
                Order processed on $date at $time
            </div>
        </div>
    </div>
</div>
";

//- Thông báo rằng họ sẽ được liên lạc trong ngày kinh doanh tiếp theo.
echo "
<div class='alert alert-info'>You will be contacted within the next business day.</div>
";

//- Lưu thông tin vào caseOrder.txt.
//  + Thông tin được phân tách bới 1 /t 
//  + /r/n mỗi cuối đơn hàng để xuống dòng
//  + Đảm bảo khóa tệp tin trước khi lưu trữ thêm, và mở khóa nó sau đó.
$fw = fopen('orders\caseOrder.txt','a');
flock($fw, LOCK_EX);
fwrite($fw,"$name\t$phone_number\t$email\t$i12_quantity\tiPhone 12\t$i13_quantity\tiPhone 13\t$sg_quantity\tSamsung\t$gp_quantity\tPixels\t$date\t$time\t$total_amount$\r\n");
flock($fw, LOCK_UN);
fclose($fw);
?>
</div>
</body>
</html>