<form method="POST" action="{{ $action }}">
    @csrf
    @if(!empty($method) && strtolower($method) !== 'post')
        @method(strtoupper($method))
    @endif

    <div style="margin-bottom:8px">
        <label for="name">Name</label><br>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name ?? '') }}" style="width:100%;padding:6px;border:1px solid #ccc;border-radius:4px">
        @error('name') <div style="color:#b91c1c;margin-top:4px">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom:8px">
        <label for="email">Email</label><br>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" style="width:100%;padding:6px;border:1px solid #ccc;border-radius:4px">
        @error('email') <div style="color:#b91c1c;margin-top:4px">{{ $message }}</div> @enderror
    </div>

    @if(!empty($roles))
        <div style="margin-bottom:8px">
            <label for="roles">Roles</label><br>
            <select id="roles" name="roles[]" multiple style="width:100%;padding:6px;border:1px solid #ccc;border-radius:4px">
                @foreach($roles as $id => $label)
                    <option value="{{ $id }}"
                        {{ in_array($id, old('roles', $selected ?? [])) ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('roles') <div style="color:#b91c1c;margin-top:4px">{{ $message }}</div> @enderror
        </div>
    @endif

    <div style="display:flex;gap:8px;align-items:center;margin-top:12px">
        <button type="submit" style="padding:8px 12px;background:#0366d6;color:#fff;border:none;border-radius:4px;cursor:pointer">
            {{ $buttonText ?? 'Save' }}
        </button>
        <a href="{{ route('users.index') }}" style="color:#0366d6;text-decoration:none">Cancel</a>
    </div>
</form>