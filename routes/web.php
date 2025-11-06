<?php

use Illuminate\Support\Facades\Route;
use LdapRecord\Container;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ldap-login-test', function () {
    $connection = Container::getDefaultConnection();

    $userCn = env('LDAP_USER_CN_1');
    $userPass = env('LDAP_USER_Password_1');

    $username = "cn={$userCn},cn=users,dc=adam,dc=local";
    $password = $userPass;

    try {
        if ($connection->auth()->attempt($username, $password)) {
            return "Logged in successfully!";
        } else {
            $query = $connection->query()->whereEquals('distinguishedName', $username)->get();

            if (empty($query)) {
                return "Username not found";
            } else {
                return "Invalid password for user DN: {$username}";
            }
        }
    } catch (\LdapRecord\Auth\BindException $e) {
        return "LDAP bind error: " . $e->getDetailedError()->getDiagnosticMessage();
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
