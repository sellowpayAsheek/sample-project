@extends('layouts.default')

@section('content')
    <div class="container" style="padding: 25px; display:flex;flex-direction:row;justify-content:space-evenly;">
        <button  type="button" class="btn btn-primary" onclick="redirect(1)">Send Check Mail</button>
        <button type="button" class="btn btn-warning" onclick="redirect(2)">Send Echeck Mail</button>
        <button type="button" class="btn btn-info" onclick="redirect(3)">Webhook History</button>
    </div>

    @include('check-records.index');
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

        $(document).ready(function(){
            getCheckList();

        });

        function getCheckList(search = ""){
            $.ajax({
                url : "{{route('check.list')}}" ,
                data : "" ,
                type : "get" ,
                success:function(result){
                    if(result.data){
                        refreshTable();
                        html = "" ;

                        data = result.data ;
                        $.each(data,function(i,j){
                            action = "" ;
                            html += `<tr>
                                <th scope="row">${j.id}</th>
                                <td>${j.payeeName}</td>
                                <td>${j.bankAccountName}</td>
                                <td>${j.chequeAmount}</td>
                                <td>${j.chequeSerialNumber}</td>
                                <td>${j.chequeIssueDate}</td>
                                <td>${j.memo}</td>
                                <td>${j.status}</td>
                                <td>${j.payeeName}</td>
                            </tr>`;
                        });

                        $('#checkListTable tbody').append(html);
                    }
                },
                error:function(){
                    alert('Something went wrong. Cannot load check list')
                }
            });
        }

        function refreshTable()
        {
            $('#checkListTable tbody').html('');
        }
    </script>
@endsection
