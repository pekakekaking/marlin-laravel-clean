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
                @if($comment['is_approved']==1 || Auth::user()->can('administrate'))
                {{ $comment->content }}
                @can('administrate')
                    <a class="btn btn-link" href="/posts/{{$post['id']}}/comments/{{$comment['id']}}" role="button">
                        {{$comment['is_approved']=='0'?'Одобрить':'Скрыть'}}
                    </a>

                    <a class="btn btn-link" href="/comments/{{$comment['id']}}" role="button">
                        Удалить
                    </a>
                @endcan
                @if (Auth::check())

                    <a class="btn btn-link" data-bs-toggle="collapse" href="#commentForm{{$comment->id}}" role="button"
                       aria-expanded="false">
                        Комментировать
                    </a>
                    <div class="collapse" id="commentForm{{$comment->id}}">
                        @include ('comments.form', ['parentId' => $comment->id])
                    </div>

                @endif
                @else
                    <h4>Комментарий проверяется модератором</h4>
                @endif
                @if (isset($comment['children']))
                    @include ('comments.list', ['collection' => $comment['children']->load('children')])
                @endif
            </div>
        </div>


</div>
