
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        final-admin
    </title>
    <!-- Favicon -->
    <link href="{{asset('admin/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto+Slab:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Or Nucleo Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@nucleoicons/css/nucleo.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{asset('admin/assets/css/argon-dashboard.css?v=1.1.2')}}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body {
        font-family: "Roboto Slab", serif !important;
    }
    .navbar-search-dark .input-group {
    border-color: white;
}

    .quantity-container {
        display: flex;
        align-items: center;
    }

    .quantity-container button {
        width: 30px;
    }

    .quantity-container input {
        width: 60px;
        text-align: center;
        color: black;

    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: transparent;
        border: none;
    }

    .log {
        /* margin: 0 auto; */
        text-align: center;
        font-size: 14.4px;
        padding: 8px 30px;
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .mini-nav {
        margin-left: 50px;
    }

    .card-margin {
        margin-left: 230px;
    }

    .form-container {
        width: 500px;
        border: 2px solid #e0e0e0;
        /* Light gray border */
        background-color: #f8f9fa;
        /* Light background */
    }

    .form-container:hover {
        border-color: #007bff;
        /* Blue border on hover */
    }

    .shadow-lg {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        /* Adds shadow for a lifted effect */
    }

    .rounded {
        border-radius: 8px;
        /* Rounded corners */
    }

    .p-4 {
        padding: 1.5rem;
        /* Padding inside the form */
    }

    .table .thead-dark th {
        background-color: #1c345d;
        color: white;
    }
</style>

<body class="">
    @include('layouts.sidebar')
    <div class="main-content">
        <!-- Navbar -->
    @include('layouts/navbar')

    @yield('content')

      @include('layouts.footer')