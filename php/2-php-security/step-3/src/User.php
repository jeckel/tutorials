<?php
namespace Tutorial;

use DemoTools\Terminal;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package Tutorial
 */
class User extends Model
{
    const SALT = 'MY-SALT';

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
            ->where('passwd', self::passwordHash($password))
            ->get();
        if (count($user) == 0) {
            throw new \Exception('Login failed');
        }
        return $user[0];
    }

    public function save(array $options = [])
    {
        $this->attributes['hash'] = self::generateUserHash($this);
        parent::save($options);
    }

    /**
     * @param string $password
     */
    public function setPasswdAttribute(string $password)
    {
        $this->attributes['passwd'] = self::passwordHash($password);
    }

    /**
     * @param string $password
     * @return string
     */
    protected static function passwordHash(string $password): string
    {
        return sha1($password);
    }

    protected static function generateUserHash(User $user): string
    {
        return sha1(
            $user->login .
            $user->email .
            self::SALT .
            $user->passwd .
            $user->id
        );
    }
}