<?php

namespace App\Http\Controllers\Backend;

use App\Facades\MessageBackend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator};
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Branches;
use Yajra\DataTables\Facades\DataTables;

class OutletBranchController extends Controller
{
    public function index()
    {
        return view('pages.branch.index');
    }

    public function getData(Request $request)
    {
        $branches = Branches::query();

        return DataTables::of($branches)
            ->editColumn('code', function ($row) {
                return '<span class="badge bg-primary">' . e($row->code) . '</span>';
            })
            ->editColumn('address', fn($row) => e($row->address))

            ->editColumn('email', function ($row) {
                return $row->email ? e($row->email) : '<span class="text-muted">-</span>';
            })
            ->addColumn('status', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('table_payment', function ($row) {
                return $row->allow_table_payment
                    ? '<span class="badge bg-info">Allowed</span>'
                    : '<span class="badge bg-warning">No</span>';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at
                    ? $row->created_at->format('Y-m-d H:i')
                    : '-';
            })
            ->addColumn('action', function ($row) {

                $deleteUrl = route('branch.destroy', $row->id);
                $viewUrl = route('branch.show', $row->id);
                $editUrl = route('branch.edit', $row->id);

                return '
        <ul class="table-action-list d-flex align-items-center gap-3"
            style="padding-left:0; margin-bottom:0; list-style:none;">

            <li>
                <a href="' . $viewUrl . '"
                    data-toggle="ajaxModal"
                    data-title="Show Branch"
                    data-size="lg">
                    <i class="ri-eye-line"></i>
                </a>
            </li>

            <li>
                <a href="' . $editUrl . '"
                    data-toggle="ajaxModal"
                    data-title="Edit Branch"
                    data-size="lg">
                    <i class="ri-pencil-line"></i>
                </a>
            </li>

            <li>
                <form method="POST" action="' . $deleteUrl . '" class="d-inline" id="ajxFormDelete">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit"
                        style="border:none; background:none; padding:0; color:#dc3545;">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </form>
            </li>

        </ul>
    ';
            })

            ->addIndexColumn()
            ->rawColumns(['code', 'email', 'status', 'table_payment', 'action'])
            ->make(true);
    }


    public function create()
    {
        return view('pages.branch.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'code'                 => 'required|string|unique:branches,code|max:50',
            'name'                 => 'required|string|max:255',
            'address'              => 'required|string',
            'phone'                => 'required|string|max:20',
            'email'                => 'nullable|email|max:255',
            'latitude'             => 'nullable|numeric|between:-90,90',
            'longitude'            => 'nullable|numeric|between:-180,180',
            'is_active'            => 'required|boolean',
            'allow_table_payment'  => 'required|boolean',
        ]);

        if (!$validator->passes()) {
            return MessageBackend::validator($request, $validator->errors()->first());
        }

        try {

            $branch = Branches::create([
                'code'                => $request->code,
                'name'                => $request->name,
                'address'             => $request->address,
                'phone'               => $request->phone,
                'email'               => $request->email,
                'latitude'            => $request->latitude,
                'longitude'           => $request->longitude,
                'is_active'           => $request->is_active,
                'allow_table_payment' => $request->allow_table_payment,
            ]);

            DB::commit();

            return MessageBackend::created($request, "Branch successfully created");
        } catch (\Exception $e) {

            DB::rollBack();
            return MessageBackend::exception($request, $e, "Failed to create branch");
        }
    }

    public function show(Request $request, $id)
    {
        $branch = Branches::find($id);

        if (!$branch) {
            return MessageBackend::notFound($request, "Branch not found");
        }

        return view('pages.branch.show', compact('branch'));
    }

    public function edit(Request $request, $id)
    {
        $branch = Branches::find($id);

        if (!$branch) {
            return MessageBackend::notFound($request, "Branch not found");
        }

        return view('pages.branch.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $branch = Branches::find($id);
        if (!$branch) {
            return MessageBackend::notFound($request, "Branch not found");
        }

        $validator = Validator::make($request->all(), [
            'code'                 => "required|string|max:50|unique:branches,code,$id",
            'name'                 => 'required|string|max:255',
            'address'              => 'required|string',
            'phone'                => 'required|string|max:20',
            'email'                => 'nullable|email|max:255',
            'latitude'             => 'nullable|numeric|between:-90,90',
            'longitude'            => 'nullable|numeric|between:-180,180',
            'is_active'            => 'required|boolean',
            'allow_table_payment'  => 'required|boolean',
        ]);

        if (!$validator->passes()) {
            return MessageBackend::validator($request, $validator->errors()->first());
        }

        try {

            $branch->update([
                'code'                => $request->code,
                'name'                => $request->name,
                'address'             => $request->address,
                'phone'               => $request->phone,
                'email'               => $request->email,
                'latitude'            => $request->latitude,
                'longitude'           => $request->longitude,
                'is_active'           => $request->is_active,
                'allow_table_payment' => $request->allow_table_payment,
            ]);

            DB::commit();

            return MessageBackend::updated($request, "Branch successfully updated");
        } catch (\Exception $e) {

            DB::rollBack();
            return MessageBackend::exception($request, $e, "Failed to update branch");
        }
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $branch = Branches::find($id);

            if (!$branch) {
                return MessageBackend::notFound($request, "Branch not found");
            }

            $branch->delete();

            DB::commit();

            return MessageBackend::deleted($request, "Branch successfully deleted");
        } catch (\Exception $e) {

            DB::rollBack();
            return MessageBackend::exception($request, $e, "Failed to delete branch");
        }
    }

    public function generateCode(Request $request)
    {
        $base = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $request->base));
        if (!$base) {
            return response()->json(['code' => null]);
        }

        $randomString = function () {
            return strtoupper(Str::random(5));
        };

        for ($i = 0; $i < 20; $i++) {
            $code = $base . '-' . $randomString();

            if (!Branches::where('code', $code)->exists()) {
                return response()->json(['code' => $code]);
            }
        }

        return response()->json([
            'code' => null,
            'message' => 'Gagal generate code unik setelah 20 percobaan.'
        ]);
    }
}
