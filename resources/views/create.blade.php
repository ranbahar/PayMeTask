@extends('layouts.app')

@section('content')
    <div ng-controller="myCtrl" style="padding: 10px">
        <h1>Create new Sale</h1>

        {!! Form::open(['method'=>'POST','action'=>'SaleController@store']) !!}
        {{--    <form>--}}

        {{--        First Name: <input type="text" ng-model="firstName"><br>--}}
        {{--        Last Name: <input type="text" ng-model="lastName"><br>--}}
        {{--        <br>--}}
        {{--        Full Name: @{{  firstName }}--}}

        @csrf
        <div class="form-group">

            <div style="padding: 10px">
                {!! Form::label('description','Product Name: ') !!}
                {!! Form::text('description',$request->description ?? null,['class'=>'form-control',!empty($request->payment_Link) ?'readonly' : '']) !!}
            </div>
            <div style="padding: 10px">

                {!! Form::label('amount','Price: ') !!}
                {!! Form::text('amount',$request->amount ?? null,['class'=>'form-control',!empty($request->payment_Link) ?'readonly' : '']) !!}

            </div>
            <div style="padding: 10px">
                {!! Form::select('currency', array('ILS'=>'ILS', 'USD'=>'USD','EUR'=>'EUR'), $request->currency ?? 'ILS')!!}
            </div>

            {{--    {{ \App\Http\Controllers\SaleController::getPayMeData() }}--}}
            {{--            @php($response = '')--}}

            @if(!empty($request) && !empty($request->payment_Link))
                <iframe style="width: 100%; height: 426px;" src="{{$request->payment_Link}}">Your browser isn't
                    compatible
                </iframe>
                <div class="form-group" style="padding: 10px">
                    <a href="{{ url('/sales/create')}}" class="btn btn-secondary"><i
                            class="fa fa-angle-left"></i>Back</a>
                    {!! Form::submit('Save',['class'=>'btn btn-success', 'name'=>'button']) !!}
                </div>
            @else
                <div style="padding: 10px">
                    {!! Form::submit('Insert payment details',['class'=>'btn btn-primary', 'name'=>'button']) !!}
                </div>
            @endif

        </div>
        {!! Form::close() !!}


        @if(!empty($response) && !empty($response['status_error_details']))
            <div class="alert alert-danger">Error</div>
            <ul>
                <li>
                    error details: {{$response['status_error_details'] }}
                </li>
                <li>
                    error info: {{$response['status_additional_info'] }}
                </li>
                <li>
                    error code: {{$response['status_error_code'] }}
                </li>
            </ul>
        @endif
    </div>

    <script>
        var app = angular.module('myApp', []);
        app.controller('myCtrl', function ($scope) {
            $scope.firstName = "John";
            $scope.lastName = "Doe";
        });
    </script>
@endsection

@yield('footer')
