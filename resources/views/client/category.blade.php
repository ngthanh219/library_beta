<strong class="title">Category</strong>
<ul class="side-list">
    @foreach ($categories as $category)
        <li class="hover-wapper">
            <a href="{{ route('category-book', $category->id) }}">{{ $category->name }}</a>
            <div class="box-wapper">
                @foreach ($category->children as $child)
                    <div class="item-wapper">
                        <a href="{{ route('category-book', $child->id) }}" class="child">{{ $child->name }}</a>
                    </div>
                @endforeach
            </div>
        </li>
    @endforeach
</ul>
