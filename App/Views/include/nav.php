<?php
    $session_factory = new \Aura\Session\SessionFactory;
    $session = $session_factory->newInstance($_COOKIE);

    $segment = $session->getSegment("userData");
?>


<style>


</style>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" onclick="redirect('timetable')">TVShowsTimetable</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="#" onclick="redirect('timetable')">Timeline</a></li>
                <li><a href="#" onclick="redirect('timetable', 'about')">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($segment->get('user_id') == false) { ?>
                    <li><a href="#" onclick="redirect('user', 'login')"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php } else { ?>
                    <li><a href="#" onclick="redirect('user', 'logout')"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>