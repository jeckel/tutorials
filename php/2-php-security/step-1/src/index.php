<?php
namespace Tutorial;
include dirname(__DIR__) . "/vendor/autoload.php";
include __DIR__ . "/tools.php";

$settings = include 'settings.php';

connectDatabase($settings['db']);


/**
 * Create new user
 */
function createNewUser()
{
    printTitle("Enter user details:");
    $user = new User();
    $user->login = readUserEntry(" - Login: ");
    $user->passwd = readUserEntry(" - Password: ");
    $user->email = readUserEntry(" - Email: ");
    try {
        $user->save();
    } catch(\Illuminate\Database\QueryException $e) {
        if (! $e->getCode() == 23000) {
            throw $e;
        }
        // Duplicate key
        printFailure('User already exists');
        return false;
    }
    printSuccess();
    return true;
}


/**
 * List all users
 */
function listUsersFromDb()
{
    printTitle("List all users from Database:");
    foreach(User::All() as $user) {
        debugUser($user);
    }
    printSuccess('done');
}

/**
 * @param User $user
 */
function debugUser(User $user) {
    printf("%s\n", $user);
}

/**
 * @return bool
 */
function login()
{
    printTitle('Try to login with user:');
    $users = User::where('login', readUserEntry(" - Login: "))
        ->where('passwd', readUserEntry(" - Password: "))
        ->get();
    if (count($users) == 0) {
        printf(COLOR_RED . "Login failed\n" . COLOR_NC);
        return false;
    }
    printSuccess('User login success:');
    debugUser($users[0]);
    printSuccess('done');
    return true;
}


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

while(($selectedItem = menu($menuItems)) != MENU_ITEM_EXIT) {
    switch($selectedItem) {
        case MENU_ITEM_ADD_USER: while(!createNewUser());
            break;
        case MENU_ITEM_LIST_USERS: listUsersFromDb();
            break;
        case MENU_ITEM_LOGIN: login();
            break;
    }
}
