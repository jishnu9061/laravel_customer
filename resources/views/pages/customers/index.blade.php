@extends('layouts.admin-dashboard')

@push('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet"
        href="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Customers</h3>
                    <a href="{{ route('customer.create') }}" class="btn btn-primary pull-right">Create</a>
                </div>
                <div class="box-body">
                    <form method="GET" action="{{ route('home') }}" class="mb-3">
                        <div class="form-group row">
                            <label for="search" class="col-sm-2 control-label">Search by Name:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter customer name" value="{{ request()->name }}">
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="dataTable1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="hidden"></th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Company</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="hidden">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $customer->name }}</td>
                                        <td class="text-center">{{ $customer->address }}</td>
                                        <td class="text-center">{{ $customer->phone }}</td>
                                        <td class="text-center">{{ $customer->email }}</td>
                                        <td class="text-center">
                                            <input type="checkbox" class="toggle-status" data-id="{{ $customer->id }}"
                                                {{ $customer->status == 0 ? 'checked' : '' }} data-toggle="switch"
                                                data-on-text="Enabled" data-off-text="Disabled" data-on-color="success"
                                                data-off-color="danger" role="switch">
                                        </td>
                                        <td class="text-center">{{ $customer->company }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-info"
                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                <a data-href="{{ route('customer.destroy', $customer->id) }}"
                                                    class="btn btn-danger delete" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function() {
            var datatable = $('#dataTable1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [
                    [0, "asc"]
                ]
            });

            $('.toggle-status').bootstrapSwitch({
                size: 'small',
                onSwitchChange: function(event, state) {
                    var id = $(this).data('id');
                    toggleStatus(id, state);
                }
            });

            $('#dataTable1').on('click', '.delete', function(e) {
                e.preventDefault();
                var row = datatable.rows($(this).parents('tr'));
                var url = $(this).data('href');
                deleteItem(row, url);
            });


            function toggleStatus(id, state) {
                var status = state ? 0 : 1;
                $.ajax({
                    url: 'customers/' + id + '/toggle-status',
                    method: 'PUT',
                    data: {
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success('Customer status updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating customer status:', error);
                        toastr.error('Failed to update customer status. Please try again.');
                    }
                });
            }

            function deleteItem(row, url) {
                if (confirm('Are you sure you want to remove this customer?')) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            location.reload();
                            row.remove().draw();
                            toastr.success('Customer deleted successfully.');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting customer:', error);
                            toastr.error('Failed to delete customer. Please try again.');
                        }
                    });
                }
            }

        });
    </script>
@endpush
