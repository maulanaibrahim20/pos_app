<div class="py-2">

    <h5 class="mb-3 fw-semibold">Branch Details</h5>

    <div class="vstack gap-2">

        <div class="border rounded p-3">
            <small class="text-muted d-block">Branch Code</small>
            <span class="badge badge-success">{{ $branch->code }}</span>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Branch Name</small>
            <div class="fw-semibold">{{ $branch->name }}</div>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Address</small>
            <div class="fw-semibold">{{ $branch->address }}</div>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Phone</small>
            <div class="fw-semibold">{{ $branch->phone }}</div>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Email</small>
            <div class="fw-semibold">{{ $branch->email ?? '-' }}</div>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Latitude</small>
            <div class="fw-semibold">{{ $branch->latitude ?? '-' }}</div>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Longitude</small>
            <div class="fw-semibold">{{ $branch->longitude ?? '-' }}</div>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Status</small>
            <span class="badge bg-{{ $branch->is_active ? 'success' : 'danger' }}">
                {{ $branch->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>

        <div class="border rounded p-3">
            <small class="text-muted d-block">Allow Table Payment</small>
            <span class="badge bg-{{ $branch->allow_table_payment ? 'success' : 'danger' }}">
                {{ $branch->allow_table_payment ? 'Yes' : 'No' }}
            </span>
        </div>

    </div>

</div>
