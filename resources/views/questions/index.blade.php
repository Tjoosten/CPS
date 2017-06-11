@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-question-circle" aria-hidden="true"></span> Questions:
                        <a href="{{ route('helpdesk.index') }}" class="pull-right label label-primary">Go back to the helpdesk</a>
                    </div>

                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/questions.svg') }}" alt="Questions">
                            </div>
                            <div class="media-body">
                                <p>
                                    The questions helpdesk is the place where you can ask all your questions to our admins and developers. <br>
                                    Also if you find a bug you can report it here. Our admins and developers will be answering your questions ASAP.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class="fa fa-bar-chart" aria-hidden="true"></span> Statistics:</div>

                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <span class="fa fa-asterisk fa-btn" aria-hidden="true"></span> Closed questions:
                            <span class="label label-danger pull-right">{{ $closed }}</span>
                        </a>

                        <a href="#" class="list-group-item">
                            <span class="fa fa-asterisk fa-btn" aria-hidden="true"></span> Open questions:
                            <span class="label label-success pull-right">{{ $open }}</span>
                        </a>

                        <a href="#" class="list-group-item">
                            <span class="fa fa-asterisk fa-btn" aria-hidden="true"></span> Total questions:
                            <span class="label label-info pull-right">{{ $all }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class="fa fa-asterisk" aria-hidden="true"></span> Options:</div>

                    <div class="list-group">
                        <a href="{{ route('questions.create') }}" class="list-group-item"><span class="fa fa-btn fa-plus" aria-hidden="true"></span> Ask a new question.</a>
                        <a href="{{ route('questions.user') }}" class="list-group-item"><span class="fa fa-btn fa-user" aria-hidden="true"></span> View your questions.</a>
                        <a href="" class="list-group-item"><span class="fa fa-btn fa-globe" aria-hidden="true"></span> View the public questions.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection