<?php

namespace App\Ldap;

use App\Ldap\Person;
use LdapRecord\Models\Model;

class Group extends Model
{
    public static array $objectClasses = [
        'top',
        'groupOfNames',
    ];

    protected $baseDn = 'ou=Groups,dc=adam,dc=local';

    // Accessors
    public function getNameAttribute()
    {
        return $this->cn[0] ?? null;
    }

    public function getMembersListAttribute()
    {
        return $this->member ?? [];
    }

    // Add DN to group
    public function addMember($dn)
    {
        $members = $this->member ?? [];

        if (!is_array($members)) {
            $members = [$members];
        }

        if (!in_array($dn, $members)) {
            $members[] = $dn;
            $this->member = $members;
            $this->save();
        }
    }

    // Remove DN from group
    public function removeMember($dn)
    {
        $members = $this->member ?? [];

        if (!is_array($members)) {
            $members = [$members];
        }

        if (($key = array_search($dn, $members)) !== false) {
            unset($members[$key]);
            $this->member = array_values($members);
            $this->save();
        }
    }
}
