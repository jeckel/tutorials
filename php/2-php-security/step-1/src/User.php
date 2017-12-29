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
}