{{-- <nav class="site-nav">
    <ul class="menu">
        <li><a href="#">Gadgets & Electronics
                <i class="fa-solid fa-angle-down cat_down"></i>
            </a>

            <ul class="sub-menu">
                <li><a href="#">Level One</a></li>
                <li>
                    <a href="#">Level One</a>

                    <ul class="sub-menu">
                        <li><a href="#">Level two</a></li>
                        <li>
                            <a href="#">Level two</a>

                            <ul class="sub-menu">
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                            </ul>

                        </li>
                        <li><a href="#">Level two</a></li>
                        <li><a href="#">Level two</a></li>
                    </ul>

                </li>
                <li><a href="#">Level One</a></li>
                <li><a href="#">Level One</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Watch
                <i class="fa-solid fa-angle-down cat_down"></i>

            </a>
            <ul class="sub-menu">
                <li><a href="#">Level One</a></li>
                <li>
                    <a href="#">Level One</a>

                    <ul class="sub-menu">
                        <li><a href="#">Level two</a></li>
                        <li>
                            <a href="#">Level two</a>

                            <ul class="sub-menu">
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                            </ul>

                        </li>
                        <li><a href="#">Level two</a></li>
                        <li><a href="#">Level two</a></li>
                    </ul>

                </li>
                <li><a href="#">Level One</a></li>
                <li><a href="#">Level One</a></li>
            </ul>
        </li>
        <li><a href="#">Mobile Phone
                <i class="fa-solid fa-angle-down cat_down"></i>

            </a>
            <ul class="sub-menu">
                <li><a href="#">Level One</a></li>
                <li>
                    <a href="#">Level One</a>

                    <ul class="sub-menu">
                        <li><a href="#">Level two</a></li>
                        <li>
                            <a href="#">Level two</a>

                            <ul class="sub-menu">
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                            </ul>

                        </li>
                        <li><a href="#">Level two</a></li>
                        <li><a href="#">Level two</a></li>
                    </ul>

                </li>
                <li><a href="#">Level One</a></li>
                <li><a href="#">Level One</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Winder Collection
                <i class="fa-solid fa-angle-down cat_down"></i>

            </a>
            <ul class="sub-menu">
                <li><a href="#">Level One</a></li>
                <li>
                    <a href="#">Level One</a>

                    <ul class="sub-menu">
                        <li><a href="#">Level two</a></li>
                        <li>
                            <a href="#">Level two</a>

                            <ul class="sub-menu">
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                                <li><a href="#">Level three</a></li>
                            </ul>

                        </li>
                        <li><a href="#">Level two</a></li>
                        <li><a href="#">Level two</a></li>
                    </ul>

                </li>
                <li><a href="#">Level One</a></li>
                <li><a href="#">Level One</a></li>
            </ul>
        </li>
        </li>
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
</nav>
