<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Account Information:</div>
            </div>

            <div class="panel-body">
                <form action="" class="form-horizontal" method="POST">
                    {{ csrf_field() }} {{-- CSRF protection --}}

                    <div class="form-group">
                        <label class="control-label col-sm-2">
                            Name: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-3">
                            <input class="form-control" name="firstname" placeholder="First name">
                        </div>

                        <div class="col-md-3">
                            <input class="form-control" name="lastname" placeholder="Last name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">
                            Username: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="Your username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">
                            Email: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" placeholder="Your email address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">
                            Location: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-3">
                            <input class="form-control" name="city" placeholder="Your city">
                        </div>

                        <div class="col-md-3">
                            <select name="country_id" class="form-control">
                                <option value=""> -- Country --</option>

                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->long_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
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