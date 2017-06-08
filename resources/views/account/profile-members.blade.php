@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> {{-- Profile information --}}
                <div class="jumbotron">
                    <img src="{{ asset('img/default.png') }}" style="height: 75px; width:75px;" class="center-block img-circle img-responsive img-thumbnail">
                    <p style="margin-top:5px;" class="lead text-center">{{ $user->name }}
                </div>
            </div> {{-- /Profile information --}}

            <div class="col-md-12"> {{-- Main content frame --}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 style="margin-bottom: -10px;">Organizations</h3>
                        <hr>

                        <img src="{{ asset('img/default.png') }}" class="img-rounded" style="height: 50px; width: 50px;">
                        <img src="{{ asset('img/default.png') }}" class="img-rounded" style="height: 50px; width: 50px;">
                        <img src="{{ asset('img/default.png') }}" class="img-rounded" style="height: 50px; width: 50px;">

                        <h3 style="margin-bottom: -10px;">Started petitions</h3>
                        <hr>
                    </div>
                </div>
            </div> {{-- /Main content frame --}}
        </div>
    </div>
@endsection