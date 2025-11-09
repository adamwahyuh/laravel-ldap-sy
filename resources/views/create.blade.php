<x-layout>
    <h2>Create New User</h2>
    
    <form action="{{ route('public.store') }}" method="POST" style="width: 400px; max-width: 100%;">
        
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label for="cn" style="display: block; margin-bottom: 5px;">Full Name (cn)</label>
            <input type="text" id="cn" name="cn" placeholder="Alice Smith" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="givenName" style="display: block; margin-bottom: 5px;">First Name (givenName)</label>
            <input type="text" id="givenName" name="givenName" placeholder="Alice" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="sn" style="display: block; margin-bottom: 5px;">Last Name (sn)</label>
            <input type="text" id="sn" name="sn" placeholder="Smith" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="uid" style="display: block; margin-bottom: 5px;">Username (uid)</label>
            <input type="text" id="uid" name="uid" placeholder="alice.smith" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="mail" style="display: block; margin-bottom: 5px;">Email (mail)</label>
            <input type="email" id="mail" name="mail" placeholder="alice.smith@adam.local" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="title" style="display: block; margin-bottom: 5px;">Job Title (title)</label>
            <input type="text" id="title" name="title" placeholder="Chief Executive Officer" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="departmentNumber" style="display: block; margin-bottom: 5px;">Department</label>
            
            <select id="departmentNumber" name="departmentNumber" style="width: 100%; padding: 8px; box-sizing: border-box;">
                <option value="">-- Pilih Departemen --</option>
                
                @foreach ($groups as $group)
                    <option value="{{ $group->name }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="employeeNumber" style="display: block; margin-bottom: 5px;">Employee Number</label>
            <input type="text" id="employeeNumber" name="employeeNumber" placeholder="1001" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="telephoneNumber" style="display: block; margin-bottom: 5px;">Telephone</label>
            <input type="tel" id="telephoneNumber" name="telephoneNumber" placeholder="+62 21 555 0101" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="userPassword" style="display: block; margin-bottom: 5px;">Password (userPassword)</label>
            <input type="password" id="userPassword" name="userPassword" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <button type="submit" style="padding: 10px 15px; cursor: pointer; background-color: #007bff; color: white; border: none; border-radius: 4px;">
                Create User
            </button>
        </div>
    </form>
</x-layout>