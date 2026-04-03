
{{-- <nav class="site-nav">
    <ul class="menu">
        @foreach($categories as $category)
            <li>
                <a href="#">{{ $category->category }} 
                    <i class="fa-solid fa-angle-down cat_down"></i>
                </a>
                @if($category->subCategories->count())
                    <ul class="sub-menu">
                        @foreach($category->subCategories as $sub)
                            <li>
                                <a href="#">{{ $sub->sub_category }}</a>
                                @if($sub->childCategories->count())
                                    <ul class="sub-menu">
                                        @foreach($sub->childCategories as $child)
                                            <li><a href="#">{{ $child->child_category }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav> --}}
{{-- <nav class="site-nav">
    <ul class="menu">
        @foreach($categories as $category)
            <li>
                <a href="#">{{ $category->category }}
                    <i class="fa-solid fa-angle-down cat_down"></i>
                </a>

                @if($category->subCategories->count())
                    <ul class="sub-menu">
                        @foreach($category->subCategories as $sub)
                            <li>
                                <a href="#">{{ $sub->sub_category }}</a>

                                @if($sub->childCategories->count())
                                    <ul class="sub-menu">
                                        @foreach($sub->childCategories as $child)
                                            <li>
                                                <a href="#">{{ $child->child_category }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach
                    </ul>
                @endif

            </li>
        @endforeach
    </ul>
</nav> --}}
<nav class="site-nav">
    <ul class="menu">
        @foreach($categories as $category)
            <li>
                <a href="{{ route('product.category', ['type' => 'category', 'id' => $category->id]) }}">
                    {{ $category->category }}
                    <i class="fa-solid fa-angle-down cat_down"></i>
                </a>

                @if($category->subCategories->count())
                    <ul class="sub-menu">
                        @foreach($category->subCategories as $sub)
                            <li>
                                <a href="{{ route('product.category', ['type' => 'sub_category', 'id' => $sub->id]) }}">
                                    {{ $sub->sub_category }}
                                </a>

                                @if($sub->childCategories->count())
                                    <ul class="sub-menu">
                                        @foreach($sub->childCategories as $child)
                                            <li>
                                                <a href="{{ route('product.category', ['type' => 'child_category', 'id' => $child->id]) }}">
                                                    {{ $child->child_category }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach
                    </ul>
                @endif

            </li>
        @endforeach
    </ul>
</nav>