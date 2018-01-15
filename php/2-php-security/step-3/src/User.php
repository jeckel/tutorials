<?php
namespace Tutorial;

use Illuminate\Database\Eloquent\Model;
use Jeckel\EloquentSignature\HasSignature;
use Jeckel\EloquentSignature\Signable;

/**
 * Class User
 * @package Tutorial
 */
class User extends Model implements Signable
{
    use HasSignature;

    /**
     * Define table name
     * @var string
     */
    protected $table = 'user';

    /**
     * Required
     */
    protected static $signatureProperties = ['login', 'email', 'password'];

    /**
     * Required
     */
    protected static $signatureSalt = 'MySalt';

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
        if (! $user[0]->checkSignatureIsValid()) {
            throw new \Exception('Integrity check failed, login refused');
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
}
