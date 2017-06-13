@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session()->get('class') && session()->get('message'))
                <div class="col-md-offset-2 col-md-8">
                    <div class="{{ session()->get('class') }}" role="alert">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif

            <div class="col-md-offset-2 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Create new petition:</div>
                    <div class="panel-body">
                        <form action="{{ route('petitions.store') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="author_id" value="{{ auth()->user()->id }}">

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Title: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <input type="text" name="title" placeholder="Petition title" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Categories:
                                </label>

                                <div class="col-md-9">
                                    <input type="text" name="categories" class="form-control" placeholder="Petition categories">
                                    <small class="help-block">Split categories with an comma. Example: cat1, cat2</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Petition text: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <textarea name="description" class="form-control" rows="7" placeholder="Describe the problem case."></textarea>
                                    <small class="help-block">This field support markdown.</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success">
                                        <span class="fa fa-plus" aria-hidden="true"></span> Create
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
    </div>
@endsection
