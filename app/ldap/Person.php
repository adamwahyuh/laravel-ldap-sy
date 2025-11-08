<?php

namespace App\Ldap;

use App\Ldap\Group;
use LdapRecord\Models\Model;
use LdapRecord\Models\Relations\HasMany;

class Person extends Model{

    public $objectClasses = [
        'top',
        'person',
        'organizationalPerson',
        'inetOrgPerson',
    ];

    protected $baseDn = 'ou=People,dc=adam,dc=local';

    //aksesor

    public function getUidAttribute()
    {
        return $this->uid[0] ?? null;
    }

    public function getFullNameAttribute()
    {
        return $this->displayName[0] ?? null;
    }

    public function getEmailAttribute()
    {
        return $this->mail[0] ?? null;
    }

    public function getTitleAttribute()
    {
        return $this->title[0] ?? null;
    }

    public function getDepartmentAttribute()
    {
        return $this->departmentNumber[0] ?? null;
    }

    public function getPhoneAttribute()
    {
        return $this->telephoneNumber[0] ?? null;
    }

    // Relasi 

    public function groups() : HasMany
    {
        return $this->hasMany(Group::class, 'member', 'dn');
    }
}