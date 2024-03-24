<header class="site-header">
    <h1 class="logo">{{$settings['title']}}</h1>
        <nav class="main-nav">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/pictures">Gallery</a></li>
                <li><a href="/contact">Contact</a></li>
                @if($settings['is_authorized'])
                <li><a style="color:orange;" href="/admin/settingsPanel">Settings</a></li>
                <li><a style="color:orange;" href="/admin/imagesPanel">Manage images</a></li>
                <li><a style="color:orange;" href="/admin/messages">Messages
                @if($settings['unreadCount'])
                ({{$settings['unreadCount']}})
                @endif
                </a></li>
                <li><a style="color:orange;" href="/admin/logout">Logout</a></li>
                @endif
            </ul>
    </nav>
</header>