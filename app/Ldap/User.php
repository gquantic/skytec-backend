<?php

namespace App\Ldap;

use LdapRecord\Models\Model;

class User extends Model
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = [
        'top',
        'person',
        'organizationalPerson',
        'user',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'objectguid' => 'string',
    ];

    /**
     * Find a user by their username.
     */
    public static function findByUsername($username)
    {
        return static::findBy('uid', $username);
    }
}
