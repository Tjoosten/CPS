@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Helpdesk:</div>

                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/help.svg') }}" alt="FAQ">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">FAQ</h4>
                                    Frequently Asked Question. Are the questions that we get a lot through our support system. Maybe
                                    You find your answer here.
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="media">
                                <div class="media-left">
                                    <a href="{{ route('questions.index') }}">
                                        <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/questions.svg') }}" alt="Questions">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Questions.</h4>
                                    You can ask support directly to the admins and developers. If you need support.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection