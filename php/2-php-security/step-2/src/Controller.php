<?php
namespace Tutorial;

use DemoTools\Color;
use DemoTools\Terminal;

class Controller
{
    /**
     * Create new user
     */
    static public function createNewUser()
    {
        Terminal::printTitle("Enter user details:");
        $user = new User();
        $user->login = Terminal::readUserEntry(" - Login: ");
        $user->email = Terminal::readUserEntry(" - Email: ");
        $user->passwd = Terminal::readUserEntry(" - Password: ");
        try {
            $user->save();
        } catch(\Illuminate\Database\QueryException $e) {
            if (! $e->getCode() == 23000) {
                throw $e;
            }
            // Duplicate key
            Terminal::printFailure($e->getMessage());
            Terminal::printFailure('User already exists');
            return false;
        }
        Terminal::printSuccess();
        return true;
    }

    /**
     * List all users
     */
    static public function listUsersFromDb()
    {
        Terminal::printTitle("List all users from Database:");
        foreach(User::All() as $user) {
            static::debugUser($user);
        }
        Terminal::printSuccess('done');
    }

    /**
     * Test login a user
     * @return bool
     */
    static public function login()
    {
        Terminal::printTitle('Try to login with user:');

        try {
            $user = User::login(
                Terminal::readUserEntry(" - Login: "),
                Terminal::readUserEntry(" - Password: ")
            );
        } catch(\Exception $e) {
            Terminal::printFailure($e->getMessage());
            return false;
        }
        Terminal::printSuccess('User login success:');
        static::debugUser($user);
        Terminal::printSuccess('done');
        return true;
    }

    /**
     * @param User $user
     */
    static protected function debugUser(User $user) {
        if ($user->checkIntegrity()) {
            Terminal::printSuccess('Integrity check success');
            Terminal::printColoredLine(sprintf("%s", $user), Color::PURPLE_BOLD);
        } else {
            Terminal::printFailure('Integrity check failed');
            Terminal::printColoredLine(sprintf("%s", $user), Color::RED);
            Terminal::printFailure(sprintf(
                "Expected: %s\nReceived: %s",
                $user->generateHash(),
                $user->hash
            ));
        }
    }
}
