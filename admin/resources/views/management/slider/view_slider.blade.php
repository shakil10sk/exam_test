@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.min.css'>
    {{-- form custom style --}}
    <link rel="stylesheet" href="{{ asset('css/form_validate.min.css') }}">

@endsection
@section('content')
    {{--Breadcrumb Section--}}
    <div class="page-header">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="title">
                    <h4><i class="icon-copy fa fa-image" aria-hidden="true"></i> স্লাইডার</h4>
                </div>
            </div>
        </div>
    </div>
<div class="row mb-3">
    @can('add-slide')
        <div class="col-md-12">
            <a href="#" type="button" class="btn btn-info float-right mb-2" data-toggle="modal" data-target="#Add-slide">যোগ করুন <i class="icon-copy fa fa-plus" aria-hidden="true"></i></a>
        </div>
        @endcan
    @if(count($slides) == 0)


        <div class="col-md-12">
            <div id="defaultSlider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#defaultSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#defaultSlider" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 mCS_img_loaded" src="{{ asset('images/slider/default1.jpg') }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-blue">@if(isset(Auth::User()->relationBetweenUnion->name)){{ Auth::User()->relationBetweenUnion->name }}@else পৌরসভা @endif</h5>
                            <p class="text-blue">পৌরসভা দেশের প্রাচীনতম স্থানীয় সরকার প্রতিষ্ঠান। এটি তৃনমুল পর্যায়ে জনগণের সবচেয়ে কাছের সরকার।</p>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100 mCS_img_loaded" src="{{ asset('images/slider/default2.jpg') }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="color-white">@if(isset(Auth::User()->relationBetweenUnion->name)){{ Auth::User()->relationBetweenUnion->name }}@else পৌরসভা  @endif</h5>
                            <p>বাংলাদেশ পৌরসভা কিছু মজার তথ্যআপনি জানেন কি বাংলাদেশের মোট পৌরসভা সংখ্য ৩২৮ টি।</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#defaultSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">পূর্ববর্তী</span>
                </a>
                <a class="carousel-control-next" href="#defaultSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">পরবর্তী</span>
                </a>
            </div>
        </div>

    @else

            <div class="col-md-12">
                <div id="slider" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($slides as $key => $item)
                        <li data-target="#slider" data-slide-to="{{ $key }}" class="{{ ($key == 0)? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($slides as $key => $item)
                            <div class="carousel-item {{ ($key == 0)? 'active': '' }}">
                                <img class="d-block w-100 mCS_img_loaded" src="{{ asset('images/slider/'.$item->photo) }}" alt="slide.jpg">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="btn-group">
                                        @can('edit-slide')
                                        <a type="button" href="{{ route('change_slide_status', ['id' => $item->id]) }}" class="btn {{ ($item->status == 1)? 'btn-danger' : 'btn-success' }}"><i class="icon-copy fa {{ ($item->status == 1)? 'fa-circle' : 'fa-circle-o' }}" aria-hidden="true"></i> {{ ($item->status == 1)? 'ডিজেবল' : 'একটিভ' }}</a>
                                        <button value="{{ $item->id }}" type="button" class="btn btn-info edit" data-toggle="modal" data-target="#edit-slide">এডিট <i class="icon-copy fa fa-pencil" aria-hidden="true"></i></button>
                                        @endcan
                                        @can('delete-slide')
                                        <button value="{{ $item->id }}" type="button" onclick="warning({{ $item->id }})" class="btn btn-warning delete" data-toggle="modal" data-target="#delet-slide">ডিলিট <i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>

                                        <form id="delete-form_{{ $item->id }}" action="{{ route('delete_slide') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                        </form>
                                        @endcan
                                    </div>
                                    <h5 class="text-blue">{{ $item->title }}</h5>
                                    <p class="text-blue">{{ $item->caption }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">পূর্ববর্তী</span>
                    </a>
                    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">পরবর্তী</span>
                    </a>
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="pd-20 bg-cover border-radius-4 box-shadow drag-zone height-300-p" style="min-height: 500px;">
                    <div class="row">
                        <div class="col-md-12 bg-blue text-center border-radius-4 p-2">
                            <h4 class="text-white">স্লাইড এর অবস্থান দিতে ফটো ড্র্যাগ করুন </h4>
                        </div>
                    </div>
                    <img src="{{ asset('images/success.png') }}" id="success" style="display: none;">
                    <ul id="drag-zone row">
                        @foreach($slides as $item)
                            <li id="slide{{ $item->id }}" value="{{ $item->id }}" class="col-md-4 border-radius-4 box-shadow m-2" style="cursor: move; float: left;">
                                <div class="btn-group">
                                    @can('edit-slide')
                                    <a type="button" href="{{ route('change_slide_status', ['id' => $item->id]) }}" class="btn {{ ($item->status == 1)? 'btn-danger' : 'btn-success' }}"><i class="icon-copy fa {{ ($item->status == 1)? 'fa-circle' : 'fa-circle-o' }}" aria-hidden="true"></i> {{ ($item->status == 1)? 'ডিজেবল' : 'একটিভ' }}</a>
                                    <button value="{{ $item->id }}" type="button" class="btn btn-info edit" data-toggle="modal" data-target="#edit-slide">এডিট <i class="icon-copy fa fa-pencil" aria-hidden="true"></i></button>
                                    @endcan
                                    @can('delete-slide')
                                    <button value="{{ $item->id }}" type="button" onclick="warning({{ $item->id }})" class="btn btn-warning delete" data-toggle="modal" data-target="#delet-slide">ডিলিট <i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>

                                    <form id="delete-form_{{ $item->id }}" action="{{ route('delete_slide') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                    </form>
                                    @endcan
                                </div>
                                <img src="{{ asset('images/slider/'.$item->photo) }}" height="300" width="100%">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

    @endif
</div>
    @can('add-slide')
    <div class="modal fade" id="Add-slide" tabindex="-1" role="dialog" aria-labelledby="Add-slide" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title">স্লাইডার অ্যাড করুন</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route('add-slide') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                    @csrf
                    @if($errors->all() != null)
                        <input type="hidden" value="1" id="modal-val">
                    @endif
                <div class="modal-body">
                    <div class="form-group bt-flabels__wrapper @error('title') has-danger @enderror">
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="স্লাইডার টাইটেল দিন...." class="form-control form-control-lg @error('title') form-control-danger @enderror" autocomplete="title" autofocus data-parsley-required>

                        <span class="bt-flabels__error-desc">স্লাইডার টাইটেল দিন....</span>
                        @error('title')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group bt-flabels__wrapper @error('photo') has-danger @enderror">
                        <div class="custom-file">
                            <input id="slide" accept="image/*" name="photo" type="file" class="custom-file-input @error('photo') form-control-danger @enderror" data-parsley-required>
                            <label for="slide" id="slideLabel" class="custom-file-label" style="cursor: pointer;">স্লাইডার ফটো দিন...</label>

                            <span class="bt-flabels__error-desc">স্লাইডার ফটো দিন....</span>
                            @error('photo')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group bt-flabels__wrapper @error('caption') has-danger @enderror">
                        <textarea name="caption" placeholder="স্লাইডার ক্যাপশন দিন...." class="form-control @error('caption') form-control-danger @enderror" autocomplete="caption" autofocus data-parsley-maxlength="255" data-parsley-trigger="keyup">{{ old('caption') }}</textarea>

                        <span class="bt-flabels__error-desc">স্লাইডার ক্যাপশন ২৫৫ অক্ষরের মধ্যে দিন....</span>
                        @error('caption')
                        <div class="form-control-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary">অ্যাড স্লাইড</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endcan

    @can('edit-slide')
    <div class="modal fade" id="edit-slide" tabindex="-1" role="dialog" aria-labelledby="Add-slide" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">স্লাইডার আপডেট করুন</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route('update-slide') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="" name="id" id="slide-id">
                    <div class="modal-body">
                        <div class="form-group bt-flabels__wrapper @error('title') has-danger @enderror">
                            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="স্লাইডার টাইটেল দিন...." class="form-control form-control-lg @error('title') form-control-danger @enderror" autocomplete="title" autofocus>

                            @error('title')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group bt-flabels__wrapper @error('photo') has-danger @enderror">
                            <label for="slide2"><img src="" id="photo" alt="slider-image.jpg" width="100%" style="cursor: pointer;">
                            <div class="custom-file">
                                <input id="slide2" accept="image/*" name="photo" type="file" class="custom-file-input @error('photo') form-control-danger @enderror" style="cursor: pointer;">
                                <label for="slide2" id="slideLabel2" class="custom-file-label" style="cursor: pointer;">স্লাইডার ফটো দিন...</label>

                                @error('photo')
                                <div class="form-control-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            </label>
                        </div>

                        <div class="form-group bt-flabels__wrapper @error('caption') has-danger @enderror">
                            <textarea id="caption" name="caption" placeholder="স্লাইডার ক্যাপশন দিন...." class="form-control @error('caption') form-control-danger @enderror" autocomplete="caption" autofocus data-parsley-maxlength="255" data-parsley-trigger="keyup">{{ old('caption') }}</textarea>

                            <span class="bt-flabels__error-desc">স্লাইডার ক্যাপশন ২৫৫ অক্ষরের মধ্যে দিন....</span>
                            @error('caption')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-primary">আপডেট স্লাইড</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
@endsection

@section('script')
    <script src="{{ asset('js/form_valid.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/parsley_validate.min.js') }}"></script>

    <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

    <script>
        let loc = $('meta[name=path]').attr("content");

        $('#slide').change(function () {
            let data = $(this)[0].files[0].name;
            $('#slideLabel').text(data);
        });

        $('#slide2').change(function () {
            let data = $(this)[0].files[0].name;
            $('#slideLabel2').text(data);
        });

        let m = $('#modal-val').val();
        if(m == 1){
            $("#Add-slide").modal();
        }

        //This is for drag & drop
        $( ".drag-zone ul" ).sortable(
            {
                stop: function( event, ul ) {
                    let idList = [];
                    $(".drag-zone ul").children("li").each(function(){
                        idList.push($(this).val());
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:'POST',
                        url:loc+'/management/slider/sequence',
                        data: {'seq': idList},
                        success: function (data) {
                            if(data.success){
                                setTimeout(function(){ $('#success').css('display', 'block'); }, 1000);
                                $('#success').delay(2000).slideUp(300);
                            }else{
                                alert('দুঃখিত! পেজ এক্সপায়ার হয়েছে, অনুগ্রহ করে পেজটি রিলোড দিন।');
                            }
                        }
                    });
                }
            }
        );
        $( ".drag-zone ul" ).disableSelection();

        //This is for SweetAlert
        function warning(id) {
                swal({
                    title: 'ডিলিট!',
                    text: "আপনি কি ডিলিট করতে চান?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'হ্যাঁ, ডিলিট!',
                    cancelButtonText: 'বাতিল'
                }).then(function (result) {
                    if (result.value){
                        swal(
                            'মোছা হয়েছে!',
                            'আপনার ফাইলটি মুছে ফেলা হয়েছে।',
                            'success'
                        ).then(function () {
                            $('#delete-form_'+id).submit();
                        });
                    }
                })
        }
    </script>
@endsection
