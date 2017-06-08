@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> {{-- Petition title jumbotron --}}
                <div class="jumbotron">
                    <h2 class="text-center">{{ $petition->title }}</h2>

                    <p class="lead text-center">
                        - Creator: <a href="{{ route('profile.member', $petition->author) }}">{{ $petition->author->name }}</a>
                    </p>
                </div>
            </div> {{-- /Petition title jumbotron --}}

            <div class="col-md-9"> {{-- Main content frame --}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ $petition->description }}
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