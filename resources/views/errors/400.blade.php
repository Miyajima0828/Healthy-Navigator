<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>400 - Bad Request</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #333;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 30px 50px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 4em;
            margin-bottom: 0.5em;
            color: #e3342f;
        }
        p {
            font-size: 1.25em;
            margin-bottom: 1em;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #2779bd;
        }
        footer {
            margin-top: 2em;
            font-size: 0.875em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>400</h1>
        <p>Bad Request</p>
        <p>{{$message}}</p>
        <a href="{{route('home')}}">ホームに戻る</a>
    </div>
</body>
</html>
