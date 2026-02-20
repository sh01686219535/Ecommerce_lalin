<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Basabari – Find Your Dream Home</title>
    <!-- Toastr CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    {{-- slider --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('frontendAsset/custom.css') }}">
    <link rel="stylesheet" href="style.css">
    {!! ToastMagic::styles() !!}
    <!-- Custom Script -->
    <script defer src="script.js"></script>
    @stack('css')
</head>

<body>
