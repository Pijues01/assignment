<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- <link href='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js' rel='stylesheet'> --}}

    <!-- My CSS -->
    <link rel="stylesheet" href="asset/style.css">
    @stack('title')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .displaycontent {
            display: block !important;
        }

        .hidecontent {
            display: none !important;
        }

        .card.shadow-lg.p-4 {
            width: 40rem;
            display: table;
            margin: auto;
            margin-top: 20px;
        }

        .hide-item {
            opacity: 0;
            visibility: hidden;
        }

        .error-message {
            color: red;
            font-size: 12px;
            display: none;
        }
    </style>
</head>

<body>
