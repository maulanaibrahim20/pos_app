<form action="{{ route('branch.store') }}" method="post" id="ajxForm" data-ajxForm-reset="false">
    @csrf

    <div class="row g-3">

        <div class="col-md-6">
            <label class="form-label">Branch Code <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="branchCode" name="code" placeholder="e.g. BR001"
                    required>
                <button type="button" class="btn btn-outline-primary" id="btnGenerateCode">
                    Auto Generate
                </button>
            </div>

            <small class="text-muted">Masukkan kata dasar, lalu klik Auto Generate</small>
        </div>

        <div class="col-md-6">
            <label class="form-label">Branch Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="Enter branch name" required>
        </div>

        <div class="col-12">
            <label class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" rows="2" placeholder="Full branch address" required></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="phone" placeholder="Branch phone number" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email (Optional)</label>
            <input type="email" class="form-control" name="email" placeholder="Branch email">
        </div>

        <div class="col-md-6">
            <label class="form-label">Latitude (Optional)</label>
            <input type="text" class="form-control" name="latitude" placeholder="-6.20000000">
        </div>

        <div class="col-md-6">
            <label class="form-label">Longitude (Optional)</label>
            <input type="text" class="form-control" name="longitude" placeholder="106.81666600">
        </div>

        <div class="col-md-6">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select name="is_active" class="form-control">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Allow Table Payment <span class="text-danger">*</span></label>
            <select name="allow_table_payment" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="form-footer mt-3 d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Create Branch</button>
        </div>

    </div>
</form>

<script>
    document.getElementById("btnGenerateCode").addEventListener("click", function() {
        let base = document.getElementById("branchCode").value.trim();

        if (!base) {
            alert("Masukkan dulu kata dasar untuk generate.");
            return;
        }

        base = base.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();

        fetch(`{{ route('branch.generateCode') }}?base=${base}`)
            .then(res => res.json())
            .then(data => {
                if (data.code) {
                    document.getElementById("branchCode").value = data.code;
                } else {
                    alert(data.message || "Gagal generate code.");
                }
            });
    });
</script>
