<?php

error_reporting(-1);
ini_set("display_errors", 1);

require_once "vendor/autoload.php";

use Kirill\Edu\db\Db1;
use Kirill\Edu\db\User;
use Kirill\Edu\some\Red;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env.local');
$dotenv->load();

Db1::getInstance();

// Db1::insert("users", "login, email, password", "'555', '555', '555'");
// Db1::delete("users", "login = '555'");

$user = new User();

$red = new Red();

$user->get("id = 1");
\Kirill\Edu\debug\Debug::dd($user);
// echo "<br>";
// echo $user->id . " " . $user->login . " " . $user->email . " " . $user->password;
// echo "<br>";

// $user->login = "niiiiiiiiiiiiiiice";
// $user->edit();

$user->get("id = 4");
echo "<br>";
echo $user->id . " " . $user->login . " " . $user->email . " " . $user->password;
echo "<br>";

echo "<br><br><br>";


$result = Db1::read("user");
// print_r($result);
foreach ($result as $row) {
    print $row['id'] . " -- " . $row['login'] . " -- " . $row['email'] . " -- " . $row['password'] . "<br>";
}

?>