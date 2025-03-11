<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 50px;
        }
        p {
            font-size: 20px;
        }
        a {
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <p>Oops! The page you're looking for cannot be found.</p>
    <a href="{{ url('/') }}">Go back to the homepage</a>
</body>
</html>