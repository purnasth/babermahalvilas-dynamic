<?php
require_once("../includes/initialize.php");
$session->clear('u_id');
$session->clear('accesskey');
@$session->clear('m_dashboard');
redirect_to(BASE_URL.'apanel/login');
?>