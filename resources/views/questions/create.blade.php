@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session()->get('class') && session()->get('message')) {{-- There is found a flash message --}}
                <div class="col-sm-12">
                    <div class="{{ session()->get('class') }}" role="alert">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="fa fa-info-circle" aria-hidden="true"></span> New question:</div>

                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="{{ route('questions.index') }}">
                                    <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/questions.svg') }}" alt="questions">
                                </a>
                            </div>
                            <div class="media-body">
                                {{-- <h4 class="media-heading">Vragen.</h4> --}}
                                <p>
                                    We are always willing to help you. Therefore, ask your question here. Many of the questions can be found in our FAQ.<br>
                                    So we recommend you to read them first. If you do not find an answer then you can ask your question here.
                                </p>

                                <p>However, there are also rules that you should keep in mind.</p>

                                <ul class="list-unstyled">
                                    <li>* The help desk is not a theme park.</li>
                                    <li>* Questions that unnecessarily reopen for 'okay' or 'thanks' and so on</li>
                                    <li>* The administrators voluntarily work on this platform. So have respect for these people.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Ask your question:</div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('questions.store') }}" method="post">
                            {{ csrf_field() }}                                                          {{-- CSRF protection field     --}}
                            <input type="hidden" name="author_id" value="{{ auth()->user()->id }}">     {{-- The authencated user id.  --}}
                            <input type="hidden" name="open" value="Y">                                 {{-- The open/closed indicator --}}

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-2">
                                    Title: <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" value="{{ old('title') }}" name="title" placeholder="Title for your question.">

                                    @if ($errors->has('title'))
                                        <small class="help-block">{{ $errors->first('title') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-2">
                                    Categorie: <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-5">
                                    <select class="form-control" name="category_id">
                                        <option value="">-- Select category: --</option>

                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('category'))
                                        <span class="help-block"><small>{{ $errors->first('category') }}</small></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-2">
                                    Question: <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-6">
                                    <textarea name="description" rows="8" class="form-control" placeholder="Your question"></textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block"><small>{{ $errors->first('description') }}</small></span>
                                    @else
                                        <span class="help-block"><small>(This field is markdown supported)</small></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-2">
                                    Publish: <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label style="margin-right: 10px;"><input type="radio" name="publish" value="Y">Yes</label>
                                        <label><input type="radio" name="publish" value="N">No</label>
                                    </div>

                                    @if ($errors->has('publish'))
                                        <span class="help-block"><small>{{ $errors->first('publish') }}</small></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-success"><span class="fa fa-plus" aria-hidden="true"></span> Create</button>
                                    <button type="reset" class="btn btn-sm btn-danger"><span class="fa fa-close" aria-hidden="true"></span> Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection