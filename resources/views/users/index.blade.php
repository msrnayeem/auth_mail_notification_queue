@extends('dashboard')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
@endpush

@section('content')
<div class="row justify-content-center">
  <div class="col-12">
    <div class="card">

      <div class="card-header">
        <h2 class="card-title">All Users</h2>
      </div>
       <!-- /.card-header -->
        <div class="card-body">
            <form id="user-form"  action="{{ route('submit-selected-users') }}" method="post"> 
                @csrf <input type="hidden" name="selectedUserIds" id="selectedUserIds">
            <div class="table-responsive">
                <div class="mt-2 mb-4">
                    <div>
                        <input type="button" id="mark-unmark-all" class="btn btn-primary btn-sm" value="mark/unmark"/>
                        <button type="submit" class="btn btn-success btn-sm" id="submit-selected">Submit</button>
                    </div>
                </div>
                <table id="users-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </form>
        </div>
    <!-- /.card-body -->
    </div>
  <!-- /.card -->
  </div>
<!-- /.col -->
</div>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

<script>
$(document).ready(function () {
    var table =  $('#users-table').DataTable({
      responsive: true,
      select: true,
      fixedHeader: true,
      lengthMenu: [[7, 10, 25, 50, -1], [7, 10, 25, 50, "All"]],
      columnDefs: [
        { orderable: false, targets: 3 }
      ]
    });

    var selectedUserIds = ''; // Comma-separated list of selected user IDs

    $('#mark-unmark-all').click(function () {
      var selectedRows = table.rows({ selected: true }).indexes();
      if (selectedRows.length === table.data().length) {
        table.rows().deselect();
      } else {
        table.rows().select();
      }
    });

    $('#submit-selected').click(function (e) {
      e.preventDefault();
        var selectedUserIds = [];
        table.rows('.selected').data().each(function (dataRow) {
            selectedUserIds.push(dataRow[2]); // Assuming the user ID is in the first column
        });

        console.log('Selected User IDs:', selectedUserIds);
        $('#selectedUserIds').val(selectedUserIds.join(','));

        // Submit the form
        $('#user-form').submit();

    });
});

</script>
@endpush
