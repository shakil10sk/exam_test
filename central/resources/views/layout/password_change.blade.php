<div id="password_change_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">পাসওয়ার্ড পরিবর্তন </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('password-reset') }}" method="post">
                @csrf
                <div class="modal-body pd-25">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="password">নতুন পাসওয়ার্ড</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="">
                        </div>
                        <div class="form-group col-12">
                            <label for="confirm_password">পাসওয়ার্ড আবার দিন</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="confirm_password" placeholder="">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">সেভ করুন</button>
                    <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                        data-dismiss="modal">বাতিল</button>
                </div>
            </form>

        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
