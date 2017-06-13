@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9"> {{-- Main content --}}
                <div class="panel panel-default">
                    <div class="panel-body"> {{-- Tab navigation --}}
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#featured" aria-controls="home" role="tab" data-toggle="tab">Featured</a></li>
                            <li role="presentation"><a href="#popular" aria-controls="profile" role="tab" data-toggle="tab">Popular</a></li>
                            <li role="presentation"><a href="#recent" aria-controls="messages" role="tab" data-toggle="tab">Recent</a></li>
                        </ul> {{-- /tab navigation --}}

                        <div class="tab-content"> {{-- Tab content --}}
                            <div role="tabpanel" class="tab-pane active" id="featured">

                            </div>
                            <div role="tabpanel" class="tab-pane" id="popular">

                            </div>
                            <div role="tabpanel" class="tab-pane" id="recent">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ((int) count($recent) > 0)
                                            @foreach ($recent as $item3)
                                                <div style="margin-left: -15px;" class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <h4><strong><a href="#">{{ $item3->title }}</a></strong></h4>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <a href="#" class="thumbnail">
                                                                <img src="http://placehold.it/260x180" alt="">
                                                            </a>
                                                        </div>

                                                        <div class="col-md-9">
                                                            <p>{{ $item3->description }}</p>
                                                            <p>
                                                                <a class="btn btn-sm btn-info" href="{{ route('petitions.show', $item3) }}">
                                                                    Lees meer...
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-top: -15px;">
                                                            <p>
                                                                <i class="fa fa-user" aria-hidden="true"></i> Creator: <a href="#">{{ $item3->author->name }}</a>
                                                                | <i class="fa fa-calendar" aria-hidden="true"></i> {{ $item3->created_at->format('d-m-Y') }}
                                                                | <i class="fa fa-tags" aria-hidden="true"></i> Tags:

                                                                @if ((int) count($item3->categories()) > 0)
                                                                    @foreach($item3->categories as $category3)
                                                                        <a href="#" class="label label-danger">{{ $category3->name }}</a>
                                                                    @endforeach
                                                                @else
                                                                    {{-- TODO: Bug in the categories count. --}}
                                                                    <span class="label label-primary">Geen</span>
                                                                @endif

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div style="margin-top: 10px;" class="alert alert-success" role="alert">
                                                <strong><span class="fa fa-info-circle" aria-hidden="true"></span> Info:</strong>
                                                Er zijn geen petities recent gestart.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> {{-- /tab content --}}
                    </div>
                </div>
            </div> {{-- /End main content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                @if ((int) count($petitions) > 0) {{-- There are petitions found so display the categories and search box --}}
                    <div class="well well-sm"> {{-- Search-box --}}
                        <form method="POST" action="">
                            <div class="input-group">
                                <input type="text" name="term" class="form-control" placeholder="Zoek bericht">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div> {{-- /Search-box --}}

                    <div class="panel panel-default"> {{-- Categories --}}
                        <div class="panel-heading"><span class="fa fa-tags" aria-hidden="true"></span> Categories:</div>
                        <div class="panel-body"> {{-- Categories panel body--}}
                            @if ((int) count($categories) > 0) {{-- There are categories found.  --}}

                                @foreach ($categories as $category) {{-- Loop through categories --}}
                                    <a href="" class="label label-success">{{ $category->name}}</a>
                                @endforeach {{-- /End loop --}}
                            
                            @else {{-- No categories found. --}}
                                <small>
                                    <i>(There are no categories found.)</i>
                                </small>
                            @endif 
                        </div {{-- Categories panel body --}}
                    </div> {{-- /Categories --}}
                @else
                    <a href="{{ route('petitions.create') }}" class="btn btn-success btn-lg btn-block">
                        <span class="fa fa-plus" aria-hidden="true"></span> Create petition
                    </a>
                @endif
            </div> {{-- /Sidebar --}}
        </div>
    </div>
@endsection