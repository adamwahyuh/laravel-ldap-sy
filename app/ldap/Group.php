<?php

namespace App\Ldap;

use App\Ldap\Person;
use LdapRecord\Models\Model;
use LdapRecord\Models\Relations\HasMany;

class Group extends Model
{
    public $objectClasses = [
        'top',
        'groupOfNames',
    ];

    protected $baseDn = 'ou=Groups,dc=adam,dc=local';

    // Relasi
    public function members(): HasMany
    {
        return $this->hasMany(Person::class, 'dn', 'member');
    }

}
