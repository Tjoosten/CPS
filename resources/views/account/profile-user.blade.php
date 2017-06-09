@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session()->get('class') && session()->get('message')) {{-- There is a flash session set.  --}}
                <div class="col-md-12">
                    <div class="{{ session()->get('class') }}" role="alert">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif

            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="panel panel-default">
                    <div class="list-group">
                        <a href="#information" aria-controls="information" data-toggle="tab" class="list-group-item">
                            <span class="fa fa-list" aria-hidden="true"></span> Account information
                        </a>
                        <a href="#security" aria-controls="security" role="tab" data-toggle="tab" class="list-group-item">
                            <span class="fa fa-key" aria-hidden="true"></span> Account security
                        </a>
                        <a href="#organizations" aria-controls="organizations" role="tab" data-toggle="tab" class="list-group-item">
                            <span class="fa fa-users" aria-hidden="true"></span> Organizations
                        </a>
                    </div>
                </div>
            </div> {{-- /Sidebar --}}

            <div class="col-md-9"> {{-- Page content --}}
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="information">Info</div>
                    <div role="tabpanel" class="tab-pane fade" id="security">
                        @include('settings.security')
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="organizations">
                        @include('settings.organizations')
                    </div>
                </div>
            </div> {{-- Page content --}}
        </div>
    </div>
@endsection