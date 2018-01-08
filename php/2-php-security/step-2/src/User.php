<?php
namespace Tutorial;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package Tutorial
 */
class User extends Model
{
    /**
     * Define table name
     * @var string
     */
    protected $table = 'user';

    /**
     * @param string $login
     * @param string $password
     * @return User
     * @throws \Exception
     */
    public static function login(string $login, string $password): User
    {
        $user = self::where('login', $login)
            ->where('passwd', $password)
            ->get();
        if (count($user) == 0) {
            throw new \Exception('Login failed');
        }
        return $user[0];
    }
}