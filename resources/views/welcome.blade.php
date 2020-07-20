<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right links">
        <a href="/sales/create"> Create new sale </a>
    </div>

    <div class="content">
        <div class="title m-b-md">
            PayMe Sales Service
        </div>

        <table style="width:100%">
            <tr>
                <th>Time</th>
                <th>Sale Number</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Payment Link</th>
            </tr>
            @foreach($sales as $sale)
                <tr>
                    <th>{{$sale->time}}</th>
                    <th>{{$sale->sale_number}}</th>
                    <th>{{$sale->description}}</th>
                    <th>{{$sale->amount}}</th>
                    <th>{{$sale->currency}}</th>
                    <th><a href={{$sale->payment_Link}}>Sale link</a></th>

                </tr>
            @endforeach
        </table>


    </div>
</div>
</body>
</html>
