<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>This is a sample PDF generated using Dompdf in Laravel.</p>
    <?php
        use App\Models\User;

        $a = User::All();
        print_r($a);
    ?>

</body>
</html>
