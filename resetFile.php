<!DOCTYPE html>
<html>
<head>
    <title>Reset File</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        // Xóa dữ liệu caseOrder bằng cách xóa file cũ, tạo file caseOrder mới
        $fo = fopen('orders\caseOrder.txt','w');
        fclose($fo);
    ?>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='alert alert-success'>Case Oder file is reseted.</div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 text-left'>
                <form action='view.php'>
                    <input type='submit' class='btn btn-secondary' value='Back to View page'>
                </form>
            </div>
            <div class='col-md-6 text-right'>
                <form action='index.php'>
                    <input type='submit' class='btn btn-secondary' value='Go to Order Form page'>
                </form>
            </div>
        </div>
    </div>
<body>
</html>