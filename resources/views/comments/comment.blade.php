<div class="panel panel-default" style="margin-top: 10px">
    <div class="panel-heading">
        <div class="level">
            <h4 class="flex">
            </h4>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            {{$comment->user->name}}
        </div>
        <div class="card-body">
            {{ $comment->content }}

            <a class="btn btn-link" href="/posts/{{$post['id']}}/comments/{{$comment['id']}}" role="button">
                {{$comment['is_approved']=='0'?'Одобрить':'Скрыть'}}
            </a>

            <a class="btn btn-link" href="/comments/{{$comment['id']}}" role="button">
                Удалить
            </a>

            @if (Auth::check())

                <a class="btn btn-link" data-bs-toggle="collapse" href="#commentForm{{$comment->id}}" role="button"
                   aria-expanded="false">
                    Комментировать
                </a>
                <div class="collapse" id="commentForm{{$comment->id}}">
                    @include ('comments.form', ['parentId' => $comment->id])
                </div>

            @endif

            @if (isset($threadedComments[$comment->id]))
                @include ('comments.list', ['collection' => $threadedComments[$comment->id]])
            @endif
        </div>
    </div>


</div>