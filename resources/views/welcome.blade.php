@extends('layouts.default')

@section('asset_load')
    @include('pagination.style')
@endsection

@section('content')
    <div class="container" style="padding: 25px; display:flex;flex-direction:row;justify-content:space-evenly;">
        <button  type="button" class="btn btn-primary" onclick="redirect(1)">Send Check Mail</button>
        <button type="button" class="btn btn-warning" onclick="redirect(2)">Send Echeck Mail</button>
        <button type="button" class="btn btn-info" onclick="redirect(3)">Webhook History</button>
    </div>

    @include('check-records.search')
    @include('check-records.index')
    @include('check-records.statement-modal')

    <div id="wrapper">
        <ul id="pagination">
            {{-- li list dynamic --}}
        </ul>
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

        $(document).ready(function(){
            getCheckList();

        });

        function getCheckList(search = ""){
            $.ajax({
                url : "{{route('check.list')}}" ,
                data : search ,
                type : "get" ,
                success:function(result){
                    if(result.data){
                        refreshTable();
                        html = "" ;

                        data = result.data ;
                        $.each(data,function(i,j){
                            action = `<span onclick="voidCheck('${j.id}')" style="cursor:pointer" title = "void"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        <span onclick="viewCheck('${j.id}')" style="cursor:pointer" title = "View check statements"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span onclick="printCheck('${j.id}')" style="cursor:pointer" title = "Print Check"><i class="fa fa-print" aria-hidden="true"></i></span>` ;
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

                        setPagination(result);
                        $('#checkListTable tbody').append(html);
                    }
                },
                error:function(xhr,exception){
                    alertError(xhr);
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
                error:function(xhr,exception){
                    alertError(xhr);
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
                error:function(xhr,exception){
                    alertError(xhr);
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
                        window.open(result.data.file,'_blank')
                    }
                },
                error:function(xhr,exception){
                    alertError(xhr);
                }
            })
        }


        // search functions

        function searchCheck()
        {
            var category = $('#search-category').val()
            let term     = $('#search-term').val()
            search_term = { [category]: term};

            getCheckList(search_term);
        }

        function nextPage(page)
        {
            var search_term = {"page" : page};
            getCheckList(search_term);
        }

        function setPagination(result)
        {
            $('#wrapper #pagination').html('')
            pagination_html = "" ;

            current_page = result.current_page ;
            last_page = result.last_page ;

            for(i = 1 ; i <= last_page ; i++){

                if(i == current_page){
                    pagination_html += `<li><a class="active" onclick="nextPage('${i}')">${i}</a></li>`
                }else{
                    pagination_html += `<li><a onclick="nextPage('${i}')">${i}</a></li>`
                }
            }

            $('#wrapper #pagination').append(pagination_html);
        }

    </script>
@endsection
