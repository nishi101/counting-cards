<?php
include "curl.php";
$t = json_encode( array_merge( $_POST, $_GET, $_REQUEST ) );
$cc = new cURL(); 
$h = $cc->get("https://sso.csumb.edu/cas/serviceValidate?service=https%3A%2F%2Fcounting-cards-firestar1.c9users.io%2Fuu.php&format=JSON&ticket=".$_GET['ticket']);
$p = new xml2Array();
$data = $p->parse($h);
if(isset($data[0]['children'][0]['attrs']['CODE'])){
    echo "Error: ".$data[0]['children'][0]['attrs']['CODE'];
    header("Location: https://sso.csumb.edu/cas/login?service=https%3A%2F%2Fcounting-cards-firestar1.c9users.io%2Fuu.php");
}else{
    
    echo "Welcome back ".$data[0]['children'][0]['children'][0]['tagData']."! <a href='https://sso.csumb.edu/cas/logout?service=https%3A%2F%2Fcounting-cards-firestar1.c9users.io%2Fuu.php'>Logout</a>";
}