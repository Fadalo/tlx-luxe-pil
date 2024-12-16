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
                <h4 class="float-end font-size-16"><strong>Order {{$data['order_id']}} </strong></h4>
                <span style="color:green;font-size:30px;font-wight:700px;position:absolute;top:60px;right:0px">[PAID]</span>
                <h3>
                    <img src="assets/images/logo-sm.png" alt="LUXE PILATES">
                </h3>
            </div>
            <hr>

            <div class="row">
                <div class="col-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        {{$data['member_name']}}<br>
                        {{$data['member_phone_no']}}<br>
                    </address>
                </div>
                
            </div>

            <div class="row">
                <div class="col-6 mt-4">
                This invoice confirms the payment for Luxe Pilates – {{$data['batch_name']}}, issued on {{$data['order_date']}}. 
                </div>
                <div class="col-6 mt-4 text-end">
                    <address>
                        <strong>Order Date:</strong><br>
                        {{$data['order_date']}}<br>
                    </address>
                </div>
            </div>

            <div class="p-2">
                <h3 class="font-size-16"><strong>Order Summary</strong></h3>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$data['item_package']}}</td>
                            <td class="text-center">{{$data['item_package_pay_amount']}}</td>
                            <td class="text-center">{{$data['item_package_pay_qty']}}</td>
                            <td class="text-end">{{$data['item_package_pay_subtotal']}}</td>
                        </tr>
                      
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center"><strong>Subtotal</strong></td>
                            <td class="text-end">{{$data['item_package_pay_subtotal']}}</td>
                        </tr>
                      
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center"><strong>Total</strong></td>
                            <td class="text-end"><h4>{{$data['item_package_pay_total']}}</h4></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="p-2">
               <!-- <h3 class="font-size-16"><strong>Np. Pembayaran dapat dilakukan di bank bca 9291921921</strong></h3> -->
            </div>
           
        </div>
    </div>
</body>
</html>
