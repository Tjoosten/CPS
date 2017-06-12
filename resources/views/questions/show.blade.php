@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9"> {{-- Question content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">Question: {{ $question->title }}</div>
                    <div class="panel-body">{{ $question->description }}</div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-comment">
                            <ul class="comments">
                                <li class="clearfix">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar img-responsive" alt="">
                                    <div class="post-comments">
                                        <p class="meta">
                                            Dec 18, 2014 <a href="#">JohnDoe</a> says:
                                            <span class="pull-right">
                                                <a class="btn btn-xs btn-default">
                                                    <span style="color: red;" class="fa fa-heart" aria-hidden="true"></span>
                                                    <small>10</small>
                                                </a>
                                                <a class="btn btn-xs btn-danger" href="#" onclick="getDataById('{{ route('questions.json', $question) }}', 'report')">
                                                    <small>
                                                        <span class="fa fa-exclamation-triangle" aria-hidden="true"></span> Report
                                                    </small>
                                                </a>
                                            </span>
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Etiam a sapien odio, sit amet
                                        </p>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar img-responsive" alt="">
                                    <div class="post-comments">
                                        <p class="meta">{{ auth()->user()->name }}:</p>

                                        <form class="form-horizontal" method="POST" action="{{ route('comments.question') }}">
                                            {{ csrf_field() }} {{-- CSRF form protection --}}
                                            <input type="hidden" name="author_id"   value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="question_id" value="{{ $question->id }}">

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <textarea style="resize: none;" name="comment" class="form-control" rows="3" placeholder="Your reaction."></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <span class="fa fa-check" aria-hidden="true"></span> Comment
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-danger">
                                                        <span class="fa fa-undo" aria-hidden="true"></span> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div> {{-- /Question content --}}

            <div class="col-sm-3"> {{-- Question information sidebar --}}
                <div class="list-group">
                    <div class="list-group-item">
                        <strong>Questioner:</strong> <span class="pull-right">{{ $question->author->name }}</span>
                    </div>
                    <div class="list-group-item">
                        <strong>Category:</strong> <span class="pull-right">{{ $question->categories->name }}</span>
                    </div>

                    <div class="list-group-item">
                        <strong>Created at:</strong> <span class="pull-right">{{ $question->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div> {{-- Question information sidebar --}}
        </div>
    </div>

    @include('layouts.modals.report') {{-- Report Modal (comment) --}}
@endsection

@section('extra-js')
    <script src="{{ asset('js/ajax-modal.js') }}"></script>
@endsection