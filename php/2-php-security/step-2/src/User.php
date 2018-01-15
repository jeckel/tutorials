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
        if (! $user[0]->checkIntegrity()) {
            throw new \Exception('Integrity check failed, login refused');
        }
        return $user[0];
    }

    /**
     * Override save method to always update the hash before saving
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->attributes['hash'] = $this->generateHash();
        return parent::save($options);
    }

    /***
     * Check user integrity, verify is the saved signature is still valid
     * @return bool
     */
    public function checkIntegrity(): bool
    {
        return $this->hash == $this->generateHash();
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

    /**
     * Generate a user signature
     * @return string
     */
    public function generateHash(): string
    {
        return sha1(
            sprintf(
                '%s.SALT.%s.SALT2.%s',
                $this->login,
                $this->email,
                $this->passwd
            )
        );
    }
}
