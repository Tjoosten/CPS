@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> {{-- Petition title jumbotron --}}
                <div class="jumbotron">
                    <h2 class="text-center">
                        {{ $petition->title }}
                    </h2>

                    <p class="lead text-center">
                        - Creator: <a href="{{ route('profile.member', $petition->author) }}">{{ $petition->author->name }}</a>
                    </p>
                </div>
            </div> {{-- /Petition title jumbotron --}}

            <div class="col-md-9"> {{-- Main content frame --}}
                <div class="panel panel-default">
                    @if ($petition->author_id === auth()->user()->id) {{-- The petition author is the current logged in user. --}}
                        <div class="panel-heading clearfix">
                            <span class="pull-left">Options:</span>

                            <div class="pull-right">
                                <a href="" class="btn btn-xs btn-default"><span class="fa fa-pencil" aria-hidden="true"></span> Edit</a>
                                <a href="" class="btn btn-xs btn-default"><span class="fa fa-bars" aria-hidden="true"></span> Signatures</a>
                                <a href={{ route('petitions.delete', $petition) }}"" class="btn btn-xs btn-default">
                                    <span class="fa fa-trash" aria-hidden="true"></span> Delete
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="panel-body">
                        {{ $petition->description }}

                        <hr style="margin-top: 10px; margin-bottom: 10px;">

                        <div class="row">
                            <div class="col-md-3 clearfix">
                                <a class="btn btn-xs btn-block btn-social btn-twitter">
                                    <span class="fa fa-twitter" aria-hidden="true"></span> Share on Twitter
                                </a>
                            </div>

                            <div style="margin-left: -25px;" class="col-md-3">
                                <a class="btn btn-xs btn-block btn-social btn-facebook">
                                    <span class="fa fa-facebook" aria-hidden="true"></span> Share on Facebook
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- /Main content frame --}}

            <div class="col-md-3"> {{-- Support section --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-pencil" aria-hidden="true"></span> Sign this petition
                    </div>

                    <div class="panel-body">
                        <form action="" class="form-horizontal" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control input-sm" placeholder="First name">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control input-sm" placeholder="Last name">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control input-sm" placeholder="Email address">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control input-sm">
                                        <option value=""> -- Select your country --</option>

                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->long_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control input-sm" placeholder="Your city">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-xs">
                                        <span class="fa fa-pencil" aria-hidden="true"></span> Sign
                                    </button>

                                    <button type="reset" class="btn btn-danger btn-xs">
                                        <span class="fa fa-undo" aria-hidden="true"></span> Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <small class="text-muted">(By signing a petition an account will be created.)</small>
            </div> {{-- /Support --}}
        </div>
    </div>
@endsection