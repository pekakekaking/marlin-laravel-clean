<form method="POST" action="/posts/{{ $post['id'] }}/comments" style="margin: 10px 0 10px 0">
    @csrf

    @if (isset($parentId))
        <input name="parent_id" type="hidden" value="{{ $parentId }}">
    @endif
    <input name="post_id" type="hidden" value="{{$post['id']}}">
    <div class="form-group">
        <label for="commentBody">Текст комментария</label>
        <textarea class="form-control" id="commentBody" name="content" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Отправить</button>
</form>