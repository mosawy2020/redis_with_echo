@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        {{ $post->updated_at->toFormattedDateString() }}
        <hr/>
        <p class="lead">
            {{ $post->body }}
        </p>
        <hr/>
        <i id="like"
           @if($post->authLiked())
               class=  "fa-sharp fa-solid fa-heart"
           style="color:red;"

           @else
               class= "fa-regular fa-heart"
            @endif
        ></i>
        <span id="likes">
                                                        {{$post->likes->count()}}
                                                    </span>
        </span>
        <span><i
                class="fa-solid fa-comment"></i>{{$post->comments->count()}}</span>
        </p>


        {{--        <h3>Comments:</h3>--}}
        <div class="container bootdey ">
            <div class="col-md-12 bootstrap snippets">
                <div class="panel">
                    <h5 class="text-center mt-5">{{trans("website.post.share_your_thoughts")}}</h5>
                    <div class="panel-body">
                        <form action="{{route('comments.store')}}" method="post">
                            @csrf
                            <input type="hidden" id="post" name="post_id" value={{$post->id}}>
                            <textarea class="form-control mt-1" name="body" placeholder="leave a comment "></textarea>

                            <div class="mar-top clearfix">
                                <button class="btn btn-sm btn-primary pull-right" type="submit"> Share</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <h4 class="text-center">{{trans("website.post.comments_section")}}</h4>

                @foreach ($comments as $comment)
                    <div class="media-block">
                        <div class="media-body">
                            <div class="mar-btm">

                                <div class="container mt-6">

                                    <div class="row  d-flex justify-content-center">

                                        <div class="col-md-8">
                                            <div class="card p-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user d-flex flex-row align-items-center">
                                                            <span><small class="font-weight-bold text-primary">{{$comment->author->name}} ::</small> <small
                                                                    class="font-weight-bold">{{$comment->body}}</small></span>
                                                    </div>
                                                </div>
                                                <small><em>created on:{{$comment->created_at}}</em></small>
                                                <div
                                                    class="action d-flex justify-content-between mt-2 align-items-center">
                                                    <div class="reply px-4">


                                                    </div>
                                                    <div class="icons align-items-center">
                                                        <i class="fa fa-check-circle-o check-icon"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                @endforeach
                                {{-- @endforeach   --}}
                            </div>
                        </div>
                    </div>
            </div>
            <script>

                // Echo.private('post.' + this.post.id)
                //     .listen('NewComment', (comment) => {
                //         this.comments.unshift(comment);
                //     });

                $("#like").click(function (e) {

                    $.ajax({
                        method: "post",
                        url: "{{route('likes.store')}}",
                        data: {
                            'id': $("#post").attr("value"),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (response) {
                            if (response.status == "add") {

                                $("#like").attr("class", "fa-sharp fa-solid fa-heart");
                                $("#like").attr("style", "color:red");
                            } else {
                                $("#like").attr("class", "fa-regular fa-heart");
                                $("#like").attr("style", "");
                            }
                            $("#likes").text(response.likes_count)
                        },

                        fail: function (response) {

                        }
                    })
                })

            </script>

@endsection

@section('scripts')

@endsection
