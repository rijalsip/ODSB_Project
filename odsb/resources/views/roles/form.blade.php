<div class="form-group">
    <label>Nama Role</label>
    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $role->name ?? '') }}"
        placeholder="Masukkan nama role"
    >

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Deskripsi</label>
    <textarea
        name="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="3"
        placeholder="Masukkan deskripsi"
    >{{ old('description', $role->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <div class="form-check">
        <input
            type="checkbox"
            name="is_active"
            value="1"
            class="form-check-input"
            id="is_active"
            {{ old('is_active', $role->is_active ?? true) ? 'checked' : '' }}
        >

        <label class="form-check-label" for="is_active">
            Aktif
        </label>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    <i class="fas fa-save"></i>
    Simpan
</button>

<a href="{{ route('roles.index') }}" class="btn btn-secondary">
    Kembali
</a>