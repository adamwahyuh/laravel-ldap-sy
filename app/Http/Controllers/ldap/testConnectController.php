<?php

namespace App\Http\Controllers\ldap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LdapRecord\Container;
use LdapRecord\Auth\BindException;

class testConnectController extends Controller
{
    //

    public function testLoginWithUser(){
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
    }

    public function testConnectionServer(){
        try {
            $connection = Container::getConnection('default');

            // Tes koneksi ke server LDAP
            $connection->connect();
            if (! $connection->isConnected()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak bisa terhubung ke server LDAP',
                ]);
            }

            // Tes bind (autentikasi) menggunakan admin DN & password dari env
            $connection->auth()->bind(
                config('ldap.connections.default.username'),
                config('ldap.connections.default.password')
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Koneksi & bind LDAP berhasil!',
                'host' => config('ldap.connections.default.hosts')[0],
                'base_dn' => config('ldap.connections.default.base_dn'),
            ]);
        } catch (\LdapRecord\Auth\BindException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bind gagal — kredensial LDAP salah',
                'ldap_error' => $e->getDetailedError()->getErrorMessage(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal konek ke LDAP',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
