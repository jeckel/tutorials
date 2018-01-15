<?php
/**
 * Created by PhpStorm.
 * User: jeckel
 * Date: 13/01/18
 * Time: 19:21
 */

namespace Tutorial;

use Illuminate\Database\Eloquent\Model;

trait HasHash
{
    protected static $hashField = 'hash';

    protected static $hashProperties = [];

    protected static $salt = 'MySalt';

    static public function bootHasHash()
    {
        static::retrieved(function(Model $model) {
            if (! $model->checkHash()) {
                throw new \Exception('Integrity check violation');
            }
        });

        static::saving(function(Model $model) {
            $model->attributes[static::$hashField] = $model->generateModelHash();
        });
    }

    public static function setHashProperties(array $hashProperties)
    {
        static::$hashProperties = $hashProperties;
    }

    public static function setSalt($salt)
    {
        static::$salt = $salt;
    }

    public function getHashFieldname()
    {
        return property_exists($this, 'hashFieldname') ? $this->hashFieldname : 'hash';
    }


    public function checkHash() {
        return ($this->{static::$hashField} == $this->generateModelHash());
    }

    /**
     * @return string
     */
    protected function generateModelHash(): string
    {
        $properties = array_intersect_key($this->toArray(), array_flip(static::$hashProperties));
        ksort($properties);
        return sha1(
            implode(
                static::$salt,
                $properties
            )
        );
    }
}