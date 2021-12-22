@extends('layouts.app')
@section('content')
    {{--Breadcrumb Section--}}
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-9 col-sm-9">
                <div class="title">
                    <h4><i class="icon-copy fa fa-bookmark-o" aria-hidden="true"></i> এডিট নোটিশ</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 pd-20 bg-cover border-radius-4 box-shadow">
                <form action="{{ route('edit_notice') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="offset-2 col-md-8 form-group text-center">
                            <select name="type" id='type'
                                    class="form-control @error('type')is-invalid @enderror" selected="selected"
                                    required >
                                <option value='' >সিলেক্ট করুন
                                </option>
                                <option value='1' {{  ( $notice->type == 1) ? 'selected="selected"' : '' }} >
                                    সাধারণ নোটিশ
                                </option>
                                <option value='2' {{ ( $notice->type == 2) ? 'selected="selected"' : '' }} > সর্বশেষ খবর
                                </option>
                            </select>
                            @error('type')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @php $style = ($notice->type == 2) ? "display:none":""  @endphp
                    <div class="row" style="{{$style}}">
                        <div class="offset-2 col-md-8 form-group text-center @error('title') has-danger @enderror">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="নোটিশ টাইটেল দিন...." value="{{ old('title')? old('title') : $notice->title }}" autocomplete="title">
                            @error('title')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row" style="{{$style}}" >
                        <div class="col-md-8 offset-2">
                            <div class="form-group @error('document') has-danger @enderror">
                                <div class="custom-file">
                                    <input id="file" name="document" type="file" class="custom-file-input">
                                    <label for="document" id="documentLabel" class="custom-file-label" style="cursor: pointer;">ডকুমেন্ট এটাচ করুন, ফাইল অবশ্যই (jpg,jpeg,png)* অথবা (pdf)* ফরম্যাট দিতে হবে</label>
                                </div>
                                @error('document')
                                <div class="form-control-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="offset-2 col-md-8 form-group text-center">
                            <textarea id="textarea_editor" name="details" class="@error('details') is-invalid @enderror form-control border-radius-0 btn-white" placeholder="পৌরসভা নোটিশ এর বিবরণ দিন....">{{ old('details')? old('details') : $notice->details }}</textarea>

                            @error('details')
                            <div class="form-control-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <input type="hidden" value="{{ $notice->id }}" name="id">
                        <div class="col-md-3 ml-auto mr-auto text-center buttons-group">
                            <button type="submit" class="btn btn-info">আপডেট</button>
                            <a href="{{ route('all_up_notice') }}" class="btn btn-warning">বাতিল</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#file').change(function () {
            let data = $(this)[0].files[0].name;
            $('#documentLabel').text(data);
        });

        $('#textarea_editor').wysihtml5({
            "stylesheets": [""], // CSS stylesheets to load
            "color": true, // enable text color selection
            "size": 'small', // buttons size
            "html": true, // enable button to edit HTML
            "format-code" : true // enable syntax highlighting
        });



    </script>
@endsection
