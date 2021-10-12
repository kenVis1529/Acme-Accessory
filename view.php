<!DOCTYPE html>
<html>
<head>
    <title>View</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<!--
    - Tạo danh sách các đơn hàng
    - Tạo nút Reset để xóa dữ liệu caseOrder.php
-->
    <div class='container'>
        <div class='jumbotron'>
            <h2>A day's worth of orders</h2>
        </div>
        <!--- Tạo danh sách các đơn hàng-->
        <div class='list-group'>
            <ul class='list-item'>      
                <?php
                $fr = fopen('orders\caseOrder.txt','r');
                while (!feof($fr)){  
                    $next_line = fgets($fr);  
                    if ($next_line != "") { 
                        echo "<li class='list-group-item'>$next_line</li>";
                    };                        
                };
                fclose($fr);
                ?>              
            </ul>
        </div>
        <!--- Tạo nút Reset để xóa dữ liệu caseOrder.php-->
        <form action='resetFile.php'>
            <div class='form-group'>
                <button class='form-control btn btn-danger'>Reset</button>
            </div>
        </form>

        
    
    </div>
</body>
</html>