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

    @can('assign-role')
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
                    <h4 class="text-center text-blue">এসাইন রোল</h4>
                    <ul id="error" class="text-danger">
                        @if($errors->all())
                            @php $fields = ['designation', 'user_id', 'role_id'] @endphp
                            @foreach ($errors->all() as $key => $error)
                                <li id="error_{{ $fields[$key] }}"><i class="icon-copy fa fa-hand-o-right"
                                                                      aria-hidden="true"></i> {{ $error }}</li>
                            @endforeach
                        @endif
                    </ul>
                    <form id="role-assign-form" action="{{ route('assign_role') }}" method="post">
                        @csrf
                        <div class="row text-center form-inline">
                            <label for="designation" class="form-control-label ml-3">পদবী</label>
                            <select id="designation" class="form-control ml-3" name="designation"
                                    data-style="btn-outline-primary">
                                <option value="">পদবী সিলেক্ট করুন</option>
                                @foreach($designation_list as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                            <label for="user_id" class="form-control-label ml-3">নাম</label>
                            <select id="user_id" class="form-control ml-3" name="user_id"
                                    data-style="btn-outline-primary">
                                <option value="" id="">কর্মকর্তার নাম সিলেক্ট করুন</option>
                            </select>

                            <label for="role_id" class="form-control-label ml-3">রোল</label>
                            <select id="role_id" class="form-control ml-3" name="role_id"
                                    data-style="btn-outline-primary">
                                <option value="">রোল সিলেক্ট করুন</option>
                                @foreach($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-info ml-3">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
                <h4 class="text-center text-blue">নির্ধারিত রোল</h4>
                @can('reset-all-role')
                    <button type="button" onclick="resetAllRole()" class="btn btn-danger float-right mb-2"><i
                            class="icon-copy fa fa-refresh" aria-hidden="true"></i> Reset all
                    </button>
                    <form id="reset-all-form" action="{{ route('reset_all_role') }}" method="POST"
                          style="display: none;">
                        @csrf
                        <input type="hidden" name="userType" value="{{ auth()->user()->type }}">
                    </form>
                @endcan
                <table class="data-table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">SL No.</th>
                        <th class="">Employee Name</th>
                        <th class="">Username</th>
                        <th class="">Role Name</th>
                        <th class="">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @can('assigned-role')
                        @foreach($assignedRole as $key => $item)
                            <tr>
                                <td class="table-plus">{{ $key + 1 }}</td>

                                <td class="">{{ $item->username }}</td>
                                <td class="">{{ $item->employee_id }}</td>
                                <td>{{ $item->role_name }}</td>

                                <td class="btn-list">
                                    @can('show-role')
                                        <a href="{{ route('role.show', ['id' => $item->role_id]) }}"
                                           class="btn btn-primary">Show Role</a>
                                    @endcan

                                    @can('reset-role')
                                        <button class="btn btn-outline-info" onclick="resetRole($(this).val())"
                                                value="{{ $item->user_id }}"><i class="icon-copy fa fa-refresh"
                                                                                aria-hidden="true"></i> Reset
                                        </button>

                                        <form id="reset-form_{{ $item->user_id }}" action="{{ route('reset_role') }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="userType" value="{{ auth()->user()->type }}">
                                            <input type="hidden" name="userId" value="{{ $item->user_id }}">
                                            <input type="hidden" name="roleId" value="{{ $item->role_id }}">
                                        </form>
                                    @endcan
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
