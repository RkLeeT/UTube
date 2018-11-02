


<nav id="sidebar" class="">

    <div class="sidebar-header">
        <h3>#Menu</h3>
    </div>

    <ul class="list-unstyled components" style="word-wrap: break-word;font-size: 15px">
        <li><a href="/home">Home</a></li>

        @auth
        <li><a href="/profile">Profile</a></li>
        @endauth

        <li><a href="#">About</a></li>
        
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>
</nav>