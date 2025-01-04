<div class="panel panel-default" style="margin-top: 10px">
    <div class="panel-heading">
        <div class="level">
            <h4 class="flex">
</h4>
</div>
</div>
{{$comment->user->name}}
<div class="panel-body">
    {{ $comment->content }}

    @if(true)
        <a class="btn btn-link"  href="#" role="button">
            Одобрить
        </a>
        <a class="btn btn-link"  href="#" role="button">
            Скрыть
        </a>
        <a class="btn btn-link"  href="#" role="button">
            Удалить
        </a>
    @endif


    @if (Auth::check())
        <a class="btn btn-link" data-toggle="collapse" href="#commentForm{{$comment->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
            Комментировать
        </a>
        <div class="" id="commentForm{{$comment->id}}">
            @include ('comments.form', ['parentId' => $comment->id])
        </div>
    @endif

    @if (isset($threadedComments[$comment->id]))
        @include ('comments.list', ['collection' => $threadedComments[$comment->id]])
    @endif
</div>

</div>