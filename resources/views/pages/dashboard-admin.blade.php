@extends('layouts.navbar.sidebar')

@section('head')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
<link href="/css/Style.css" rel="stylesheet" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    td {
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Member List'])
<div class="container">
    <CENTER>
        <img style="width: 400px; margin-top: -50px;" src="https://themesbrand.com/skote-mvc/layouts/assets/images/profile-img.png" alt="Draft Image" class="img-draft">
    </CENTER>
    <div class="card mb-4">
        <center>
            <h5 class="mt-3 mb-3" style="color: #707070;">User List</h5>
            <a href="{{ route('register') }}" class="btn btn-rounded btnGreen rubik-font p-2">Add New User</a>
        </center>
    <div class="card-body px-3 pt-0 pb-3">

        <table id="userTable" class="table display">
            <thead class="text-white" style="background-color: #707070;">
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Status</th>
                    <th>Role</th>
                    <th>A</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->us_ID }}</td>
                        <td>{{ $user->us_name }}</td>
                        <td>{{ $user->us_username }}</td>
                        <td>{{ $user->us_email }}</td>
                        <td>{{ $user->us_stat }}</td>
                        <td>{{ $user->userGroup->grp_name }}</td>
                        <td style="vertical-align: middle;">
                            <button class="btn btn-secondary edit-user-btn" style="" data-bs-toggle="modal" data-bs-target="#edit-user" data-user-id="{{ $user->us_ID }}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger delete-user text-white" data-user-id="{{ $user->us_ID }}"><i class="fa fa-trash"></i></button>
                        </td>                   
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @include('layouts.footer.footer')
</div>

            {{-- @*Modal Edit User*@ --}}
            <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label class="col-form-label">Employee ID </label>
                                    <input type="text" class="form-control activity-input" id="us_ID" style="font-size: 13px;" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Name </label>
                                    <input type="text" class="form-control activity-input" id="us_name" style="font-size: 13px;" />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Username </label>
                                    <input type="text" class="form-control activity-input" id="us_username" style="font-size: 13px;" />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email </label>
                                    <input type="text" class="form-control activity-input" id="us_email" style="font-size: 13px;" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">User Status </label>
                                    <select class="form-select fix-section" id="us_stat" required>
                                        <option selected disabled></option>
                                        <option value="I">I</option>
                                        <option value="A">A</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Role </label>
                                    <select class="form-select" id="grp_ID">
                                        <option selected disabled></option>
                                        <option value="1">Super User</option>
                                        <option value="2">Guest</option>
                                        <option value="3">Product Engineer</option>
                                        <option value="4">Product Designer</option>
                                        <option value="5">Quality Engineer</option>
                                        <option value="6">Product Costing</option>
                                        <option value="7">Product Packaging</option>
                                        <option value="8">Textile Engineer</option>
                                        <option value="9">Soft Goods Textile Engineer</option>
                                        <option value="10">Soft Goods Developer</option>
                                        <option value="11">Creative</option>
                                        <option value="12">Production Team</option>
                                        <option value="13">Sewing Machine Operator</option>
                                        <option value="14">Logistic Coordinator</option>
                                        <option value="15">Inventory</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary update-user" id="update-user">Save change</button>
                        </div>
                    </div>
                </div>
            </div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script src="/js/moment.js"></script>

<script>
    $(document).ready(function () {

        $('#userTable').DataTable({
            paging: true,
            searching: true,
            "language": {
                "paginate": {
                    "previous": '<i class="fa fa-angle-left text-center" style="margin-top: 7px;"></i>',
                    "next": '<i class="fa fa-angle-right text-center" style="margin-top: 7px;"></i>',
                },
                "search": "",
                "searchPlaceholder": "Search"
            },
            ordering: true,
            info: true,
            responsive: true,
            fixedHeader: {
                header: true,
                footer: false
            },
        });

        $('#update-user').click(function() {
            var userID = $('#us_ID').val();
            var name = $('#us_name').val();
            var username = $('#us_username').val();
            var email = $('#us_email').val();
            var status = $('#us_stat').val();
            var role = $('#grp_ID').val();

            // Send updated user data using AJAX
            $.ajax({
                type: 'POST',
                url: '/update-user/' + userID,
                data: {
                    _token: '{{ csrf_token() }}',
                    us_name: name,
                    us_username: username,
                    us_stat: status,
                    grp_ID: role
                },
                success: function(response) {
                    console.log('User data updated:', response);
                    Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'User data updated successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    $('#edit-user').modal('hide');
                    location.reload();
                },
                error: function(err) {
                    console.error('Error updating user data:', err);
                    // Handle the error here
                }
            });
        });
        
        $(document).on('click', '.delete-user', function () {
            const userID = $(this).data('user-id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success text-white",
                    cancelButton: "btn btn-danger text-white mr-2"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "Your data will be gone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/delete-user/' + userID,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'ID: ' + userID + '" deleted successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            } else {
                                console.log('Deletion failed.');
                            }
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            console.log('Error: ' + textStatus);
                            console.log('Error details: ' + errorThrown);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled (˶' ᵕ '˶)",
                        text: "User is not deleted.",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#userTable').on('click', '.edit-user-btn', function() {
            var userID = $(this).data('user-id');

            // Fetch user data using AJAX
            $.ajax({
                type: 'GET',
                url: '/get-user/' + userID, // Replace with your endpoint to fetch user data
                success: function(response) {
                    // Populate modal fields with the retrieved user data
                    $('#us_ID').val(response.us_ID);
                    $('#us_name').val(response.us_name);
                    $('#us_username').val(response.us_username);
                    $('#us_email').val(response.us_email);
                    $('#us_stat').val(response.us_stat);
                    $('#grp_ID').val(response.grp_ID);
                },
                error: function(err) {
                    console.error('Error fetching user data:', err);
                }
            });
        });
    });
</script>


@endsection