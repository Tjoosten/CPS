@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create new organisation:
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('organization.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }} {{-- CSRF TOKEN --}}

                            <div class="form-group {{ $errors->has('organisation_name') ? 'has-error' : '' }}">
                                <label class="col-md-3 control-label" for="title">
                                    Naam organisatie: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <input type="text" name="organisation_name" class="form-control" placeholder="Name">

                                    @if ($errors->has('organisation_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('organisation_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="title">
                                    Avatar:
                                </label>

                                <div class="col-md-9">
                                    <input type="file" name="avatar">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('organisation_description') ? 'has-error' : '' }}">
                                <label class="col-md-3 control-label" for="description">
                                    Description: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <textarea name="organisation_description" class="form-control" rows="8" placeholder="Organization description"></textarea>

                                    @if ($errors->has('organisation_description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('organisation_description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-success"><span class="fa fa-check" aria-hidden="true"></span> Create</button>
                                    <button type="reset" class="btn btn-danger"><span class="fa fa-undo" aria-hidden="true"></span> Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection