
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
<nav class="site-nav">
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
</nav>