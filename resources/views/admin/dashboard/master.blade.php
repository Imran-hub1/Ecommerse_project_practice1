<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        section {
            text-shadow: 20px;

        }

        ul li {
            list-style: none;
            float: left;
            padding: 5px;
        }

        .button {
            text-align: end;
        }

        .row .col-md-12 .header {
            height: 50vh;
            width: 100%;
            background-color: greenyellow;
        }
    </style>
</head>

<body>


    @include('admin.dashboard.include.header')
    @yield('content')
    @include('admin.dashboard.include.footer')
    <!-- Bootstrap 5 JS Bundle with Popper (Important for Dropdown & Toggler) -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('customjs')
</body>

</html>