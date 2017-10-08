@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i> Your Profile</div>
            @include('layouts.message-block')
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-3">
                        @if(Storage::disk('local')->has($user->name . '-' . $user->id .'.jpg'))
                            <img src="{{ route('profile.image', ['filename' => $user->name . '-' . $user->id . '.jpg' ]) }}" class="img-responsive" alt="{{ $user->name.' image' }}">
                        @endif
                    </div>
                    <div class="col-xs-9">
                        <form action="{{ route('profile.save') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image">Image (.jpg)</label>
                                <input type="file" name="image" class="form-control" id="image" required>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        </div>
    </div>
    </div>
@endsection