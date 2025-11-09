<x-layout>

    <h2>Edit User: {{ $person->full_name }}</h2>
    @if (session('error'))
        <div style="color: red; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('public.update', ['uid' => $person->uiid]) }}" method="POST" style="width: 400px; max-width: 100%;">
        
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label for="cn" style="display: block; margin-bottom: 5px;">Full Name (cn)</label>
            <input type="text" id="cn" name="cn" value="{{ $person->getFirstAttribute('cn') }}" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="givenName" style="display: block; margin-bottom: 5px;">First Name (givenName)</label>
            <input type="text" id="givenName" name="givenName" value="{{ $person->getFirstAttribute('givenName') }}" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="sn" style="display: block; margin-bottom: 5px;">Last Name (sn)</label>
            <input type="text" id="sn" name="sn" value="{{ $person->getFirstAttribute('sn') }}" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="uid" style="display: block; margin-bottom: 5px;">Username (uid)</label>
            <input type="text" id="uid" name="uid" value="{{ $person->uiid }}" readonly style="width: 100%; padding: 8px; box-sizing: border-box; background-color: #eee;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="mail" style="display: block; margin-bottom: 5px;">Email (mail)</label>
            <input type="email" id="mail" name="mail" value="{{ $person->email }}" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="title" style="display: block; margin-bottom: 5px;">Job Title (title)</label>
            <input type="text" id="title" name="title" value="{{ $person->jabatan }}" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="departmentNumber" style="display: block; margin-bottom: 5px;">Department</label>
            <select id="departmentNumber" name="departmentNumber" style="width: 100%; padding: 8px; box-sizing: border-box;">
                <option value="">-- Pilih Departemen --</option>
                
                @foreach ($groups as $group)
                    <option value="{{ $group->name }}" @if($person->department == $group->name) selected @endif>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="employeeNumber" style="display: block; margin-bottom: 5px;">Employee Number</label>
            <input type="text" id="employeeNumber" name="employeeNumber" value="{{ $person->getFirstAttribute('employeeNumber') }}" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="telephoneNumber" style="display: block; margin-bottom: 5px;">Telephone</label>
            <input type="tel" id="telephoneNumber" name="telephoneNumber" value="{{ $person->phone }}" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="userPassword" style="display: block; margin-bottom: 5px;">Password</label>
            <input type="password" id="userPassword" name="userPassword" placeholder="Leave blank to keep current password" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <button type="submit" style="padding: 10px 15px; cursor: pointer; background-color: #007bff; color: white; border: none; border-radius: 4px;">
                Update User
            </button>
        </div>
    </form>
</x-layout>