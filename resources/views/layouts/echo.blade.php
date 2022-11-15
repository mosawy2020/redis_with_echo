<script>
    window.laravel_echo_port = '{{env("LARAVEL_ECHO_PORT")}}';

</script>
<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
<script>
    window.Echo.private('user-channel')
        .listen('.NewPost', (data) => {
            if (data.user.id != "{{auth()->id()}}") window.toastr.success(data.user.name + "{{trans("website.post.added_new_post")}}");
        });
    window.Echo.channel('comments.' + {{auth()->id()}})
        .listen('.UserComment', (data) => {
            window.toastr.success(data.comment.author + "{{trans("website.post.added_new_comment")}}" + data.comment.id);
        });
    window.Echo.channel('likes.' + {{auth()->id()}})
        .listen('.UserLike', (data) => {
            window.toastr.success(data.like.author + "{{trans("website.post.added_new_like")}}" + data.like.id);
        });

    window.Echo.join('online')
        .here(users => {
            this.users = users;
            updateUsers(users);
        })
        .joining(user => {
            this.users.push(user);
            updateUsers(users);
        })
        .leaving(user => {
                this.users = this.users.filter(u => (u.id !== user.id));
                updateUsers(users);
            }
        );

    function updateUsers(users) {
        $("#online").html("");
        users =  users.filter(u => (u.id != {{auth()->id()}})) ;
        users.forEach(
            user => {
                $("#online").append('<li id = "online-"' + user.id + '>' + user.name + '</li>');
            });
    };
</script>
<script>
    $("#ring").click(function (e) {
        console.log("gbdf");
    });
</script>
