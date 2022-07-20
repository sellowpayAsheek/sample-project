@extends('layouts.default')

@section('content')
    <div class="container" style="padding: 25px; display:flex;flex-direction:row;justify-content:space-evenly;">
        <button  type="button" class="btn btn-primary" onclick="redirect(1)">Send Check Mail</button>
        <button type="button" class="btn btn-warning" onclick="redirect(2)">Send Echeck Mail</button>
        <button type="button" class="btn btn-info" onclick="redirect(3)">Webhook History</button>
    </div>

    @include('check-records.index')
    @include('check-records.statement-modal')
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
                            action = `<span onclick="voidCheck('${j.id}')" style="" title = "void"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        <span onclick="viewCheck('${j.id}')" title = "View check statements"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span onclick="printCheck('${j.id}')" title = "Print Check"><i class="fa fa-print" aria-hidden="true"></i></span>` ;
                            html += `<tr>
                                <th scope="row">${j.id}</th>
                                <td>${j.payeeName}</td>
                                <td>${j.bankAccountName}</td>
                                <td>${j.chequeAmount}</td>
                                <td>${j.chequeSerialNumber}</td>
                                <td>${j.chequeIssueDate}</td>
                                <td>${j.memo}</td>
                                <td>${j.status}</td>
                                <td>${action}</td>
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

        function voidCheck(id)
        {
            var url = "{{ route('check.void', ":id") }}";
            url = url.replace(':id', id);

            $.ajax({
                data : "" ,
                url : url ,
                type : "post" ,
                success:function(result){
                    if(result){
                        alert("success")
                        getCheckList();
                    }
                },
                error:function(){
                    alert("Something went wrong");
                }
            })
        }

        function viewCheck(id)
        {
            var url = "{{ route('check.view', ":id") }}";
            url = url.replace(':id', id);

            $.ajax({
                data : "" ,
                url : url ,
                type : "get" ,
                success:function(result){
                    if(result){
                        $('#statementModal').modal('show');
                        html = "" ;
                        data = result.data ;

                        $.each(data,function(i,j){
                            html += `<tr>
                                <td>${j.status}</td>
                                <td>${j.notes}</td>
                                <td>${j.ipAddress}</td>
                                </tr>`
                        });

                        $('#statementbody table tbody').append(html);
                    }
                },
                error:function(){
                    alert("Something went wrong");
                }
            })
        }

        function printCheck(id)
        {
            var url = "{{ route('check.print', ":id") }}";
            url = url.replace(':id', id);

            $.ajax({
                data : "" ,
                url : url ,
                type : "get" ,
                success:function(result){
                    if(result){
                       window.location = result.data ;
                    }
                },
                error:function(){
                    alert("Something went wrong");
                }
            })
        }
    </script>
@endsection
