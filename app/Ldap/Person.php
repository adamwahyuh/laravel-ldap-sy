<?php

namespace App\Ldap;

use App\Ldap\Group;
use LdapRecord\Models\Model;

class Person extends Model
{
    public static array $objectClasses = [
        'top',
        'person',
        'organizationalPerson',
        'inetOrgPerson',
    ];


    protected $selects = [
        'uid', 
        'displayName', 
        'mail', 
        'departmentNumber', 
        'telephoneNumber',
        'title', 
    ];

    protected $baseDn = 'ou=People,dc=adam,dc=local';

    // aksesor

    public function getUiidAttribute()
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

    public function getJabatanAttribute()
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

    // relasi
    public function getGroupsAttribute()
    {
        // Ambil semua Group yang memiliki 'member' = DN pengguna ini
        return Group::where('member', $this->getDn())->get();
    }


    protected $rules = [
        'objectClass' => ['required', 'array'],

        'cn' => ['required', 'string'],          
        'sn' => ['required', 'string'],          
        'givenName' => ['required', 'string'],   
        'uid' => ['required', 'string'],         
        'mail' => ['required', 'email'],         
        'userPassword' => ['required', 'string', 'min:8'], 

        'title' => ['nullable', 'string'],
        'departmentNumber' => ['nullable', 'string'],
        'employeeNumber' => ['nullable', 'string'],
        'telephoneNumber' => ['nullable', 'string'],
    ];

}
