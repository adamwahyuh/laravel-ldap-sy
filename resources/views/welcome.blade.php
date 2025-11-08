<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ldap</title>
</head>
<body>
    <h2>Daftar Pengguna LDAP</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>UID</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Jabatan (Title)</th>
                <th>Departemen</th>
                <th>Telepon</th>
                <th>Groups</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($people as $person)
                <tr>
                    <td>{{ $person->uiid }}</td>
                    <td>{{ $person->full_name }}</td>
                    <td>{{ $person->email }}</td>
                    <td style="color: black">{{ $person->zitle }}</td>
                    <td>{{ $person->department }}</td>
                    <td>{{ $person->phone }}</td>
                    <td>
                        <ul>
                            @forelse($person->groups as $group)
                                <li>{{ $group->name }}</li>
                            @empty
                                <li>No groups</li>
                            @endforelse
                        </ul>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-row">
                        Tidak ada data pengguna yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
