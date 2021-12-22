

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
            @can('create-role')
        <a href="{{ route('create_role') }}" class="btn btn-info float-right mb-3"><i class="icon-copy fa fa-plus" aria-hidden="true"></i> Create Custom Role</a>
            @endcan
            <table class="data-table stripe hover nowrap" id="role_table">
                <thead>
                <tr>
                    <th class="table-plus datatable-nosort">SL No</th>
                    <th class="">Role Name</th>
                    <th class="">Role Created Date</th>
                    <th class="">Action</th>
                </tr>
                </thead>
                <tbody>
                @can('role-list')
                @foreach($roles as $key => $item)
                <tr>
                    <td class="table-plus">{{ $key+1 }}</td>
                    
                    <td class="">{{$item->name }}</td>
                    <td>{{ date_format($item->created_at,"d-M-Y") }}</td>

                    <td class="btn-list">
                        
                        @can('show-role')
                        <a href="{{ route('role.show', ['id' => $item->id]) }}" class="btn btn-primary">Show Role</a>
                        @endcan
                        
                        @can('role-edit')
                        <a href="{{ route('role.edit', ['id' => $item->id]) }}" class="btn btn-warning">Edit Role</a>
                        @endcan
                            
                        @if($item->name != 'SECRETARY_'.auth()->user()->union_id)
                        @can('delete-role')
                        <button class="btn btn-outline-danger" onclick="warning($(this).val())" value="{{ $item->id }}"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i> ডিলিট</button>

                        <form id="delete-form_{{ $item->id }}" action="{{ route('delete_role') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="roleName" value="{{ $item->name }}">
                            <input type="hidden" name="roleId" value="{{ $item->id }}">
                        </form>
                        @endcan
                        @endif
                    </td>
                </tr>
                @endforeach
                @endcan
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src='{{ asset('js/roles.min.js') }}'></script>  
    <script>
        //This is for datatable
        $('.data-table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
        });
    </script>
@endsection