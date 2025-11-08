<?php

namespace App\Ldap;

use App\Ldap\Person;
use LdapRecord\Models\Model;
use LdapRecord\Models\Relations\HasMany;

class Group extends Model
{
    public static array $objectClasses = [
        'top',
        'groupOfNames',
    ];

    protected $baseDn = 'ou=Groups,dc=adam,dc=local';

    //aksesor

    public function getNameAttribute()
    {
        return $this->cn[0] ?? null;
    }

    public function getMembersListAttribute()
    {
        return $this->member ?? [];
    }

    // Relasi
    public function members(): HasMany
    {
        return $this->hasMany(Person::class, 'dn', 'member');
    }

}
