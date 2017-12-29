<?php
namespace Tutorial;
include dirname(__DIR__) . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager;

// Setting up Eloquent database connection

printf("Setting up database connection: ");

$settings = include 'settings.php';
$capsule = new Manager();
$capsule->addConnection($settings['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

printf("Done\n");

printf("Running demo script\n");

printf("Step 1: Create a new user: ");
$user = new User();
$user->login = "bob";
$user->passwd = "morane";
$user->email = "bob.morane@test.fr";
$user->save();
printf("Done\n");

printf("List users: \n");

foreach(User::All() as $user) {
    printf("%s\n", $user);
}
