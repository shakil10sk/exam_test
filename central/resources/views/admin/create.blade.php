@extends('layout.main',['title'=> 'Add User'])

@push('style')
    <style>
        .dropzone {
            width: 160px;
            height: 150px;
            border: 1px dashed #999;
            border-radius: 3px;
            text-align: center;
        }

        .upload-icon {
            width: 160px;
            height: 150px;
        }

        .upload-input {
            position: relative;
            top: -148px;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
        }

    </style>
@endpush

@section('content')

    {{-- <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Admin</a>
            <span class="breadcrumb-item active">----</span>
        </nav>
    </div> --}}


    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h2 class="tx-gray-800 mg-b-10">নতুন ইউজার</h2>
        <p class="mg-b-0">ইউজার যোগ </p>
    </div>

    <div class="br-pagebody text-dark">
        <div class="br-section-wrapper">

            <form id="user_add_form" action="{{ route('admin.create.post') }}" method="POST" data-parsley-validate
                enctype="multipart/form-data">
                @csrf
                <div class="form-layout form-layout-1">
                    <div class="row mg-b-25">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">নামঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label">ইমেইল অ্যাড্রেসঃ </label>
                                <input class="form-control" type="email" name="email" placeholder="">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">মোবাইলঃ </label>
                                <input class="form-control" type="text" name="mobile" placeholder=""
                                    minlength="11" maxlength="11">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">প্রোফাইল ছবিঃ </label>
                                <div class="dropzone">
                                    <img id="profile_pic" src="{{asset('images/upload.svg')}}"
                                        class="upload-icon" />
                                    <input id="imgInp" type="file" class="upload-input" name="photo" />
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">জেলাঃ <span class="tx-danger">*</span></label>
                                <select id="district_select" class="form-control select2" name="district" required>
                                    <option value="">জেলা সিলেক্ট করুনঃ </option>
                                    @foreach ($district as $item)
                                        <option value="{{ $item->id }}" {{($item->id == auth()->user()->district)? "selected":""}} >{{ $item->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">উপজেলাঃ </label>
                                <select id="upazila_select" class="form-control select2" name="upazila" >
                                    <option value="">উপজেলা সিলেক্ট করুনঃ</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">ইউজার নামঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="username" placeholder=""
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">পাসওয়ার্ডঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" type="password" name="password" placeholder=""
                                    required minlength="8">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">বিচিএস ব্যাচঃ </label>
                                <input class="form-control" type="text" name="bcs_batch" placeholder="">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">রোলঃ <span class="tx-danger">*</span></label>
                                <select id="role_select" class="form-control select2" name="type" required>
                                    <option value="">Choose Role</option>

                                    @if (auth()->user()->type == 1)
                                    <option value="1">ADMIN</option>
                                    @endif
                                    <option value="2">DC</option>
                                    <option value="3">DDLG</option>
                                    <option value="4">UNO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info">সাবমিট</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <input type="hidden" id="upazila" value="{{ $upazila }}">

@endsection

@push('script')
    <script src="{{ asset('js/parsley.min.js') }}"></script>

    <script>
        function changeImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profile_pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function() {
            changeImage(this);
        });

        // district select
        $('#district_select').change(() => {

            let upazila = `<option value="">উপজেলা নাম</option>`;
            JSON.parse($('#upazila').val()).forEach(el => {
                // console.log(el);
                if (el.parent_id == $('#district_select').val()) {
                    upazila += `<option value="` + el.id + `">` + el.bn_name + `</option>`;
                }

            });

            $('#upazila_select').html(upazila);

        });

        $("document").ready(function(){
            if($('#district_select').val())
                $('#district_select').trigger("change");
        });

        /* if role uno than upazila must selected */
        $("#user_add_form").submit(function(e){

            if($("#role_select").val()==4)
            {
                if(!$('#upazila_select').val())
                {
                    e.preventDefault();
                    alert("Please Select Upazila");
                }
            }

        });

    </script>

@endpush
