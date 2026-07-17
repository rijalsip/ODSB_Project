<div class="form-group">
    <label>Role</label>

    <select
        name="role_id"
        class="form-control @error('role_id') is-invalid @enderror"
    >
        <option value="">-- Pilih Role --</option>

        @foreach ($roles as $role)

            <option
                value="{{ $role->id }}"
                {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}
            >
                {{ $role->name }}
            </option>

        @endforeach
    </select>

    @error('role_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Nama</label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $user->name ?? '') }}"
        placeholder="Masukkan nama"
    >

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Username</label>

    <input
        type="text"
        name="username"
        class="form-control @error('username') is-invalid @enderror"
        value="{{ old('username', $user->username ?? '') }}"
        placeholder="Masukkan username"
    >

    @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Email</label>

    <input
        type="email"
        name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email ?? '') }}"
        placeholder="Masukkan email"
    >

    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>No. HP</label>

    <input
        type="text"
        name="phone"
        class="form-control @error('phone') is-invalid @enderror"
        value="{{ old('phone', $user->phone ?? '') }}"
        placeholder="Masukkan nomor HP"
    >

    @error('phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Telegram Chat ID</label>

    <input
        type="text"
        name="telegram_chat_id"
        class="form-control @error('telegram_chat_id') is-invalid @enderror"
        value="{{ old('telegram_chat_id', $user->telegram_chat_id ?? '') }}"
        placeholder="Masukkan Telegram Chat ID"
    >

    @error('telegram_chat_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Telegram Username</label>

    <input
        type="text"
        name="telegram_username"
        class="form-control @error('telegram_username') is-invalid @enderror"
        value="{{ old('telegram_username', $user->telegram_username ?? '') }}"
        placeholder="Masukkan username Telegram"
    >

    @error('telegram_username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Password</label>

    <input
        type="password"
        name="password"
        class="form-control @error('password') is-invalid @enderror"
        placeholder="Masukkan password"
    >

    @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

    @isset($user)
        <small class="text-muted">
            Kosongkan jika tidak ingin mengganti password.
        </small>
    @endisset
</div>

<div class="form-group">
    <div class="form-check">

        <input
            type="checkbox"
            name="is_active"
            value="1"
            class="form-check-input"
            id="is_active"
            {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}
        >

        <label class="form-check-label" for="is_active">
            Aktif
        </label>

    </div>
</div>

<div class="card-footer">

    <button
        type="submit"
        class="btn btn-primary"
    >
        <i class="fas fa-save"></i>
        Simpan
    </button>

    <a
        href="{{ route('users.index') }}"
        class="btn btn-secondary"
    >
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

</div>