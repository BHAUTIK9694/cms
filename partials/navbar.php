<?php
$current_page = $_SERVER['REQUEST_URI'];
$current_path = parse_url($current_page, PHP_URL_PATH);
parse_str(parse_url($current_page, PHP_URL_QUERY), $query_params);
$current_tab = isset($query_params['tab']) ? $query_params['tab'] : '';

// Define base path, so it works locally and on the server
$base_path = strpos($current_path, '/CMS/') === 0 ? '/CMS' : '';
?>
<header>
    <div id="logo">
        <a href="home.php">
            <h1><img src="public/images/logo.png" alt=""></h1>
        </a>
    </div>

    <nav id="navbar">
        <ul id="menu">
            <li>
                <a href="Dashboard.php"
                    class="<?= ($current_path == "$base_path/Dashboard.php") ? 'active_header_li' : '' ?>">Dashboard</a>
            </li>
            <li>
                <a href="Company.php"
                    class="<?= ($current_path == "$base_path/Company.php") ? 'active_header_li' : '' ?>">Companies</a>
            </li>
            <li>
                <a href="project.php"
                    class="<?= ($current_path == "$base_path/project.php") ? 'active_header_li' : '' ?>">Projects</a>
            </li>
            <li>
                <a href="Services.php?tab=Services"
                    class="<?= ($current_path == "$base_path/Services.php") ? 'active_header_li' : '' ?>">Templates</a>
            </li>
            <li>
                <a href="Clients.php"
                    class="<?= ($current_path == "$base_path/Clients.php") ? 'active_header_li' : '' ?>">Clients</a>
            </li>
            <li>
                <a href="Clients.php"
                    class="<?= ($current_path == "$base_path/Clients.php") ? 'active_header_li' : '' ?>">Admin</a>
            </li>

        </ul>
    </nav>
    <div class="profile">
        <div class="hdprofile_pic_img">
            BK
        </div>
        <div class="sub-profile">
            <div class="sub-profile-wrapper">
                <div class="hdprofile_pic_img">
                    BK
                </div>
                <div class="namecon">
                    <span class="name">Bhautik Kotadiya</span>
                </div>
            </div>
            <span><a href="./profile.php">View Profile</a></span>
            <span><a href="help.php">Help</a></span>
            <span><a href="logout.php">Logout</a></span>
        </div>
    </div>
</header>