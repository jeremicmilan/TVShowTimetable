<?php
    $session_factory = new \Aura\Session\SessionFactory;
    $session = $session_factory->newInstance($_COOKIE);

    $segment = $session->getSegment("userData");
?>

<div>
    <button onclick="redirect('timetable')">Timetable</button>

    <?php if ($segment->get('user_id') == false) { ?>
        <button onclick="redirect('user', 'login')">Login</button>
    <?php } else { ?>
        <button onclick="redirect('user', 'logout')">Logout</button>
    <?php } ?>
    <button onclick="redirect('timetable', 'about')">About</button>
</div>