<?php
session_start();
$_SESSION['status'] = 'pending';
$_SESSION['error'] = ['value' => '❌Payment Failed','timestamp'=>time()];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: rgb(25, 25, 25);
        }

        .message-box {
            width: 350px;
            margin: 0 auto;
            color: aliceblue;
            background-color: #363636;
        }

        ._failed {
            border-bottom: solid 4px red !important;
        }

        ._failed i {
            color: red !important;
        }

        ._success {
            box-shadow: 0 15px 25px #00000019;
            padding: 45px;
            /* width: 100%; */
            text-align: center;
            margin: 40px auto;
            border-bottom: solid 4px #28a745;
        }

        ._success i {
            font-size: 55px;
            color: #28a745;
        }

        ._success h2 {
            margin-bottom: 12px;
            font-size: 40px;
            font-weight: 500;
            line-height: 1.2;
            margin-top: 10px;
        }

        ._success p {
            margin-bottom: 0px;
            font-size: 18px;
            color: #808080;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- <div class="message-box _success">
            <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
            <h2> Your payment was successful </h2>
            <p> Thank you for your payment. <br> Redirecting to the homepage.</p>
        </div> -->

        <div class="message-box _success _failed">
            <i class="fa fa-times-circle" aria-hidden="true"></i>
            <h2> Your payment failed </h2>
            <p>Your Payment Couldn't be Completed.<br> Please try again later.</p>

        </div>

    </div>
    <script>
        setTimeout(()=>{
            window.location.href = "customer_index.php";
        },5000);
    </script>
</body>

</html>