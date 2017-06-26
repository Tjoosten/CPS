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

                        @if ($user->organizations->count() > 0)
                            @foreach ($user->organizations as $organization)
                                <a href="{{ route('profile.organization', $organization) }}" title="{{ $organization->organisation_name }}">
                                    <img src="{{ asset('avatars/organization/'. $organization->avatar) }}" class="img-rounded" style="height: 50px; width: 50px;">
                                </a>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <strong>Info:</strong> This user isn't part of an organization.
                            </div>
                        @endif

                        <h3 style="margin-bottom: -10px;">Started petitions</h3>
                        <hr>

                        @if ($userPetitions->count() > 0) {{-- The user has petitions.  --}}
                            {{-- // --}}
                        @else {{-- The user doesn't have any petitions --}}
                            <div class="alert alert-info" role="alert">
                                <strong>Info:</strong> This user haven't started any petitions.
                            </div>
                        @endif
                    </div>
                </div>
            </div> {{-- /Main content frame --}}
        </div>
    </div>
@endsection
