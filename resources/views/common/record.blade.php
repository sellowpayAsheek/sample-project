@extends('layouts.default')

@section('content')
    <div class="container" style="padding: 20px">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Data</th>
                  </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <th scope="row">{{$record->check_id}}</th>
                        <td>{{$record->type == 1 ? "Mailed" : "Emailed"}}</td>
                        <td>{{$record->status}}</td>
                        <td>{{$record->data}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
