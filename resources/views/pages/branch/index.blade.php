@extends('layouts.admin.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title d-sm-flex d-block">
                            <h5>Branch List</h5>
                            <div class="right-options">
                                <ul>
                                    <li>
                                        <a class="btn btn-solid" href="{{ route('branch.create') }}" data-toggle="ajaxModal"
                                            data-title="Create Branch" data-size="lg">Add Branch</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table id="dataTbl"
                                    class="table table-striped card-table table-vcenter text-nowrap datatable"
                                    data-ajax="{{ route('branch.getData') }}" data-processing="true" data-server-side="true"
                                    data-length-menu="[50,100,250]" data-ordering="true" data-col-reorder="true">
                                    <thead>
                                        <tr>
                                            <th data-data="DT_RowIndex" data-orderable="false" data-searchable="false">No
                                            </th>
                                            <th data-data="code" data-class-name="text-center">Code</th>
                                            <th data-data="name">Name</th>
                                            <th data-data="address">Address</th>
                                            <th data-data="phone">Phone</th>
                                            <th data-data="email">Email</th>
                                            <th data-data="status" data-class-name="text-center">Status</th>
                                            <th data-data="table_payment" data-class-name="text-center">Table Payment</th>
                                            <th data-data="created_at">Created At</th>
                                            <th data-data="action" data-orderable="false" data-searchable="false"
                                                data-class-name="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
