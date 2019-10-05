<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
            @foreach($categories as $cat)
                @foreach($cat->items as $category)
                    @if($category->items->count() > 0)
                        <li class="nav-item dropdown">
                            <a href="{{ route('category.show', $category->slug) }}" class="nav-link dropdown-toggle" id="{{ $category->slug }}" data-toggle="dropdown">{{ $category->name }}</a>
                            <div class="dropdown-menu">
                                @foreach($category->items as $item)
                                    <a href="{{ route('category.show', $category->slug) }}" class="dropdown-item">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('category.show', $category->slug) }}" class="nav-link">{{ $category->name }}</a>
                        </li>
                    @endif
                @endforeach
            @endforeach
            </ul>
        </div>
    </div>
</nav>
