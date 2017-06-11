@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9"> {{-- Page content --}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status:</th>
                                        <th>Name:</th>
                                        <th colspan="2">Email:</th> {{-- Colspan=2 for functions --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>#{{ $user->id }}</td>
                                            <td>
                                                @if ($user->isOnline()) {{-- User is online --}}
                                                    <label class="label label-success">Online</label>
                                                @else {{-- The user isn't online --}}
                                                    <label class="label label-danger">Offline</label>
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="" class="label label-info">Info</a>
                                                <a href="" class="label label-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $users->render() }} {{-- pagination instance --}}
                        </div>
                    </div>
                </div>
            </div> {{-- /Page content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                @if ((int) count($users) > 14) {{-- There are more than 14 users. So show the login form. --}}
                    <div class="well well-sm"> {{-- Search form --}}
                        <form method="POST" action="">
                            <div class="input-group">
                                <input type="text" name="term" class="form-control" placeholder="Zoek bericht">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div> {{-- /Search form --}}
                @endif

                <div class="list-group"> {{-- Option menu --}}
                    <a href="" class="list-group-item">
                        All users <span class="pull-right badge">{{ $usersCount }}</span>
                    </a>
                    <a href="" class="list-group-item"> {{-- TODO: Implement count query. --}}
                        Blocked users <span class="pull-right badge">0</span>
                    </a>
                </div> {{-- /Option menu --}}
            </div> {{-- /Sidebar --}}
        </div>
    </div>
@endsection