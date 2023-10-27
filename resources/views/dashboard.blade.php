<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add custom CSS styles here */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-align: left;
            text-decoration: none;
            color: white;
            display: block;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="/user/index" class="sidebar-item" data-target="user-table">User</a>
        <a href="/comment/index" class="sidebar-item" data-target="comment-table">Comment</a>
        <a href="/feedback/index" class="sidebar-item" data-target="feedback-table">Feedback</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background: transparent;color:white;">Logout</button>
        </form>
    </div>
    <div class="main-content">
        @yield('content')
    </div>

 
</body>
</html>