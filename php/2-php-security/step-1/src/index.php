<?php
namespace Tutorial;

//use Illuminate\Database\Capsule\Manager;
use DemoTools\Terminal;

include dirname(__DIR__) . "/vendor/autoload.php";
//include __DIR__ . "/tools.php";

//$settings = include 'settings.php';

$controller = new Controller(include 'settings.php');
$controller->init();

//connectDatabase($settings['db']);
//
//
///**
// * @param $settings
// */
//function connectDatabase($settings) {
//    printf("Setting up database connection ");
//
//    $capsule = new Manager();
//    $capsule->addConnection($settings);
//    $capsule->setAsGlobal();
//    $capsule->bootEloquent();
//
//    $connectionReady = false;
//
//    while (! $connectionReady) {
//        try {
//            if ($capsule->getDatabaseManager()->select("select 1"))
//            {
//                $connectionReady = true;
//            }
//        } catch(\Exception $e) {
//            printf('.');
//            sleep(1);
//        }
//    }
//
//    Terminal::printSuccess('done');
//}
//
///**
// * Create new user
// */
//function createNewUser()
//{
//    Terminal::printTitle("Enter user details:");
//    $user = new User();
//    $user->login = Terminal::readUserEntry(" - Login: ");
//    $user->passwd = Terminal::readUserEntry(" - Password: ");
//    $user->email = Terminal::readUserEntry(" - Email: ");
//    try {
//        $user->save();
//    } catch(\Illuminate\Database\QueryException $e) {
//        if (! $e->getCode() == 23000) {
//            throw $e;
//        }
//        // Duplicate key
//        Terminal::printFailure('User already exists');
//        return false;
//    }
//    Terminal::printSuccess();
//    return true;
//}
//
//
///**
// * List all users
// */
//function listUsersFromDb()
//{
//    Terminal::printTitle("List all users from Database:");
//    foreach(User::All() as $user) {
//        debugUser($user);
//    }
//    Terminal::printSuccess('done');
//}
//
///**
// * @param User $user
// */
//function debugUser(User $user) {
//    printf("%s\n", $user);
//}
//
///**
// * @return bool
// */
//function login()
//{
//    Terminal::printTitle('Try to login with user:');
//    $users = User::where('login', Terminal::readUserEntry(" - Login: "))
//        ->where('passwd', Terminal::readUserEntry(" - Password: "))
//        ->get();
//    if (count($users) == 0) {
//        Terminal::printFailure("Login failed");
//        return false;
//    }
//    Terminal::printSuccess('User login success:');
//    debugUser($users[0]);
//    Terminal::printSuccess('done');
//    return true;
//}


const MENU_ITEM_ADD_USER = 1;
const MENU_ITEM_LIST_USERS = 2;
const MENU_ITEM_LOGIN = 3;
const MENU_ITEM_EXIT = 9;

$menuItems = [
    MENU_ITEM_ADD_USER => "Add user",
    MENU_ITEM_LIST_USERS => "List users",
    MENU_ITEM_LOGIN => "Try login with a user",
    MENU_ITEM_EXIT => "Exit"
];

while(($selectedItem = Terminal::menu($menuItems)) != MENU_ITEM_EXIT) {
    printf("\n");
    switch($selectedItem) {
        case MENU_ITEM_ADD_USER: while(!$controller->createNewUser());
            Terminal::pause();
            break;
        case MENU_ITEM_LIST_USERS: $controller->listUsersFromDb();
            Terminal::pause();
            break;
        case MENU_ITEM_LOGIN: $controller->login();
            Terminal::pause();
            break;
    }
}
