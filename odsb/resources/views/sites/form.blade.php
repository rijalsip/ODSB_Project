<div class="row">

    {{-- Kolom Kiri --}}
    <div class="col-md-6">

        <div class="form-group">
            <label>Site ID <span class="text-danger">*</span></label>
            <input
                type="text"
                name="site_id"
                class="form-control @error('site_id') is-invalid @enderror"
                value="{{ old('site_id', $site->site_id ?? '') }}"
                placeholder="Contoh : RKB001"
            >

            @error('site_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Site Name <span class="text-danger">*</span></label>
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
            <label>Branch</label>
            <input
                type="text"
                name="branch"
                class="form-control @error('branch') is-invalid @enderror"
                value="{{ old('branch', $site->branch ?? '') }}"
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
            >

            @error('cluster')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>City</label>
            <input
                type="text"
                name="city"
                class="form-control @error('city') is-invalid @enderror"
                value="{{ old('city', $site->city ?? '') }}"
            >

            @error('city')
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
            >

            @error('kecamatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

    </div>

    {{-- Kolom Kanan --}}
    <div class="col-md-6">

        <div class="form-group">
            <label>Site Focus MTD</label>

            <select
                name="site_focus_mtd"
                class="form-control @error('site_focus_mtd') is-invalid @enderror"
            >
                <option value="">-- Pilih Status --</option>

                @foreach (['NON SITE FOCUS','P1','P2','P3'] as $status)
                    <option
                        value="{{ $status }}"
                        {{ old('site_focus_mtd', $site->site_focus_mtd ?? '') == $status ? 'selected' : '' }}
                    >
                        {{ $status }}
                    </option>
                @endforeach

            </select>

            @error('site_focus_mtd')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Program</label>
            <input
                type="text"
                name="program"
                class="form-control @error('program') is-invalid @enderror"
                value="{{ old('program', $site->program ?? '') }}"
            >

            @error('program')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Detail Program SSGJ</label>
            <input
                type="text"
                name="detail_program_ssgj"
                class="form-control @error('detail_program_ssgj') is-invalid @enderror"
                value="{{ old('detail_program_ssgj', $site->detail_program_ssgj ?? '') }}"
            >

            @error('detail_program_ssgj')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>New Infra</label>
            <input
                type="text"
                name="new_infra"
                class="form-control @error('new_infra') is-invalid @enderror"
                value="{{ old('new_infra', $site->new_infra ?? '') }}"
            >

            @error('new_infra')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tech</label>
            <input
                type="text"
                name="tech"
                class="form-control @error('tech') is-invalid @enderror"
                value="{{ old('tech', $site->tech ?? '') }}"
            >

            @error('tech')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Class</label>
            <input
                type="text"
                name="class"
                class="form-control @error('class') is-invalid @enderror"
                value="{{ old('class', $site->class ?? '') }}"
            >

            @error('class')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>NE</label>
            <input
                type="text"
                name="ne"
                class="form-control @error('ne') is-invalid @enderror"
                value="{{ old('ne', $site->ne ?? '') }}"
            >

            @error('ne')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Network Condition</label>
            <input
                type="text"
                name="network_condition"
                class="form-control @error('network_condition') is-invalid @enderror"
                value="{{ old('network_condition', $site->network_condition ?? '') }}"
            >

            @error('network_condition')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

    </div>

</div>

<hr>

<div class="d-flex justify-content-end">

    <a href="{{ route('sites.index') }}" class="btn btn-secondary mr-2">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Simpan
    </button>

</div>