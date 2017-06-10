<div class="row">
    @if ($user->organizations->count() > 0) {{-- The user has organizations --}}
        <div class="col-md-12"> {{-- Organization setting Content --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Organizations: <a href="" class="pull-right btn btn-xs btn-default">New organization</a></div>
                </div>

                <div class="panel-body">
                    <div class="list-group">

                        @foreach ($user->organizations as $organization)
                            <div class="list-group">
                                <div class="list-group-item clearfix" href="{{ route('organization.create') }}">
                                    <img src="{{ asset('avatars/organization/'. $organization->avatar) }}" style="height:20px; width:20px; margin-right: 10px;">
                                    <strong style="vertical-align: middle;">
                                        <a href="">{{ $organization->organisation_name }}</a>
                                    </strong>

                                    <a href="" class="pull-right btn btn-xs btn-danger">
                                        <span class="fa fa-close" aria-hidden="true"></span> Leave
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div> {{-- /Organization setting Content --}}
    @else
        <div class="col-md-12">
            <div class="blankslate">
                <span class="mega-octicon octicon-organization blankslate-icon"></span>

                <h3>Organizations</h3>
                <p>There are no organizations found. Where you are part of.</p>
            </div>
        </div>
    @endif
</div>