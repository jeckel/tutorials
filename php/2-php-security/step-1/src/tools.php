<?php
/**
 * Created by PhpStorm.
 * User: jmercier
 * Date: 02/01/2018
 * Time: 15:08
 */
use Illuminate\Database\Capsule\Manager;


const COLOR_RED    = "\033[0;31m\033[1m";
const COLOR_GREEN  = "\033[0;32m";
const COLOR_ORANGE = "\033[0;33m";
const COLOR_BLUE   = "\033[0;34m\033[1m";
const COLOR_PURPLE = "\033[0;35m";
const COLOR_CYAN   = "\033[0;36m";
const COLOR_NC     = "\e[0m"; # No Color

/**
 * @param $settings
 */
function connectDatabase($settings) {
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

    printSuccess('done');
}

/**
 * @param string|null $message
 * @return string
 */
function readUserEntry(string $message = null): string {
    if (! empty($message)) {
        printf($message);
    }
    return trim(fgets(STDIN));
}

/**
 * @param array $items
 * @param string $title
 * @return string
 */
function menu(array $items, $title = "Select an iteml"): string
{
    printTitle($title);
    foreach($items as $key => $item) {
        printf (" - [%s] %s\n", $key, $item);
    }
    $selected = -1;
    while(! in_array($selected, array_keys($items))) {
        $selected = readUserEntry("Your choice: ");
    }
    return $selected;
}

/**
 * @param string $title
 */
function printTitle(string $title)
{
    printf(COLOR_BLUE . $title . COLOR_NC . "\n");
}

/**
 * @param string $success
 */
function printSuccess(string $success = 'success')
{
    printf(COLOR_GREEN . $success . COLOR_NC . "\n");
}

/**
 * @param string $failure
 */
function printFailure(string $failure = 'failure')
{
    printf(COLOR_RED . $failure . COLOR_NC . "\n");
}
