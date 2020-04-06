<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \Str::limit($post->title, 50) }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        blockquote {
            background: #f9f9f9;
            border-left: 10px solid #ccc;
            margin: 1.5em 10px;
            padding: 0.5em 10px;
            quotes: "\201C""\201D""\2018""\2019";
        }
        blockquote:before {
            color: #ccc;
            content: open-quote;
            font-size: 4em;
            line-height: 0.1em;
            margin-right: 0.25em;
            vertical-align: -0.4em;
        }
        blockquote p {
            display: inline;
            font-style: italic;
        }
        blockquote h6 {
            font-weight: 700;
            padding: 0;
            margin: 0 0 .25rem;
        }
        .child-comment {
            padding-left: 50px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                        <hr>
                        <h5>Komentar</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ url('/comment') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $post->id }}" class="form-control">
                                    <input type="hidden" name="parent_id" id="parent_id" class="form-control">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username">
                                        <p class="text-danger">{{ $errors->first('username') }}</p>
                                    </div>
                                    <div class="form-group" style="display: none" id="formReplyComment">
                                        <label for="">Balas Komentar</label>
                                        <input type="text" id="replyComment" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Komentar</label>
                                        <textarea name="comment" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <button class="btn btn-primary btn-sm">Kirim</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                @foreach ($post->comments as $row)
                                    <blockquote>
                                        <h6>{{ $row->username }}</h6>
                                        <hr>
                                        <p>{{ $row->comment }}</p><br>
                                        <a href="javascript:void(0)" onclick="balasKomentar({{ $row->id }}, '{{ $row->comment }}')">Balas</a>
                                    </blockquote>
                                    @foreach ($row->child as $val) 
                                        <div class="child-comment">
                                            <blockquote>
                                                <h6>{{ $val->username }}</h6>
                                                <hr>
                                                <p>{{ $val->comment }}</p><br>
                                            </blockquote>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        function balasKomentar(id, title) {
            $('#formReplyComment').show();
            $('#parent_id').val(id)
            $('#replyComment').val(title)
        }
    </script>
</body>
</html>