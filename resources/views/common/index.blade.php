@extends('layouts.default')

@section('content')
@php
    $button = "" ;
    $number =0 ;
    $type = request()->get('type');

    if($type == "mail"){
        $button = "Send mail" ;
        $number = 1 ;
    }

    if($type == "email"){
        $button = "Send e-check" ;
        $number = 2 ;
    }
@endphp

    <div class="container" style="padding: 20px">
        <form id="check_form">
            <div class="form-row" style="padding-bottom: 10px;">
                <div class="form-group col-md-6">
                    <label for="inputState">Bank Account</label>
                    <select id="inputState" name="bankaccount" class="form-control">
                    <option selected>Select bank account</option>
                        @foreach ($accounts as $account)
                            <option value="{{$account['id']}}">{{$account['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="amount">amount</label>
                    <input type="Number" class="form-control" name="amount" id="amount" placeholder="Amount">
                </div>

                <div class="form-group col-md-6">
                    <label for="memo">Memo</label>
                    <textarea name="memo" id="memo"  class="form-control" placeholder="Enter Memo" cols="10" rows="3"></textarea>
                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="payee_name">Payee name</label>
                        <input type="text" name="payee_name" class="form-control" id="payee_name" placeholder="Payee name">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="address1">Address line 1</label>
                        <input type="text" name="address1" class="form-control" id="address1" placeholder="address line 1">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="address2">Address line 2</label>
                        <input type="text" name="address2" class="form-control" id="address2" placeholder="address line 2">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="city">city</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="city">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="state">state</label>
                        <input type="text" name="state" class="form-control" id="state" placeholder="state">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="zip">zip</label>
                        <input type="text" name="zip" class="form-control" id="zip" placeholder="zip">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country">country</label>
                        <input type="text" name="country" class="form-control" id="country" placeholder="country">
                    </div>
                </div>

                @if (request()->get('type') == "mail")

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="shipping">Shipping Type</label>
                            <select id="shipping" name="shipping" class="form-control">
                                <option value="1" checked>First class</option>
                                <option value="5">Express mail</option>
                            </select>
                        </div>
                    </div>

                @endif

                @if (request()->get('type') == "email")

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email address">email address</label>
                            <input type="email" name="email" class="form-control" id="email address" placeholder="email address">
                        </div>
                    </div>

                @endif

                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </form>
            <button type="button" style="float:right;" onclick="sendCheck('{{$number}}')" class="btn btn-primary">{{$button}}</button>

    </div>
@endsection


@section('page_js')
    <script>
        function sendCheck(type)
        {

            let route = "" ;

            switch(String(type)){
                case "1" : route = "{{route('mail.sent')}} "; break ;
                case "2" : route = "{{route('email.sent')}}" ; break ;
            }
            console.log(route);
            let data = $('#check_form').serialize() ;

            $.ajax({
                data : data ,
                type : "post" ,
                url  : route ,
                success : function(result){
                    if(result){
                        alert("Success");
                        setTimeout(() => {
                            window.location = "{{url('/')}}"
                        }, 1000);
                    }
                },
                error:function()
                {
                    alert("something went wrong");
                }
            })
        }
    </script>
@endsection
