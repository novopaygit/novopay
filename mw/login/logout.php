<?php
require '../init.php';
Auth::execLogout();
redirect($LINK_BASE);
?>