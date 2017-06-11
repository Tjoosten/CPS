<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Account security:</div>
            </div>

            <div class="panel-body">
                <form action="{{ route('settings.security') }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }} {{-- CSRF protection --}}

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Password: <span class="text-danger">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="New password" name="password">
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3">Password confirmation: <span class="text-danger">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Password confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-10">
                            <button type="submit" class="btn btn-success">
                                <span class="fa fa-check" aria-hidden="true"></span> Update
                            </button>

                            <button type="reset" class="btn btn-danger">
                                <span class="fa fa-undo" aria-hidden="true"></span> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>