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
@include('layouts.navbar.topnav', ['title' => 'Dashboard'])
    <div class="container">
        <div class="row">
            <div class="card" style="background-color: #CBE2C9;">
                <div class="card-body" style="padding: 5px;">
                    <div class="row">
                  <div class="col-sm-3">
                    <img src="./img/elemen1.png" height="200" alt="main_logo">
                  </div>
                  <div class="col-sm-5 p-5 pb-3">
                    @auth
                        @if(isset($userName))
                            @if($userName === 'Super User')
                                <h6>Hello, <i>{{ $userName }}!</i></h6>
                                <p>Welcome to Project Alchemist! You have admin privileges.</p>
                                <span><a href="{{ route('dashboard_admin') }}" class="btn btn-secondary">User List</a></span>
                            @else
                                <h6>Hello, <i>{{ $userName }}!</i></h6>
                                <p>Welcome to Project Alchemist! Don’t forget to track and update your project.</p>
                                <span><a href="{{ route('add_new_project') }}" class="btn btn-secondary">Add New Project</a></span>
                                <span><a href="{{ route('project_list') }}" class="btn btn-secondary">Project List</a></span>
                            @endif
                        @else
                            <!-- Handle case where $userName is not set -->
                            <h6>Hello, User!</h6>
                            <p>Welcome to Project Alchemist! Please log in.</p>
                            <span><a href="{{ route('login') }}" class="btn btn-secondary">Login</a></span>
                        @endif
                    @endauth
                </div>                           
                </div>
                </div>
              </div>
        </div>

        {{-- Total Project - Project In Progress - Project Draft - Project Completed --}}
        <div class="row">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Project Preview</h5>
                    <div class="row">
                        <div class="col">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('project_list') }}" class="text-white">Total Project</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $totalProjects }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('project_draft') }}" class="text-white">In Draft</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $projectsDraft }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('schedule_view') }}" class="text-white">In Progress</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $projectsInProgress }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('project_complete') }}" class="text-white">Completed</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $projectsCompleted }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories Review --}}
        <div class="row">
            <div class="card mt-4">
                <div class="card-body">
                <h5 class="card-title mb-4">Category Review</h5>
                    <div class="row">
                        <div class="col">
                            <div class="card bg-secondary bg-opacity-50">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-white">Upper Body Clothing</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $upperBodyClothingCount }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col">
                            <div class="card bg-secondary bg-opacity-50">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-white">Lower Body Clothing</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $lowerBodyClothingCount }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card bg-secondary bg-opacity-50">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-white">Undergarments</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $undergarmentsCount }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                </div>
                            </div>
                        </div>
                    
                        <div class="col">
                            <div class="card bg-secondary bg-opacity-50">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-white">Swimwear</a></h5>
                                    <h1 class="card-text text-center text-primary p-5">{{ $swimwearCount }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lead Time Table - Progress Bar --}}
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <h4 class="card-header text-center" style="color: #707070;">
                        Project Lead Time
                        <hr class="bg-dark">
                      </h4>
                      
                {{-- Table for Project Draft --}}
                    <div>
                        <div class="card-body px-3 pt-2 pb-3">
                            <div class="table-responsive p-0">
                                <table id="ltTable" class="display table">
                                    <thead class="text-white bg-primary"></thead>
                                    <tbody id="ltTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5">Summary</h5>
                        <div class="mb-5">
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentComplete }}%" aria-valuenow="{{ $percentComplete }}" aria-valuemin="0" aria-valuemax="100">{{ $percentComplete }}%</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percentOnGoing }}%" aria-valuenow="{{ $percentOnGoing }}" aria-valuemin="0" aria-valuemax="100">{{ $percentOnGoing }}%</div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentDraft }}%" aria-valuenow="{{ $percentDraft }}" aria-valuemin="0" aria-valuemax="100">{{ $percentDraft }}%</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percentDrop }}%" aria-valuenow="{{ $percentDrop }}" aria-valuemin="0" aria-valuemax="100">{{ $percentDrop }}%</div>
                            </div>                            
                        </div>

                        <div class="mt-5 ml-5 mb-2">
                            <p class="badge rounded-pill bg-success">Complete</p> <br>
                            <p class="badge rounded-pill bg-info text-dark">On-going</p> <br>
                            <p class="badge rounded-pill bg-warning text-white">Draft</p> <br>
                            <p class="badge rounded-pill bg-danger">Drop</p> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Project Draft --}}
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="mb-4">
                    <center>
                    <iframe src="https://giphy.com/embed/13nsB5xdeepzdS" style="padding: 10px; pointer-events: none;" width="315" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                    </center>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                        <div class="card-header text-danger">
                            <b><i class="fa fa-calendar-check-o text-dark" aria-hidden="true"></i></b>
                            Check your in <a href="{{ route("project_draft") }}" class="text-danger"><i><u>Draft</u></i></a> project.
                            <hr class="bg-dark">
                        </div>
                        
                    {{-- Table for Project Draft --}}
                    <div>
                        <center>
                            <h5 style="color: #707070;">My Draft</h5>
                        </center>
                        <div class="card-body px-3 pt-2 pb-3">
                            <div class="table-responsive p-0">
                                <table id="projectTable" class="display">
                                    <thead class="text-white" style="background-color: #707070;"></thead>
                                    <tbody id="projectTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footer.footer')
    </div>

        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="/js/moment.js"></script>

    {{-- Datatable project draft --}}
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
                                   return project.Status === 'Draft';
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

    {{-- Datatable project lead time --}}
    <script>	
        $(document).ready( function () {
        var dataTable;

        function loadProjectTable() {
                    $.ajax({
                        url: '{{ route("getAllProjects") }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function (projects) {
                            
                            var tableBody = $('#ltTableBody');
                            tableBody.empty();

                            projects.forEach(function (project) {
                            var row = '<tr>' +
                                    '<td>' + project.CreatedAt + '</td>' +
                                    '<td>' + (project.ProjectNumber ? project.ProjectNumber.toUpperCase() : '') + '</td>' +
                                    '<td>' + (project.ProdNum ? project.ProdNum.toUpperCase() : '') + '</td>' +
                                    '<td>' + project.ProdDesc + '</td>' +
                                    '<td>' + (isValidDate(project.DSPFDate) ? moment(project.DSPFDate).format('MM-DD-YY') : '') + '</td>' +
                                    '<td>' + (isValidDate(project.FPRMeetDate) ? moment(project.FPRMeetDate).format('MM-DD-YY') : '') + '</td>' +
                                    '<td></td>' +
                                    '</tr>';
                            tableBody.append(row);
                        });

                        function isValidDate(date) {
                                return date && moment(date, moment.ISO_8601, true).isValid();
                            }

                            if (!dataTable) {
                                dataTable = $('#ltTable').DataTable({
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
                                                {
                                                    data: 'DSPFDate',
                                                    title: 'DSP (F)',
                                                    render: function(data, type, row) {
                                                        return data ? data : '';
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
                                                    title: 'LT',
                                                    render: function (data, type, row) {
                                                        var dspDate = moment(row.DSPFDate, 'MM-DD-YY');
                                                        var fprDate = moment(row.FPRMeetDate, 'MM-DD-YY');
                                                        
                                                        if (dspDate.isValid() && fprDate.isValid()) {
                                                            var weeksDifference = fprDate.diff(dspDate, 'weeks', true);
                                                            var formattedDifference = Math.ceil(weeksDifference) >= 0 ? Math.ceil(weeksDifference) + ' weeks' : '';
                                                            return formattedDifference;
                                                        } else {
                                                            return '';
                                                        }
                                                    }
                                                }
                                            ],
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
