<?php

namespace App\Ldap;

use App\Ldap\Person;
use LdapRecord\Models\Model;
use LdapRecord\Models\Relations\HasMany;

class Department extends Model
{
    public $objectClasses = [
        'top',
        'organizationalUnit',
    ];

    protected $baseDn = 'ou=Departments,dc=adam,dc=local';

    public function members(): HasMany
    {
        return $this->hasMany(Person::class, 'departmentNumber', 'ou');
    }

}
