@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-solid" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="d-flex align-items-center justify-content-start">
                <i class="icon ion-ios-close alert-icon tx-32"></i>
                <span><strong>Oh snap!</strong> {{ $error }}</span>
            </div><!-- d-flex -->
        </div>
    @endforeach
@endif

@isset($success)
    <div class="alert alert-success alert-solid" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="d-flex align-items-center justify-content-start">
            <i class="icon ion-ios-close alert-icon tx-32"></i>
            <span><strong>Oh Yeah!</strong> {{ $success }}</span>
        </div><!-- d-flex -->
    </div>
@endisset


