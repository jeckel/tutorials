<?php
/**
 * Created by PhpStorm.
 * User: jmercier
 * Date: 02/01/2018
 * Time: 17:15
 */

namespace Tutorial;

use Illuminate\Database\Capsule\Manager;
use DemoTools\Terminal;

class Controller
{
    /**
     * @var array
     */
    protected $settings;

    /**
     * Controller constructor.
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Initialize
     */
    public function init()
    {
        $this->connectDatabase($this->settings['db']);
    }

    /**
     * @param $settings
     */
    protected function connectDatabase($settings) {
        printf("Setting up database connection ");

        $capsule = new Manager();
        $capsule->addConnection($settings);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $connectionReady = false;

        while (! $connectionReady) {
            try {
                if ($capsule->getDatabaseManager()->select("select 1"))
                {
                    $connectionReady = true;
                }
            } catch(\Exception $e) {
                printf('.');
                sleep(1);
            }
        }

        Terminal::printSuccess('done');
    }

    /**
     * Create new user
     */
    public function createNewUser()
    {
        Terminal::printTitle("Enter user details:");
        $user = new User();
        $user->login = Terminal::readUserEntry(" - Login: ");
        $user->passwd = Terminal::readUserEntry(" - Password: ");
        $user->email = Terminal::readUserEntry(" - Email: ");
        try {
            $user->save();
        } catch(\Illuminate\Database\QueryException $e) {
            if (! $e->getCode() == 23000) {
                throw $e;
            }
            // Duplicate key
            Terminal::printFailure('User already exists');
            return false;
        }
        Terminal::printSuccess();
        return true;
    }

    /**
     * List all users
     */
    public function listUsersFromDb()
    {
        Terminal::printTitle("List all users from Database:");
        foreach(User::All() as $user) {
            $this->debugUser($user);
        }
        Terminal::printSuccess('done');
    }

    /**
     * @return bool
     */
    public function login()
    {
        Terminal::printTitle('Try to login with user:');
        $users = User::where('login', Terminal::readUserEntry(" - Login: "))
            ->where('passwd', Terminal::readUserEntry(" - Password: "))
            ->get();
        if (count($users) == 0) {
            Terminal::printFailure("Login failed");
            return false;
        }
        Terminal::printSuccess('User login success:');
        $this->debugUser($users[0]);
        Terminal::printSuccess('done');
        return true;
    }

    /**
     * @param User $user
     */
    protected function debugUser(User $user) {
        printf("%s\n", $user);
    }
}
