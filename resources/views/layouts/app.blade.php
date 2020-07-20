<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Contact</title>


    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body ng-app="myApp">
<div class="container">
    @yield('content')
</div>

@yield('footer')

</body>
</html>
