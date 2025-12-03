<form action="{{ route('branch.update', $branch->id) }}" method="post" id="ajxForm" data-ajxForm-reset="false">
    @csrf
    @method('PUT')

    <div class="row g-3">

        <div class="col-md-6">
            <label class="form-label">Branch Code <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="code" value="{{ old('code', $branch->code) }}" required>
            <small class="text-muted">Kode cabang tidak di-generate otomatis saat edit.</small>
        </div>

        <div class="col-md-6">
            <label class="form-label">Branch Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $branch->name) }}" required>
        </div>

        <div class="col-12">
            <label class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" rows="2" required>{{ old('address', $branch->address) }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $branch->phone) }}"
                required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email (Optional)</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $branch->email) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Latitude (Optional)</label>
            <input type="text" class="form-control" name="latitude" value="{{ old('latitude', $branch->latitude) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Longitude (Optional)</label>
            <input type="text" class="form-control" name="longitude"
                value="{{ old('longitude', $branch->longitude) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select name="is_active" class="form-control">
                <option value="1" {{ old('is_active', $branch->is_active) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $branch->is_active) == 0 ? 'selected' : '' }}>Inactive
                </option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Allow Table Payment <span class="text-danger">*</span></label>
            <select name="allow_table_payment" class="form-control">
                <option value="0"
                    {{ old('allow_table_payment', $branch->allow_table_payment) == 0 ? 'selected' : '' }}>No</option>
                <option value="1"
                    {{ old('allow_table_payment', $branch->allow_table_payment) == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="form-footer mt-3 d-flex justify-content-end gap-2">
            <a href="{{ route('branch.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Branch</button>
        </div>

    </div>
</form>
