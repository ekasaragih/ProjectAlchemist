@extends('layouts.navbar.sidebar')

@section('head')
<style>
    .badge {
    display: inline-block;
    padding: 0.25em 0.5em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #fff;
    }

    .badge-soft-warning {
        color: #f1b44c;
        background-color: rgba(241,180,76,.18);
    }

    .badge-success {
        background-color: #2dce89;
        color: #fff;
    }

    .badge-soft-success {
        color: #34c38f;
        background-color: rgba(52,195,143,.18);
    }

    .badge-warn-subtle {
        color: #e9bc18;
        background-color: #fcf5dc;
    }

    .badge-info-subtle {
        color: #179faa;
        background-color: #dcf1f2;
    }

    .badge-secondary-subtle {
        color: #438eff;
        background-color: #e3eeff;
    }

    .badge-primary-subtle {
        color: #5a58eb;
        background-color: #e6e6fc;
    }

    .badge-danger-subtle {
        color: #f9554c;
        background-color: #fee6e4;
    }

    .rounded-pill {
        border-radius: 50rem;
    }

    .d-inline {
        display: inline;
    }
</style>
@endsection

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Project Dropped'])
<div class="container">
    <CENTER>
        <img style="width: 400px; margin-top: -50px;" src="https://themesbrand.com/skote-mvc/layouts/assets/images/profile-img.png" alt="Draft Image" class="img-draft">
    </CENTER>
    <div class="card mb-4">
        <center>
            <h5 class="mt-3" style="color: #707070;">Project Dropped</h5>
            <br>
            
        </center>
    <div class="card-body px-3 pt-0 pb-3">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script src="/js/moment.js"></script>
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

                           var draftProjects = projects.filter(function (project) {
                               return project.Status === 'Drop';
                           });

                           draftProjects.forEach(function (project) {
                           var row = '<tr>' +
                               '<td>' + project.CreatedAt + '</td>' +
                               '<td>' + (project.ProjectNumber ? project.ProjectNumber.toUpperCase() : '') + '</td>' +
                               '<td>' + (project.ProdNum ? project.ProdNum.toUpperCase() : '') + '</td>' +
                               '<td>' + project.ProdDesc + '</td>' +
                               '<td>' + project.Categories + '</td>' +
                               '<td>' + project.ProductEngineer + '</td>' +
                               '<td>' + project.Status + '</td>' +
                               '<td>' + (project.FPRMeetDate ? moment(project.FPRMeetDate).format('MM-DD-YY') : '') + '</td>' +
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
                               order: [
                                   [0, 'desc']
                               ],
                               columns: [{
                                       data: 'CreatedAt',
                                       title: 'Created At',
                                       visible: false
                                   },
                                   {
                                       data: 'ProjectNumber',
                                       title: 'Project #'
                                   },
                                   {
                                       data: 'ProdNum',
                                       title: 'Product #'
                                   },
                                   {
                                       data: 'ProdDesc',
                                       title: 'Product'
                                   },
                                   {
                                       data: 'Categories',
                                       title: 'Categories'
                                   },
                                   {
                                       data: 'ProductEngineer',
                                       title: 'Product Eng'
                                   },
                                   {
                                       data: 'Status',
                                       title: 'Status',
                                       render: function(data, type, row) {
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
                                   {
                                       data: 'FPRMeetDate',
                                       title: 'FPR',
                                       render: function(data, type, row) {
                                           return data ? data : '';
                                       }
                                   },
                                   {
                                        data: null,
                                        title: 'Action',
                                        render: function(data, type, row) {
                                            var buttonHtml = '<a style="margin-right: 5px;" class="btn btn-primary text-white" title="See Project Detail" href="/project-detail/' + row.ProjectNumber + '"><i class="fa fa-search"></i></a>' +
                                                '<button class="btn btn-danger btn-prelim text-white" title="Project Update to Preliminary" data-id="' + row.ProjectNumber + '"><i class="fa fa-level-up" aria-hidden="true"></i></button>';
                                            
                                            return buttonHtml;
                                        }
                                    }

                               ]
                           });

                       } else {
                           dataTable.clear().draw();
                       }
                       },
                       error: function(xhr, status, error) {
                       console.log("Error:", error);
                       alert('Error loading project table. See console for details.');
                       }
                       });
                       }

                       loadProjectTable();
                       });
</script>

{{-- Update project to Preliminary --}}
<script>
     $(document).ready(function () {

        $(document).on('click', '.btn-prelim', function() {

            var projNum = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to update the project into 'Preliminary' ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("prelim_project") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: { projNum: projNum },
                        success: function(response) {
                            console.log('Project status updated to Preliminary for project number: ' + projNum);
                           
                            Swal.fire({
                                title: "Updated!",
                                text: "Your project status has been updated.",
                                icon: "success"
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating project status:', error);
                        }
                    });

                  
                }
            });
        
        });

     });
</script>


@endsection