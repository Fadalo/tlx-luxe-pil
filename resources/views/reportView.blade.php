<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
    <link rel="shortcut icon" href="{{ env('APP_URL') }}/favicon.png">
    <!-- Stylesheets -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">

    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            color: #333;
        }

        .col-md-3{
            width:25%;
        }
        .col-md-4{
            width:30%;
        }
        .col-md-5{
            width:41,67%;
        }
        .col-md-6{
            width:50%;
        }
        .col-md-8{
            width:66.67%;
        }
        .col-md-10{
            width:83.33%;
        }
        .col-md-12{
            width:100%;
        }
        
        .divTable {
            display: table; width: 100%; border-collapse: collapse; border: 1px solid black;
        }
        .divRow{
            display: table-row;
        }
        .divCell{
            display: table-cell; border: 1px solid black; padding: 10px;
        }
        h1, h3, h4 {
            color: #333;
        }

        .invoice-title h3 img {
            display: block;
            max-height: 50px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .no-line, .thick-line {
            border: none;
        }

        /* Print-specific styles */
        @media print {
            .d-print-none {
                display: none;
            }

            .card {
                border: none;
            }

            .table th, .table td {
                padding: 5px;
                font-size: 12px;
            }

            .float-end {
                float: none !important;
            }

            
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div class="invoice-title">
                <h4 class="float-end font-size-16"><strong>{{ $data['title'] }} </strong></h4>
                <span style="color:green;font-size:30px;font-wight:700px;position:absolute;top:60px;right:0px"></span>
                <h3>
                    <img src="assets/images/logo-sm.png" alt="LUXE PILATES">
                </h3>
            </div>
            <hr>
            {!! $data['content'] !!}
            
        </div>
    </div>
</body>
</html>
