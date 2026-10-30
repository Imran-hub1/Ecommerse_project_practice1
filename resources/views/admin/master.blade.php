<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap Header Design</title>


    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        nav ul li {
            float: left;
            list-style: none;
        }

        nav ul li a {
            text-decoration: none;
            padding: 10px;

        }

        .header {
            ul li a {
                text-decoration: none;
            }
        }

        .header ul li {
            list-style: none;
            float: left;
            padding: 10px;
        }

        .header .logo {
            margin-top: 10px;
            text-align: center;

        }

        .header .cart {
            margin-top: 10px;
            text-align: center;


        }

        .bannar {
            height: 80vh;
            width: 100%;
            background-color: aqua;
        }

        .form {
            margin-top: 50px;
            margin-left: 300px;
        }

        section {
            margin: 0;
            padding: 0;
        }

        .hr {
            border: 10px;
        }
    </style>
</head>

<body>
    @include('admin.include.header')
    @yield('content')
    @include('admin.include.footer')

    <!-- Bootstrap 5 JS Bundle with Popper (Important for Dropdown & Toggler) -->
    <!-- Bootstrap JS (যদি থাকে) -->


    <!-- ১. সবার আগে jQuery CDN লিঙ্ক দিতে হবে -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>