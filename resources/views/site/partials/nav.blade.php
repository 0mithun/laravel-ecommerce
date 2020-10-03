<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">

                @foreach($categories as $cat)
                    @foreach ($cat->items as $category)
                    
                    @if ($category->items->count()>0)
                        <li class="nav-item dropdown">
                        <a href="{{ route('category.show', $category->slug) }}" class="nav-link dropdown-toggle" id="{{ $category->slug }}" data-toggle="dropdown">{{ $category->name }}</a>
                        <div class="dropdown-menu">
                            @foreach ($category->items as $item)
                                <a href="{{ route('category.show', $item->slug) }}" class="dropdown-item">{{ $item->name }}</a>
                            @endforeach
                        </div>
                        </li>
                    @else 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.show', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endif
                    
                    @endforeach
                @endforeach
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link pl-0"><strong>All Category</strong></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Fashion</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Supermarket</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Baby &amp; Toys</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Fitness Sport</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="dorpdown07" data-toggle="dropdown">More</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Foods and Drinks</a>
                        <a href="#" class="dropdown-item">Home Interior</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Category 1</a>
                        <a href="#" class="dropdown-item">Category 2</a>
                        <a href="#" class="dropdown-item">Category 3</a>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
