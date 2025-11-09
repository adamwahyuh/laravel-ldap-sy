<?php

namespace App\Http\Controllers;

use App\Ldap\Group;
use App\Ldap\Person;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $people = Person::get();
        return view('welcome', compact('people'));
    }

    public function create()
    {
        $groups = Group::get();
        return view('create', compact('groups'));
    }

    public function store(Request $request)
    {
        try {
            $person = new Person();

            $person->cn = $request->cn;
            $person->displayName = $request->cn;
            $person->givenName = $request->givenName;
            $person->sn = $request->sn;
            $person->uid = $request->uid;
            $person->mail = $request->mail;
            $person->title = $request->title;
            $person->departmentNumber = $request->departmentNumber;
            $person->employeeNumber = $request->employeeNumber;
            $person->telephoneNumber = $request->telephoneNumber;
            $person->userPassword = $request->userPassword;

            $person->setDn("uid={$request->uid},ou=People,dc=adam,dc=local");
            $person->save();

            // Tambahkan member ke group jika department ada
            if ($request->departmentNumber) {
                $group = Group::where('cn', $request->departmentNumber)->first();
                if ($group) {
                    $group->addMember($person->getDn());
                }
            }

            return redirect()->route('public.index')->with('success', 'User created!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Could not create user: ' . $e->getMessage());
        }
    }

    public function edit(string $uid)
    {
        $person = Person::findBy('uid', $uid);
        if (!$person) {
            return redirect()->route('public.index')->with('error', 'User tidak ditemukan.');
        }

        $groups = Group::get();
        return view('edit', compact('person', 'groups'));
    }

    public function update(Request $request, string $uid)
    {
        $person = Person::findBy('uid', $uid);

        if (!$person) {
            return redirect()->route('public.index')->with('error', 'User tidak ditemukan.');
        }

        try {
            $person->cn = $request->cn;
            $person->givenName = $request->givenName;
            $person->sn = $request->sn;
            $person->mail = $request->mail;
            $person->title = $request->title;
            $person->employeeNumber = $request->employeeNumber;
            $person->telephoneNumber = $request->telephoneNumber;

            if ($request->filled('userPassword')) {
                $person->userPassword = $request->userPassword;
            }

            // Simpan perubahan dasar terlebih dahulu
            $person->save();

            // Handle perubahan department dan group
            $oldDept = $person->departmentNumber[0] ?? null;
            $newDept = $request->departmentNumber;

            // Jika ada perubahan department
            if ($newDept && $oldDept !== $newDept) {

                // Tambah ke group baru jika ada
                if ($newDept) {
                    $newGroup = Group::findBy('cn', $newDept);
                    if ($newGroup) {
                        $newGroup->addMember($person->getDn());
                        // Simpan departmentNumber sebagai array agar kompatibel LDAP
                        $person->departmentNumber = [$newDept];
                        $person->save();
                    } else {
                        return back()->withInput()->with('error', 'Department baru tidak ditemukan.');
                    }
                }

                // Hapus dari group lama jika ada
                if ($oldDept) {
                    $oldGroup = Group::findBy('cn', $oldDept);
                    if ($oldGroup) {
                        $oldGroup->removeMember($person->getDn());
                    }
                }

                
            }

            return redirect()->route('public.index')->with('success', 'User berhasil di-update!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal update user: ' . $e->getMessage());
        }
    }

    public function destroy(string $uid)
    {
        $person = Person::findBy('uid', $uid);
        if (!$person) {
            return redirect()->route('public.index')->with('error', 'User tidak ditemukan.');
        }

        try {
            $groups = $person->groups;
            foreach ($groups as $group) {
                $group->removeMember($person->getDn());
            }

            $person->delete();

            return redirect()->route('public.index')->with('success', 'User berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('public.index')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
