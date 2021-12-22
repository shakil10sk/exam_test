@extends('layout.main',['title'=> 'Edit Profile'])

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
        <h2 class="tx-gray-800 mg-b-5">প্রোফাইল এডিট</h2>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form action="{{ route('post.profile.edit',$user->id) }}" method="POST" data-parsley-validate enctype="multipart/form-data">
                @csrf
                <div class="form-layout form-layout-1">
                    <div class="row mg-b-25">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">নামঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" placeholder="Enter firstname"
                                    value="{{ $user->profile->name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label">ইমেইল অ্যাড্রেসঃ<span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ $user->profile->email }}" placeholder="Enter email address">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">মোবাইলঃ </label>
                                <input class="form-control" type="text" name="mobile"
                                    value="{{ $user->profile->mobile }}" placeholder="Enter firstname"
                                    minlength="11" maxlength="11">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">প্রোফাইল ফটোঃ</label>
                                <div class="dropzone">
                                    <img id="profile_pic"
                                        src="{{ ($user->profile->photo) ? (env('STORAGE_URL') . '/images/profile/' . $user->profile->photo) : (asset('images/upload.svg')) }}"
                                        class="upload-icon" />
                                    <input id="imgInp" type="file" class="upload-input" name="photo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label id="name" class="form-control-label">বিসিএস ব্যাচঃ</label>
                                <input class="form-control" type="text" name="bcs_batch" value="{{$user->profile->bcs_batch}}" placeholder="Enter firstname">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">রোলঃ<span class="tx-danger">*</span></label>
                                <select name="type" class="form-control select2" required>
                                    <option {{ $user->type == 1 ? 'selected' : '' }} value="1">ADMIN</option>
                                    <option {{ $user->type == 3 ? 'selected' : '' }} value="2">DC</option>
                                    <option {{ $user->type == 2 ? 'selected' : '' }} value="3">DDLG</option>
                                    <option {{ $user->type == 4 ? 'selected' : '' }} value="4">UNO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">জেলাঃ <span class="tx-danger">*</span></label>
                                <select id="district_select" name="district" class="form-control select2" aria-readonly="" required>
                                    
                                    @foreach (\App\Models\BdLocation::where('type', 2)->get() as $item)
                                        <option value="{{ $item->id }}" {{($item->id == $user->district) ? 'selected' : ''}} >{{ $item->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">উপজেলাঃ <span class="tx-danger">*</span></label>
                                <select id="upazila_select" name="upazila" class="form-control select2" >
                                    <option value="">উপজেলা সিলেক্ট করুনঃ</option>
                                    @foreach (\App\Models\BdLocation::where('parent_id', $user->district)->get() as $item)
                                        <option value="{{ $item->id }}" {{($item->id == $user->upazila) ? 'selected' : ''}} >{{ $item->bn_name }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">ইউজার নামঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" name="username" type="text" value="{{ $user->username }}"
                                    placeholder="Enter address" required>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">পাসওয়ার্ডঃ <span class="tx-danger">*</span></label>
                                <input class="form-control" name="password" type="text" 
                                    placeholder="Enter address">
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

        // district select
        $('#district_select').change(() => {
            // console.log(JSON.parse($('#upazila').val()));
            // return;

            let upazila = `<option value="">উপজেলা নাম</option>`;
            JSON.parse($('#upazila').val()).forEach(el => {
                // console.log(el);
                if (el.parent_id == $('#district_select').val()) {
                    
                    if("{{$user->upazila}}" == el.id)
                    {
                        upazila += `<option value="` + el.id + `" selected>` + el.bn_name + `</option>`;
                    }
                    else
                    {
                        upazila += `<option value="` + el.id + `">` + el.bn_name + `</option>`;
                    }
                }


            });

            $('#upazila_select').html(upazila);

        });

    </script>

@endpush

