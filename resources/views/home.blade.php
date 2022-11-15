@extends('layouts.app')
{{--@extends('layouts.site')--}}

@section('content')

    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <div id="colorlib-main">
        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <!--MAIN ROW-->
                <div class="row d-flex">

                    <!--POSTS COL-->
                    <div class="col-xl-8 py-5 px-md-5">

                        @if (isset($posts))

                            @foreach ($posts as $post)
                                <div class="col-md-12">
                                    <div class="blog-entry-2 ftco-animate" style="margin-bottom: 10px;">
                                        <div class="text">
                                            <h3 class="mb-2"><a href="#">{{$post->title}}</a></h3>
                                            <p class="mb-4">{{$post->description}}</p>
                                            <div class="author mb-4 d-flex align-items-center">
                                                <a href="#" class="img"
                                                   style="background-image: url('{{ ($post->author->photo) ? $post->author->photo->getUrl('thumb') : asset('/images/default.png') }}');"></a>
                                                <div class="ml-3 info">
                                                    <span>{{trans("Written by")}}</span>
                                                    <h3><a href="#">{{$post->author->name}}</a>,
                                                        <span>{{$post->created_at->format('F j, Y')}}</span></h3>
                                                </div>
                                            </div>
                                            <div class="meta-wrap d-md-flex align-items-center">
                                                <div class="half order-md-last text-md-right" id="post"
                                                     postid={{$post->id}}>
                                                    <p class="meta">
                                                        <i id="like_{{$post->id}}"  postid= "{{$post->id}}"
                                                           onclick="window.id='{{$post->id}}';"
                                                           @if($post->authLiked())
                                                               class=  "like fa-sharp fa-solid fa-heart"
                                                           style="color:red;"

                                                           @else
                                                               class= "like fa-regular fa-heart"
                                                            @endif
                                                        ></i>
                                                        <span id="likes_{{$post->id}}">
                                                        {{$post->likes->count()}}
                                                    </span>
                                                        </span>
                                                        <span><i
                                                                class="fa-solid fa-comment"></i>{{$post->comments->count()}}</span>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p><a href="{{route('posts.show', $post->id)}}"
                                                          class="btn btn-primary p-3 px-xl-4 py-xl-3 w-100">
                                                            {{trans("Continue Reading")}}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach

                            <!--PAGINATION LINKS-->
                            {{$posts->links()}}
                        @else
                            <h1>No posts availiable</h1>
                        @endif

                    </div><!--END POSTS COL-->

                </div><!--END MAIN ROW-->
            </div>


        </section>
    </div><!-- END COLORLIB-MAIN -->

    <div id="app">

    </div>
    <script>

        $( document ).ready(function (){
            $(".like").click(function (e) {
                //console.log($(this)) ; alert(id) ;
                $.ajax({

                    method: "post",
                    url: "{{route('likes.store')}}",
                    data: {
                        'id': id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (response) {
                        if (response.status == "add") {

                            $("#like_"+id).attr("class", "fa-sharp fa-solid fa-heart");
                            $("#like_"+id).attr("style", "color:red");
                        } else {
                            $("#like_"+id).attr("class", "fa-regular fa-heart");
                            $("#like_"+id).attr("style", "");
                        }
                        $("#likes_"+id).text(response.likes_count)
                    },

                    fail: function (response) {

                    }
                })
            })});


    </script>
@endsection


