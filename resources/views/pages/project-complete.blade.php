@extends('layouts.navbar.sidebar')

{{-- @section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@endsection --}}

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Project Complete'])
<div class="container">
    <CENTER>
        <img style="width: 400px; margin-top: -50px;" src="https://themesbrand.com/skote-mvc/layouts/assets/images/profile-img.png" alt="Draft Image" class="img-draft">
    </CENTER>
    <div class="card mb-4">
        <center>
            <h5 class="mt-3" style="color: #707070;">Project List</h5>
            <br>
            <div>
                <a href="{{ route('addnewproject') }}" class="btn btn-rounded btnPurple rubik-font">Add New Project</a>
                <a href="{{ route('scheduleview') }}" class="btn btn-rounded btnPurple rubik-font" style="margin-left: 5px;">Schedule View</a>
            </div>
        </center>
    <div class="card-body px-3 pt-0 pb-3">
        <p>
            <div class="row rubik-font">
                <div class="col-3">
                    <div>
                        <span id="statusFilterPlaceholder"></span>
                    </div>
                </div>
            </div>
        </p>

        <table id="projectTable" class="display">
            <thead class="text-white" style="background-color: #707070;"></thead>
            <tbody id="projectTableBody"></tbody>
        </table>
    </div>
    </div>
    @include('layouts.footer.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>	
     $(document).ready( function () {
        var dataTable;

        function loadProjectTable() {
                    $.ajax({
                        url: '{{ route("getAllProjects") }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function (projects) {
                            
                            var tableBody = $('#projectTableBody');
                            tableBody.empty();

                            projects.forEach(function (project) {
                            var row = '<tr>' +
                                '<td>' + project.CreatedAt + '</td>' +
                                '<td>' + project.ProjectNumber + '</td>' +
                                '<td>' + project.ProdNum + '</td>' +
                                '<td>' + project.ProdDesc + '</td>' +
                                '<td>' + project.Categories + '</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });

        if (!dataTable) {
            dataTable = $('#projectTable').DataTable({
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
                order: [[0, 'desc']],
                columns: [
                            { data: 'CreatedAt', title: 'Created At', visible: false },
                            { data: 'ProjectNumber', title: 'Project #' },
                            { data: 'ProdNum', title: 'Product #' },
                            { data: 'ProdDesc', title: 'Product' },
                            { data: 'Categories', title: 'Categories' },
                            { title: 'Product Eng' },
                            { title: 'Status',
                                            render: function (data, type, row) {
                                                if (data === 'Draft') {
                                                    return '<span class="badge badge-soft-warning rounded-pill d-inline">' + data + '</span>';
                                                } else if (data === 'Ongoing') {
                                                    return '<span class="badge badge-soft-success rounded-pill d-inline">' + data + '</span>';
                                                } else if (data === 'Preliminary' || data === 'BOM Input' || data === 'Prep 1st Cost' || data === '1st Cost') {
                                                    return '<span class="badge badge-primary-subtle rounded-pill d-inline">' + data + '</span>';
                                                } else if (data === 'CR Cost Done' || data === 'FPR Cost Done') {
                                                    return '<span class="badge badge-success rounded-pill d-inline">' + data + '</span>';
                                                } else if (data === 'Prep CR Model' || data === 'Prep FPR Model') {
                                                    return '<span class="badge badge-warn-subtle rounded-pill d-inline">' + data + '</span>';
                                                } else if (data === 'CR Approval' || data === 'FPR Approval') {
                                                    return '<span class="badge badge-secondary-subtle rounded-pill d-inline">' + data + '</span>';
                                                } else if (data === 'CR Approved' || data === 'FPR Approved' || data === 'CR/FPR Approved') {
                                                    return '<span class="badge badge-info-subtle rounded-pill d-inline">' + data + '</span>';
                                                } else if (data === 'Drop' || data === 'Change Source' || data === 'Re-ICR') {
                                                    return '<span class="badge badge-danger-subtle rounded-pill d-inline">' + data + '</span>';
                                                } else {
                                                    return data;
                                                }
                                            }
                                        },
                            {  title: 'Packaging Date' },
                            // {
                            //     data: null,
                            //     title: 'Action',
                            //     render: function (data, type, row) {
                            //         var isDraft = row.Status === 'Draft';
                            //         var dropdownHtml = '<span>' +
                            //             '<div class="dropdown">' +
                            //             '<button class="btn btn-primary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            //             '<i class="fa fa-ellipsis-v"></i>' +
                            //             '</button>' +
                            //             '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                    
                            //         if (isDraft) {
                            //             dropdownHtml += '<a class="dropdown-item" href="' + '@Url.Action("EditProjects", "ProjectSchedulers")' + '?projNum=' + row.ProjectNumber + '">' +
                            //                 '<i class="fa fa-pencil" style="margin-right: 5px;"></i> Update' +
                            //                 '</a>';
                            //         } else {
                            //             dropdownHtml += '<a class="dropdown-item" href="' + '@Url.Action("ProjectDetail", "ProjectSchedulers")' + '?projNum=' + row.ProjectNumber + '">' +
                            //                 '<i class="fa fa-info-circle" style="margin-right: 5px;"></i> Detail' +
                            //                 '</a>';
                            //         }

                            //         dropdownHtml += '</div>' +
                            //             '</div>' +
                            //             '</span>';

                            //         return dropdownHtml;
                            //     }
                            // }
                            {
                                data: null,
                                title: 'Action',
                                render: function (data, type, row) {
                                    var dropdownHtml = '<span>' +
                                        '<div class="dropdown">' +
                                        '<button class="btn btn-primary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                        '<i class="fa fa-ellipsis-v"></i>' +
                                        '</button>' +
                                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' +
                                        '<a class="dropdown-item" href="' + '' + '?projNum=' + row.ProjectNumber + '">' +
                                        '<i class="fa fa-pencil" style="margin-right: 5px;"></i> Update' +
                                        '</a>' +
                                        '</div>' +
                                        '</div>' +
                                        '</span>';

                                    return dropdownHtml;
                                }
                            }

                        ],
                        initComplete: function () {
                                        this.api().columns("6").every(function () {
                                            var column = this;
                                            var select = $('<select class="form-select form-select-lg"><option value="">All Status</option></select>')
                                                .appendTo($('#statusFilterPlaceholder'))
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                });

                                            column.data().unique().sort().each(function (d) {
                                                select.append($('<option></option>').attr('value', d).text(d));
                                            });
                                        });
                                    },
                    });
           
                            } else {
                                dataTable.clear().draw();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("Error:", error);
                            alert('Error loading project table. See console for details.');
                        }
                    });
                }

                loadProjectTable();
    });
</script>
@endsection