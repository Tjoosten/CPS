@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> {{-- Organization description --}}
                <div class="jumbotron text-center">
                    <img src="{{ asset("avatars/organization/{$organization->avatar}") }}" style="height: 75px; width:75px;" class="center-block img-circle img-responsive img-thumbnail">
                    <h2>{{ $organization->organisation_name }}</h2>

                    <p class="lead" style="margin-top: 5px;">
                        {{ $organization->organisation_description }}
                    </p>
                </div>
            </div> {{-- /Organization description --}}

            <div class="col-sm-12"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-tabs" role="tablist"> {{-- Tab navigation --}}
                            <li role="presentation" class="active">
                                <a href="#petitions" aria-controls="petitions" role="tab" data-toggle="tab">
                                    <span class="fa fa-file-text-o" aria-hidden="true"></span> Petitions
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#members" aria-controls="members" role="tab" data-toggle="tab">
                                    <span class="fa fa-users" aria-hidden="true"></span> Members
                                </a>
                            </li>
                            <li role="presentation" class="dropdown pull-right">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-cogs" aria-hidden="true"></span> Settings <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                                            <span class="fa fa-asterisk" aria-hidden="true"></span> General
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">
                                            <span class="fa fa-envelope" aria-hidden="true"></span> Contact
                                        </a>
                                     </li>
                                </ul>
                            </li>
                        </ul> {{-- /End tab navigation --}}

                        <div class="tab-content"> {{-- tab content --}}
                            <div role="tabpanel" class="tab-pane fade in active" id="petitions"> {{-- Petition tab --}}
                                <div class="row">
                                    <div style="margin-top: 10px;" class="col-md-12">
                                        test
                                    </div>
                                </div>
                            </div> {{-- End petition tab --}}

                            <div role="tabpanel" class="tab-pane fade in" id="members"> {{-- Members tab --}}
                                <div class="row">
                                    <div style="margin-top: 10px;" class="col-md-12">
                                        @include('organizations.members')
                                    </div>
                                </div>
                            </div> {{-- /Members tab --}}

                            <div class="tabpanel" class="tab-pane fade in" id="general"> {{-- contact config tab --}}
                            </div> {{-- /contact config tab --}}

                            <div class="tabpanel" class="tab-pane fade in" id="general"> {{-- General config tab --}}
                            </div> {{-- /General config tab --}}
                        </div> {{-- /tab content --}}

                    </div>
                </div>
            </div> {{-- End content --}}
        </div>
    </div>
@endsection
