@extends('layouts.default')

@section('content')
    <div class="container" style="padding: 25px; display:flex;flex-direction:row;justify-content:space-evenly;">
        <button  type="button" class="btn btn-primary" onclick="redirect(1)">Send Check Mail</button>
        <button type="button" class="btn btn-warning" onclick="redirect(2)">Send Echeck Mail</button>
        <button type="button" class="btn btn-info" onclick="redirect(3)">Webhook History</button>
    </div>
@endsection


@section('page_js')
    <script>
        function redirect(type)
        {
            if(type == 1){
                window.location = "{{route('check.index')}}?type=mail"
            }

            if(type == 2){
                window.location = "{{route('check.index')}}?type=email"
            }

            if(type == 3){
                window.location = "{{route('check.record')}}"
            }
        }
    </script>
@endsection
