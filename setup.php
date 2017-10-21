<?php
include 'config.php';

$servername = DB_HOST;
$username   = DB_USER;
$password   = DB_PASSWORD;

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;
if ($conn->query($sql) === true) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// create users table
$sql_users = "CREATE TABLE IF NOT EXISTS Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
role_id INT(6) NOT NULL
)";

if ($conn->query($sql_users) === true) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// create roles table
$sql_roles = "CREATE TABLE IF NOT EXISTS Roles (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
description VARCHAR(30) NOT NULL
)";

if ($conn->query($sql_roles) === true) {
    echo "Table Roles created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
