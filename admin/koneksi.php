<?php 
//koneksi database
$koneksi = new mysqli("sql300.epizy.com","epiz_30975912","JsQuPMODmLU6Db","epiz_30975912_tjaa_db");

if (!$koneksi) {
    die("<script>alert('Connection Failed.')</script>");
}
 ?>