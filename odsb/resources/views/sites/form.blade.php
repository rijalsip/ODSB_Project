<div class="form-group">
    <label>Site ID</label>
    <input
        type="text"
        name="site_id"
        class="form-control @error('site_id') is-invalid @enderror"
        value="{{ old('site_id', $site->site_id ?? '') }}"
        placeholder="Masukkan Site ID"
    >

    @error('site_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Site Name</label>
    <input
        type="text"
        name="site_name"
        class="form-control @error('site_name') is-invalid @enderror"
        value="{{ old('site_name', $site->site_name ?? '') }}"
        placeholder="Masukkan Site Name"
    >

    @error('site_name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Regional</label>
    <input
        type="text"
        name="regional"
        class="form-control @error('regional') is-invalid @enderror"
        value="{{ old('regional', $site->regional ?? '') }}"
        placeholder="Masukkan Regional"
    >

    @error('regional')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Branch</label>
    <input
        type="text"
        name="branch"
        class="form-control @error('branch') is-invalid @enderror"
        value="{{ old('branch', $site->branch ?? '') }}"
        placeholder="Masukkan Branch"
    >

    @error('branch')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Cluster</label>
    <input
        type="text"
        name="cluster"
        class="form-control @error('cluster') is-invalid @enderror"
        value="{{ old('cluster', $site->cluster ?? '') }}"
        placeholder="Masukkan Cluster"
    >

    @error('cluster')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Kabupaten</label>
    <input
        type="text"
        name="kabupaten"
        class="form-control @error('kabupaten') is-invalid @enderror"
        value="{{ old('kabupaten', $site->kabupaten ?? '') }}"
        placeholder="Masukkan Kabupaten"
    >

    @error('kabupaten')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Kecamatan</label>
    <input
        type="text"
        name="kecamatan"
        class="form-control @error('kecamatan') is-invalid @enderror"
        value="{{ old('kecamatan', $site->kecamatan ?? '') }}"
        placeholder="Masukkan Kecamatan"
    >

    @error('kecamatan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Address</label>
    <textarea
        name="address"
        class="form-control @error('address') is-invalid @enderror"
        rows="3"
        placeholder="Masukkan Alamat"
    >{{ old('address', $site->address ?? '') }}</textarea>

    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Latitude</label>
    <input
        type="number"
        step="0.0000001"
        name="latitude"
        class="form-control @error('latitude') is-invalid @enderror"
        value="{{ old('latitude', $site->latitude ?? '') }}"
        placeholder="Contoh: 1.6099721"
    >

    @error('latitude')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Longitude</label>
    <input
        type="number"
        step="0.0000001"
        name="longitude"
        class="form-control @error('longitude') is-invalid @enderror"
        value="{{ old('longitude', $site->longitude ?? '') }}"
        placeholder="Contoh: 101.4477793"
    >

    @error('longitude')
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
            {{ old('is_active', $site->is_active ?? true) ? 'checked' : '' }}
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

<a href="{{ route('sites.index') }}" class="btn btn-secondary">
    Kembali
</a>