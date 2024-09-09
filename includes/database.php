<?php
$connect = mysqli_connect('mysql.db.mdbgo.com','abinash_25_cmsdb','Secret.1','abinash_25_cmsdb');
if(mysqli_connect_errno())
{
    exit('Failed to Connect:'. mysqli_connect_error());
}