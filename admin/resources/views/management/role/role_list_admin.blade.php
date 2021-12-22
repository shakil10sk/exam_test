@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><i class="icon-copy fa fa-cogs" aria-hidden="true"></i> রোল সেটআপ</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
            <h4 class="text-center text-blue">সকল রোল</h4>

            <a href="{{ route('create_role') }}" class="btn btn-info float-right mb-3"><i class="icon-copy fa fa-plus" aria-hidden="true"></i> Create Custom Role</a>

            <div class="row pt-2">
                <div class="col-3 form-group">
                    <label for="">জেলা</label>
                    <select class="form-control" id="district">
                        <option value="">সিলেক্ট</option>

                    </select>
                </div>
                <div class="col-3 form-group">
                    <label for="">উপজেলা</label>
                    <select class="form-control" id="upazila">
                        <option value="">সিলেক্ট</option>

                    </select>
                </div>
                <div class="col-4 form-group">
                    <label for="">পৌরসভা</label>
                    <select class="form-control" id="union">
                        <option value="">সিলেক্ট</option>

                    </select>
                </div>
                <div class="col-2 form-group mt-4 pr-2 pl-2 pt-2">
                  <button class="btn btn-primary" onclick="searchRole()">সার্চ</button>
                </div>
            </div>

            <table class="data-table stripe hover nowrap" id="role_table">
                <thead>
                <tr>
                    <th class="table-plus datatable-nosort">SL No</th>
                    <th class="">Role Name</th>
                    <th class="">Union Id</th>
                    <th class="">Action</th>
                </tr>
                </thead>
                <tbody>

                {{-- @foreach($roles as $key => $item)
                <tr>
                    <td class="table-plus">{{ $key+1 }}</td>

                    <td class="">{{$item->name }}</td>
                    <td>{{ date_format($item->created_at,"d-M-Y") }}</td>

                    <td class="btn-list">

                        <a href="{{ route('role.show', ['id' => $item->id]) }}" class="btn btn-primary">Show Role</a>

                        <a href="{{ route('role.edit', ['id' => $item->id]) }}" class="btn btn-warning">Edit Role</a>

                        @if($item->name != 'SECRETARY_'.auth()->user()->union_id)

                        <button class="btn btn-outline-danger" onclick="warning($(this).val())" value="{{ $item->id }}"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i> ডিলিট</button>

                        <form id="delete-form_{{ $item->id }}" action="{{ route('delete_role') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="roleName" value="{{ $item->name }}">
                            <input type="hidden" name="roleId" value="{{ $item->id }}">
                        </form>

                        @endif
                    </td>
                </tr>
                @endforeach --}}


                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="delelte_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">  ডিলিট করতে চান?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="delete-form" action="{{ route('delete_role') }}" method="POST" >
                @csrf
                <input type="hidden" id="roleName" name="roleName" value="">
                <input type="hidden" id="roleId" name="roleId" value="">

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-lg">হ্যাঁ</button>
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">না</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('script')

    <script>
        let url = '{{url("/")}}';
    </script>
    <script src='{{ asset('js/roles.min.js') }}'></script>

    <script>

        $('document').ready(function(){

            $.ajax({
                url: '{{route("location.district")}}',
                success: function(data){
                    let opts = '<option value="">সিলেক্ট</option>';

                    if(data.length)
                    data.forEach(el => {
                        opts += '<option value="'+el.id+'">'+el.bn_name+'</option>';
                    });
                    $('#district').html(opts);

                },
                error: function (e) {
                    console.log(e);
                }
            });

        });

        $('#district').change(function(){

            $.ajax({
                url: '{{route("location.upazila")}}/'+ $('#district :selected').val(),
                success: function(data){
                    let opts = '<option value="">সিলেক্ট</option>';

                    if(data.length)
                    data.forEach(el => {
                        opts += '<option value="'+el.id+'">'+el.bn_name+'</option>';
                    });

                    $('#upazila').html(opts);
                },
                error: function (e) {
                    console.log(e);
                }
            });
        });

        $('#upazila').change(function(){

            $.ajax({
                url: '{{route("location.union")}}/'+ $('#district :selected').val() +'/'+ $('#upazila :selected').val(),
                success: function(data){
                    let opts = '<option value="">সিলেক্ট</option>';

                    if(data.length)
                    data.forEach(el => {
                        opts += '<option value="'+el.union_code+'">'+el.bn_name+'</option>';
                    });

                    $('#union').html(opts);
                },
                error: function (e) {
                    console.log(e);
                }
            });
        });



        function searchRole() {
            $('.data-table').DataTable().ajax.reload();
        }

        $('.data-table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {

                type: "get",
                url : url + '/setting/setup/role-list-data',
                data: {
                    district_id: function(){
                        return $('#district :selected').val();
                    },
                    upazila_id: function(){
                        return $('#upazila :selected').val();
                    },
                    union_code: function(){
                        return $('#union :selected').val();
                    },
                },

            },
            columns:[
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'union_id', name: 'union_id'},
                {data: null, orderable: false, searchable: false,
                    render: function (data) {
                        let show ='<a href="{{ route("role.show") }}/'+data.id+'" class="btn btn-primary">Show Role</a> ';
                        let edit ='<a href="{{ route("role.edit") }}/'+data.id+'" class="btn btn-warning">Edit Role</a> ';
                        let delete_btn = ' <button class="btn btn-danger delete_role_btn" data-id="'+data.id+'" data-name="'+data.name+'">Delete</button>';

                        return show+edit+delete_btn;
                    }
                },

            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [[10, 15, -1], [10, 15, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
        });

        $(document).on('click', '.delete_role_btn', function () {

            $('#roleName').val($(this).data('name'));
            $('#roleId').val($(this).data('id'));
            $('#delelte_modal').modal('show');
        });

    </script>

@endsection
