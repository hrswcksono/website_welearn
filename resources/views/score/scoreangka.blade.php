@extends('layout.base')

@section('content')
<!-- Dynamic Table Full -->
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Data Score Angka</h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell">Email</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                    <th class="text-center" style="width: 15%;">Profile</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="font-w600">Susan Day</td>
                    <td class="d-none d-sm-table-cell">customer1@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-primary">Personal</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="font-w600">Ralph Murray</td>
                    <td class="d-none d-sm-table-cell">customer2@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-warning">Trial</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td class="font-w600">Jack Estrada</td>
                    <td class="d-none d-sm-table-cell">customer3@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-success">VIP</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td class="font-w600">Wayne Garcia</td>
                    <td class="d-none d-sm-table-cell">customer4@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-warning">Trial</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td class="font-w600">Amanda Powell</td>
                    <td class="d-none d-sm-table-cell">customer5@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-success">VIP</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">6</td>
                    <td class="font-w600">Jose Mills</td>
                    <td class="d-none d-sm-table-cell">customer6@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-info">Business</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">7</td>
                    <td class="font-w600">Thomas Riley</td>
                    <td class="d-none d-sm-table-cell">customer7@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-danger">Disabled</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">8</td>
                    <td class="font-w600">Megan Fuller</td>
                    <td class="d-none d-sm-table-cell">customer8@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-warning">Trial</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">9</td>
                    <td class="font-w600">Judy Ford</td>
                    <td class="d-none d-sm-table-cell">customer9@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-warning">Trial</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">10</td>
                    <td class="font-w600">Jose Mills</td>
                    <td class="d-none d-sm-table-cell">customer10@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-warning">Trial</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">11</td>
                    <td class="font-w600">Thomas Riley</td>
                    <td class="d-none d-sm-table-cell">customer11@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-warning">Trial</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">12</td>
                    <td class="font-w600">Betty Kelley</td>
                    <td class="d-none d-sm-table-cell">customer12@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-success">VIP</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">13</td>
                    <td class="font-w600">Susan Day</td>
                    <td class="d-none d-sm-table-cell">customer13@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-success">VIP</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">14</td>
                    <td class="font-w600">Megan Fuller</td>
                    <td class="d-none d-sm-table-cell">customer14@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-info">Business</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">15</td>
                    <td class="font-w600">Helen Jacobs</td>
                    <td class="d-none d-sm-table-cell">customer15@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-primary">Personal</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">16</td>
                    <td class="font-w600">Scott Young</td>
                    <td class="d-none d-sm-table-cell">customer16@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-danger">Disabled</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">17</td>
                    <td class="font-w600">Albert Ray</td>
                    <td class="d-none d-sm-table-cell">customer17@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-danger">Disabled</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">18</td>
                    <td class="font-w600">Jose Mills</td>
                    <td class="d-none d-sm-table-cell">customer18@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-success">VIP</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">19</td>
                    <td class="font-w600">Jose Wagner</td>
                    <td class="d-none d-sm-table-cell">customer19@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-info">Business</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">20</td>
                    <td class="font-w600">Susan Day</td>
                    <td class="d-none d-sm-table-cell">customer20@example.com</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-success">VIP</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->
@endsection