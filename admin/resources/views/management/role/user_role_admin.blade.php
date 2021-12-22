

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

            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th class="table-plus datatable-nosort">SL No</th>
                    <th class="">Role Name</th>
                    <th class="">Role Created Date</th>
                    <th class="">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($roles as $key => $item)
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
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
            <h4 class="text-center text-blue">এসাইন রোল</h4>
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
                    <label for="designation" class="form-control-label ml-3">পদবী</label>
                    <select id="designation" class="form-control ml-3" name="designation" data-style="btn-outline-primary">
                        <option value="" >পদবী সিলেক্ট করুন</option>
                        <option value="1" >পৌর মেয়র </option>
                        <option value="3" >নির্বাহী কর্মকর্তা</option>
                        <option value="4" >নির্বাহী প্রকৌশলী</option>
                        <option value="5" >কাউন্সিলর</option>
{{--                        <option value="6" >গ্রামপুলিশ</option>--}}
                    </select>

                    <label for="user_id" class="form-control-label ml-3">নাম</label>
                    <select id="user_id" class="form-control ml-3" name="user_id" data-style="btn-outline-primary">
                        <option value="" id="">কর্মকর্তার নাম সিলেক্ট করুন </option>
                    </select>

                    <label for="role_id" class="form-control-label ml-3">রোল</label>
                    <select id="role_id" class="form-control ml-3" name="role_id" data-style="btn-outline-primary">
                        <option value="" >রোল সিলেক্ট করুন</option>
                        @foreach($roles as $item)
                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
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
    <script src='{{ asset('js/roles.min.js') }}'></script>
@endsection
