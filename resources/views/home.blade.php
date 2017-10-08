@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @include('layouts.message-block')
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <section class="new-post">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                        <header><h3 class="text-center">What do you have to say?</h3></header>
                            <form action="{{ route('post.create') }}" method="post">
                                <div class="form-group">
                                    <textarea name="body" class="form-control" rows="5" placeholder="Your Post"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Create post</button>
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </form>
                        </div>
                    </div>
                    </section>
                    <section class="posts">
                        <div class="row">
                            <div class="col-xs-12">
                                <header><h3 class="text-center">What other people say...</h3></header>
                                @foreach($posts as $post)
                                    <article class="post" data-id="{{ $post->id }}">
                                        <p class="post-body">{{ $post->body }}</p>
                                        <div class="info">
                                            Posted by {{ $post->user->name }} on {{ $post->created_at }}
                                        </div>
                                        <div class="interaction">
                                            <a href="#"><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true"></i></a>
                                            @if(Auth::user() == $post->user)
                                                <a href="#" class="editPost-Btn">Edit</a> |
                                                <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="editPost-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Post</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea name="body" id="modal-postBody" class="form-control" rows="10" placeholder="Your Post"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="editPost-saveBtn" type="button" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var token = '{{ Session::token() }}';
    var url = '{{ route('edit') }}';
</script>
@endsection
