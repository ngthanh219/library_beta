<strong class="title">Author</strong>
<ul class="side-list">
    @foreach ($authors as $author)
        <li><a>{{ $author->name }}</a></li>
    @endforeach
</ul>
