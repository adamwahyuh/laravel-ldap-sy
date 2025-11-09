<x-layout> 
    <h2>Daftar Pengguna LDAP</h2>
    <a href="{{ route('public.create') }}">Create</a>
    
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
                <th>Aksi</th> {{-- <-- KOLOM BARU --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($people as $person)
                <tr>
                    <td>{{ $person->uiid }}</td>
                    <td>{{ $person->full_name }}</td>
                    <td>{{ $person->email }}</td>
                    <td style="color: black">{{ $person->jabatan }}</td>
                    <td>{{ $person->department }}</td>
                    <td>{{ $person->phone }}</td>
                    <td>
                        <ul>
                            @forelse($person->groups as $group)
                                <li>{{ $group->getFirstAttribute('cn') }}</li>
                            @empty
                                <li>Tidak ada grup</li>
                            @endforelse
                        </ul>
                    </td>
                    
                    <td>
                        <a href="{{ route('public.edit', ['uid' => $person->uiid]) }}" style="text-decoration: none;">
                            Edit
                        </a>

                        <form action="{{ route('public.destroy', ['uid' => $person->uiid]) }}" method="POST" style="display:inline; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $person->full_name }}?')" 
                                    style="color: red; background: none; border: none; padding: 0; cursor: pointer;">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty-row">
                        Tidak ada data pengguna yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layout>