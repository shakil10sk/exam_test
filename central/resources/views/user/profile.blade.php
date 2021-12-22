@extends('layout.main',['title'=> 'Profile'])

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
        <h2 class="tx-gray-800 mg-b-5">প্রোফাইল</h2>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form action="{{ route('profile.edit') }}" method="POST" data-parsley-validate enctype="multipart/form-data">
                @csrf
                <div class="form-layout form-layout-1">
                    <div class="row mg-b-25">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">নামঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" placeholder="Enter firstname"
                                    value="{{ auth()->user()->profile->name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label">ইমেইল অ্যাড্রেসঃ<span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ auth()->user()->profile->email }}" placeholder="Enter email address">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">মোবাইলঃ </label>
                                <input class="form-control" type="text" name="mobile"
                                    value="{{ auth()->user()->profile->mobile }}" placeholder="Enter firstname"
                                    minlength="11" maxlength="11">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">প্রোফাইল ফটোঃ</label>
                                <div class="dropzone">
                                    <img id="profile_pic"
                                        src="{{ (auth()->user()->profile->photo) ? (env('STORAGE_URL') . '/images/profile/' . auth()->user()->profile->photo) : (asset('images/upload.svg')) }}"
                                        class="upload-icon" />
                                    <input id="imgInp" type="file" class="upload-input" name="photo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">বিসিএস ব্যাচঃ</label>
                                <input class="form-control" type="text" name="bcs_batch" value="{{auth()->user()->profile->bcs_batch}}" placeholder="Enter firstname">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">রোলঃ<span class="tx-danger">*</span></label>
                                <select class="form-control select2" disabled>
                                    <option {{ auth()->user()->type == 1 ? 'selected' : '' }} value="1">ADMIN</option>
                                    <option {{ auth()->user()->type == 3 ? 'selected' : '' }} value="2">DC</option>
                                    <option {{ auth()->user()->type == 2 ? 'selected' : '' }} value="3">DDLG</option>
                                    <option {{ auth()->user()->type == 4 ? 'selected' : '' }} value="4">UNO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">জেলাঃ <span class="tx-danger">*</span></label>
                                <select class="form-control select2" aria-readonly="" disabled>
                                    
                                    <option value="">{{ auth()->user()->district_->bn_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">উপজেলাঃ <span class="tx-danger">*</span></label>
                                <select class="form-control select2" disabled>
                                    <option value="">{{ auth()->user()->upazila_->bn_name??'' }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">ইউজার নামঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" value="{{ auth()->user()->username }}"
                                    placeholder="Enter address" readonly>
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
@endsection

@push('script')
    <script src="{{ asset('js/parsley.js') }}"></script>

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

    </script>
@endpush
