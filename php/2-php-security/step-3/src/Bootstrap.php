<?php
namespace Tutorial;

use DemoTools\Menu;
use DemoTools\Terminal;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class Bootstrap
{
    /**
     * @var array
     */
    protected $menu = [
        'Add user' => 'Tutorial\Controller::createNewUser',
        'List users' => 'Tutorial\Controller::listUsersFromDb',
        'Try login with a user' => 'Tutorial\Controller::login'
    ];

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
     * Boot
     */
    public function boot()
    {
        $this->connectDatabase($this->settings['db']);
        (new Menu($this->menu))->loop();
        return $this;
    }

    /**
     * @param $settings
     */
    protected function connectDatabase($settings) {
        printf("Setting up database connection ");

        $capsule = new Manager();
        $capsule->setEventDispatcher(new Dispatcher);
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
}
