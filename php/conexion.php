<?php
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
set_time_limit(0);
mysql_connect("localhost", "root", "") or die("no se ha podido connectar...");
mysql_select_db("avisos");
mysql_query("SET NAMES 'utf8'");
