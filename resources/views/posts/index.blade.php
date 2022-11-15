@extends('layouts.app')

@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i>Ok</h5>
                {{session('success')}}
            </div>
        @endif

        <h1>{{trans("website.post.your_posts")}}</h1>
        <hr>
        <a class="btn btn-info" href="{{route('posts.create')}}" style="margin-left:10px;"><i class="fa fa-edit"></i>
            {{trans("website.post.new_post")}}</a>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td style="vertical-align: middle;">{{$post->id}}</td>
                            <td style="vertical-align: middle;">{{$post->title}}</td>
                            <td style="vertical-align: middle;">
                                <div class="row">
                                    <a class="btn btn-success" href="{{route('posts.show', $post->id)}}"><i
                                            class="fa fa-eye"></i> {{trans("website.post.see")}}</a>
                                    <a class="btn btn-info" href="{{route('posts.edit', $post->id)}}"
                                    ><i class="fa fa-edit"></i> {{trans("website.post.edit")}}</a>
                                    {{--                                    <a class="btn btn-info" onclick="delete_post({{$post->id}})"--}}
                                    {{--                                    ><i class="fa fa-edit"></i> Edit</a>--}}
                                    {{--                                    todo abetter way with jquery--}}
                                    <form class="btn btn-danger" method="POST"
                                          action="{{route('posts.destroy', $post)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"
                                                onclick="return confirm('{{trans("are u sure to delete")}}  {{$post->title}} ?')"
                                        ><i class="fa fa-user-times"></i> {{trans("website.post.delete")}}
                                        </button>
                                        {{--                                                                        </form>--}}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
                {{$posts->links()}}
            </div>
        </div>
    </div>
    <script>
        function delete_post(id) {
            alert("jkhk");
            $.ajax({
                url: '{{route("posts.destroy",9)}}/',
                data: {id: id},
                processData: true,
                type: "delete",
                async: true,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
                .done(function (data) {
                    //    alert("fd");
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    // alert('No response from server');
                });
        }

    </script>
@endsection
