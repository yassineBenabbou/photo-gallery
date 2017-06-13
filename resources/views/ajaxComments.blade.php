      <div class="responsive-list" id="comments">
        <ul class="commentList">
        @foreach ($comments as $comment)
            <li>
                <div class="commenterImage">
                  <img src="{{ $comment->user->avatar() }}" />
                </div>
                <div class="commentText">
                    <p>{{ $comment->body }}</p> <span class="date sub-text">{{ $comment->user->name }}, {{ $comment->created_at->diffForHumans() }}</span>
                </div>
                @if (Auth::check() && Auth::user()->id == $comment->user->id)
                <div class="delete-icon" style="float:right; margin-top:-30px">
                    <a href="" class="glyphicon glyphicon-remove commentDelete" style="color:grey;opacity:0.6" data-id="{{ $comment->id }}" data-token="{{ csrf_token() }}"></a>
                </div>
                @endif
            </li>
        @endforeach
        </ul>
        </div>

