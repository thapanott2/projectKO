<?php
mysql_connect("localhost", "root", "root");
mysql_query("CREATE DATABASE store;"); 
mysql_select_db("store");
	
$sql = "CREATE TABLE product(
			pro_id SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			pro_name VARCHAR(100) UNIQUE,
			price FLOAT,
			description TEXT,
			img MEDIUMBLOB);";

@mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE cart(
			sess_id VARCHAR(40) NOT NULL,
			pro_id SMALLINT,
			pro_name VARCHAR(100),
			price SMALLINT,
			quantity TINYINT UNSIGNED,
			add_date DATE, 
			PRIMARY KEY(sess_id, pro_id));";

@mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE customer(
			cust_id SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(100),
			address TEXT,
			phone VARCHAR(50),
			email VARCHAR(50),
			order_date DATE,
			delivery VARCHAR(3));";

@mysql_query($sql) or die(mysql_error());

$sql = "CREATE TABLE orders(
			ord_id SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			cust_id SMALLINT,
			pro_id SMALLINT,
			pro_name VARCHAR(100),
			price SMALLINT,
			quantity TINYINT UNSIGNED	);";

@mysql_query($sql) or die(mysql_error());
?>