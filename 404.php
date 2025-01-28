<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="error-page">
        <h1>404</h1>
        <p>Oops! The page you’re looking for doesn’t exist.</p>
        <a href="index.html" class="btn">Go Back to Home</a>
    </div>

    <style>
        .error-page {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .error-page h1 {
            font-size: 8rem;
            color: #ff6b6b;
        }
        .error-page p {
            font-size: 1.5rem;
            color: #555;
            margin: 1rem 0;
        }
        .error-page .btn {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .error-page .btn:hover {
            background-color: #0056b3;
        }
    </style>
</body>
</html>
