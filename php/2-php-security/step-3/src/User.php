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
    use HasHash;

    const SALT = 'MY-SALT';

    /**
     * Define table name
     * @var string
     */
    protected $table = 'user';

//    protected $hashProperties = ['login', 'email', 'passwd'];

    public static function boot()
    {
        parent::boot();
        self::setHashProperties(['login', 'email', 'passwd']);
    }

    /**
     * You can define your own custom boot method.
     *
     * @return void
     **/
//    public static function boot()
//    {
//        parent::boot();
//        static::retrieved(function(self $user) {
//            if (! $user->isValid()) {
//                Terminal::printFailure("Integrity check failed for user '{$user->login}'");
//            } else {
//                Terminal::printSuccess("Integrity check ok for user '{$user->login}'");
//            }
//        });
//        static::saving(function(self $user) {
//            $user->attributes['hash'] = self::generateUserHash($user);
//        });
//    }

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

//    /**
//     * @param User $user
//     * @return string
//     */
//    protected static function generateUserHash(User $user): string
//    {
//        $hash = sha1(
//            $user->login .
//            $user->email .
//            self::SALT .
//            $user->passwd
//        );
//        return $hash;
//    }
//
//    public function isValid()
//    {
//        return $this->attributes['hash'] == self::generateUserHash($this);
//    }
}