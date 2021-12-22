
@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><i class="icon-copy fa fa-cogs" aria-hidden="true"></i> এসাইন রোল </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <ul id="error" class="text-danger">
                @if($errors->all())
                @php $fields = ['designation', 'user_id', 'role_id'] @endphp
                    @foreach ($errors->all() as $key => $error)
                    <li id="error_{{ $fields[$key] }}"><i class="icon-copy fa fa-hand-o-right" aria-hidden="true"></i> {{ $error }}</li>
                    @endforeach
                @endif
            </ul>
            <form id="role-assign-form" action="{{ route('assign_role') }}" method="post">
                @csrf
                <div class="row text-center form-inline">
                    <label for="union_id" class="form-control-label ml-3"> পৌরসভাঃ</label>
                    <select id="union_id" class="form-control ml-3 col-5" name="union_id" data-style="btn-outline-primary">
                        <option value="" >পৌরসভা সিলেক্ট করুন</option>
                        @foreach ($union_list as $item)
                            <option value="{{$item->union_code}}">{{$item->union_code}} - {{$item->bn_name}}</option>
                        @endforeach
                    </select>

                    <label for="designation" class="form-control-label ml-3">পদবী</label>
                    <select id="designation" class="form-control ml-3 col-5" name="designation" data-style="btn-outline-primary">
                        <option value="" >পদবী সিলেক্ট করুন</option>
                        <option value="1" >পৌর মেয়র </option>
                        <option value="3" >নির্বাহী কর্মকর্তা</option>
                        <option value="4" >নির্বাহী প্রকৌশলী</option>
                        <option value="5" >কাউন্সিলর</option>
{{--                        <option value="6" >গ্রামপুলিশ</option>--}}
                    </select>

                </div>
                <br>
                <div class="row text-center form-inline">
                    <label for="user_id" class="form-control-label ml-3">কর্মকর্তাঃ</label>
                    <select id="user_id" class="form-control ml-3 col-5" name="user_id" data-style="btn-outline-primary">
                        <option value="" >কর্মকর্তা সিলেক্ট করুন</option>
                        @foreach ($users as $item)
                            <option value="{{$item->id}}" data-designation="{{$item->type}}" data-union="{{$item->union_id}}"> {{$item->union_id}} - {{$item->name}} </option>
                        @endforeach
                    </select>

                    <label for="role_id" class="form-control-label ml-3">রোল</label>
                    <select id="role_id" class="form-control ml-3 col-3" name="role_id" data-style="btn-outline-primary">
                        <option value="" >রোল সিলেক্ট করুন</option>
                        @foreach($roles as $item)
                            <option value="{{ $item->id }}" data-union="{{ $item->union_id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-info ml-3">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
            <h4 class="text-center text-blue">নির্ধারিত রোল</h4>

            <button type="button" onclick="resetAllRole()" class="btn btn-danger float-right mb-2"><i class="icon-copy fa fa-refresh" aria-hidden="true"></i> Reset all</button>
            <form id="reset-all-form" action="{{ route('reset_all_role') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="userType" value="{{ auth()->user()->type }}">
            </form>

            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th class="table-plus datatable-nosort">SL No.</th>
                    <th class="">Employee Name</th>
                    <th class="">Role Name</th>
                    <th class="">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($assignedRole as $key => $item)
                <tr>
                    <td class="table-plus">{{ $key + 1 }}</td>

                    <td class="">{{ $item->username }}</td>
                    <td>{{ $item->role_name }}</td>

                    <td class="btn-list">

                    <a href="{{ route('role.show', ['id' => $item->role_id]) }}" class="btn btn-primary">Show Role</a>



                    <button class="btn btn-outline-info" onclick="resetRole($(this).val())" value="{{ $item->user_id }}"><i class="icon-copy fa fa-refresh" aria-hidden="true"></i> Reset</button>

                    <form id="reset-form_{{ $item->user_id }}" action="{{ route('reset_role') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="userType" value="{{ auth()->user()->type }}">
                            <input type="hidden" name="userId" value="{{ $item->user_id }}">
                            <input type="hidden" name="roleId" value="{{ $item->role_id }}">
                    </form>

                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        $('#union_id').change(function(){
            $('#user_id option').each(function(i,el){
                if(+($('#union_id').val()) != $(el).data('union'))
                    $(el).hide();
                else
                    $(el).show();
            });
            $('#user_id').val('');

            $('#role_id option').each(function(i,el_opt){
                if(+($('#union_id').val()) != $(el_opt).data('union'))
                    $(el_opt).hide();
                else
                    $(el_opt).show();
            });
            $('#role_id').val('');
        });


        $('#designation').change(function(){
            $('#user_id option').each(function(i,el){
                if(+($('#designation').val()) != $(el).data('designation') || +($('#union_id').val()) != $(el).data('union'))
                    $(el).hide();
                else
                    $(el).show();
            });
            $('#user_id').val('');
        });

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
