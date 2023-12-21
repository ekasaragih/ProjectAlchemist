@extends('layouts.navbar.sidebar')

@section('head')
<head>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
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
        table.dataTable tbody tr:last-child td.toy-num-column {
            border-right: 1px solid #000; /* Adjust border style as needed */
        }

        button.check,
        button.cancel,
        button.actualized,
        button.cosi-cancel,
        button.cosi-check,
        button.la-cancel,
        button.la-check {
            display: none;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        td {
            border-color: transparent;
            vertical-align: middle;
        }
    </style>
</head>
@endsection

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Schedule View'])
<div class="container">
    
    <center>
        <div class="text-center">
            <iframe src="https://giphy.com/embed/Y1IFN5kK9E7fO" style="pointer-events: none; margin-bottom: -30px; margin-top: -70px;" width="250" height="200" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
        </div>
    </center>

    <div class="card mb-4">
        <CENTER>
            <h2 class="mt-3" style="color: #306844;"><b>Project Schedule</b></h2>
            <p>
    
                <a href="{{ route('add_new_project') }}" class="btn btn-rounded btnPurple rubik-font ml-2 p-3">Add New Project</a>
    
            </p>
        </CENTER>
        <div class="card-body px-3 pt-0 pb-3">
            <p>
                <div class="row rubik-font">
                    <div class="col-3">
                        <div>
                            <span id="statusFilterPlaceholder"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div>
                            <span id="AllPE"></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div>
                            <span id="AllBrand"></span>
                        </div>
                    </div>
                </div>
            </p>
    
            <br />
    
            <div class="table-responsive p-0 rubik-font">
                <table id="projectTable" class="display table table-bordered">
                    <thead class="text-white bg-secondary" style="">
                        <tr>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center" title="Action">A</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">Project #</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">Prod #</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">Desc</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">Category</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">LA</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">LA Commit</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">PE</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">DSP (S)</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">Kick Off</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">Fitting <br /> Submission</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">DSP (F)</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">BOM Input</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">1st Cost <br /> Internal</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">1st Cost <br /> Ext</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">CR Cost <br /> Done</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">CR Sample <br /> Avail</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">CR Meeting</th>
                            <th colspan="2" rowspan="2" style="vertical-align: middle;" class="text-center">FPR Meeting</th>
                            <th colspan="7" rowspan="1" style="vertical-align: middle;" class="text-center">Tooling Activities</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">Status</th>
                            <th rowspan="3" style="vertical-align: middle;" class="text-center">Cost Iteration</th>
                        </tr>
    
                        <tr>
                            <th colspan="1" rowspan="2" style="vertical-align: middle;" class="text-center">CDI</th>
                            <th colspan="1" rowspan="2" style="vertical-align: middle;" class="text-center">1st Digital Review</th>
                            <th colspan="1" rowspan="2" style="vertical-align: middle;" class="text-center">3D Approved</th>
                            <th colspan="1" rowspan="2" style="vertical-align: middle;" class="text-center">CR Model Output</th>
                            <th colspan="1" rowspan="2" style="vertical-align: middle;" class="text-center">CR Sample Send</th>
                            <th colspan="1" rowspan="2" style="vertical-align: middle;" class="text-center">FPG (S)</th>
                            <th colspan="1" rowspan="2" style="vertical-align: middle;" class="text-center">FPG (F)</th>
                        </tr>
    
                        <tr>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
    
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
                        </tr>
                    </thead>
                    <tbody id="projectTableBody" class="border border-dark">

                        @foreach($projects as $project)
                            <tr class="project-row">
                                <td>
                                    <a style="margin-bottom: 0px; background-color: #FFE5F1; color: #E2328B;" class="btn" title="See Project Detail" href="{{ route('project_detail', ['projNum' => $project->ProjectNumber]) }}">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>{{ strtoupper($project->ProjectNumber) }}</td>
                                <td>{{ strtoupper($project->ProdNum) }}</td>                                
                                <td>{{ $project->Desc }}</td>
                                <td>{{ $project->Categories }}</td>
                                <td>{{ $project->LA }}</td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'Launch Avail_act'} ?? '' }}" data-act-name="Launch Avail" data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn la-check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn la-cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                </td>
                                <td>{{ $project->ProductEngineer ?? '' }}</td>
                                <td style="color: #000; background-color: {{ $project->{'DSP Start (turnover to Plant)_sch'} ? '#FCBEBE' : '#F5F5F5' }};">
                                    {{ $project->{'DSP Start (turnover to Plant)_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'KO Meeting_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'KO Meeting_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'Fitting Submission_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'Fitting Submission_sch'} ?? '' }}
                                </td>                                
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'Fitting Submission_act'} ?? '' }}" data-act-name="Fitting Submission" data-actlzd="{{ $project->{'Fitting Submission_actlzd'} ?? '' }}"  data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'DSP Finish (Control Drawing & Artwork Complete)_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'DSP Finish (Control Drawing & Artwork Complete)_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'DSP Finish (Control Drawing & Artwork Complete)_act'} ?? '' }}" data-act-name="DSP Finish (Control Drawing & Artwork Complete)" data-actlzd="{{ $project->{'DSP Finish (Control Drawing & Artwork Complete)_actlzd'} ?? '' }}" data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'BOM Input_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'BOM Input_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'BOM Input_act'} ?? '' }}" data-act-name="BOM Input" data-actlzd="{{ $project->{'BOM Input_actlzd'} ?? '' }}" data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'1st Cost Internal_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'1st Cost Internal_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'1st Cost Internal_act'} ?? '' }}" data-act-name="1st Cost Internal" data-actlzd="{{ $project->{'1st Cost Internal_actlzd'} ?? '' }}"  data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'1st Cost External_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'1st Cost External_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'1st Cost External_act'} ?? '' }}" data-act-name="1st Cost External" data-actlzd="{{ $project->{'1st Cost External_actlzd'} ?? '' }}"  data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'CR Cost Done_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'CR Cost Done_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'CR Cost Done_act'} ?? '' }}" data-act-name="CR Cost Done" data-actlzd="{{ $project->{'CR Cost Done_actlzd'} ?? '' }}" data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'CR Model Ready_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'CR Model Ready_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'CR Model Ready_act'} ?? '' }}" data-act-name="CR Model Ready" data-actlzd="{{ $project->{'CR Model Ready_actlzd'} ?? '' }}" data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'CR Meeting_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'CR Meeting_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'CR Meeting_act'} ?? '' }}" data-act-name="CR Meeting" data-actlzd="{{ $project->{'CR Meeting_actlzd'} ?? '' }}" data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>
                                <td style="background-color: {{ $project->{'FPR Meeting_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'FPR Meeting_sch'} ?? '' }}
                                </td>
                                <td>
                                    <input type="date" class="form-control activity-input" value="{{ $project->{'FPR Meeting_act'} ?? '' }}" data-act-name="FPR Meeting" data-actlzd="{{ $project->{'FPR Meeting_actlzd'} ?? '' }}" data-project-number="{{ $project->ProjectNumber }}" />
                                    <button class="btn check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                    <button class="btn cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                </td>

                                {{-- Tooling Activities --}}
                                <td style="background-color: {{ $project->{'CDI_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'CDI_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'1st Digital Review_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'1st Digital Review_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'Approved Digital_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'Approved Digital_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'Output Model_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'Output Model_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'Sample Ready to Sent_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'Sample Ready to Sent_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'Final Part Geometry Start_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'Final Part Geometry Start_sch'} ?? '' }}
                                </td>
                                <td style="background-color: {{ $project->{'Final Part Geometry Finish_sch'} ? '#FFE5F1' : '#F5F5F5' }};">
                                    {{ $project->{'Final Part Geometry Finish_sch'} ?? '' }}
                                </td>
                                
                                <td>
                                    @php
                                        $status = $project->Status;
                                    @endphp
                                
                                    @if ($status == "Preliminary" || $status == "1st Cost" || $status == "Prep 1st Cost")
                                        <span class="badge badge-primary-subtle rounded-pill d-inline">{{ $status }}</span>
                                    @elseif ($status == "1st Cost CR" || $status == "FPR Cost")
                                        <span class="badge badge-secondary-subtle rounded-pill d-inline">{{ $status }}</span>
                                    @elseif ($status == "CR Approval" || $status == "FPR Approval" || $status == "CR Cost Done" || $status == "FPR Cost Done")
                                        <span class="badge badge-success rounded-pill d-inline">{{ $status }}</span>
                                    @elseif ($status == "Prep CR Model" || $status == "Prep FPR Model")
                                        <span class="badge badge-warn-subtle rounded-pill d-inline">{{ $status }}</span>
                                    @elseif ($status == "Drop" || $status == "Change Source" || $status == "Re-ICR/Re-Design")
                                        <span class="badge badge-danger-subtle rounded-pill d-inline">{{ $status }}</span>
                                    @elseif ($status == "CR Approved" || $status == "FPR Approved" || $status == "CR/FPR Approved")
                                        <span class="badge badge-info-subtle rounded-pill d-inline">{{ $status }}</span>
                                    @else
                                        {{ $status }}
                                    @endif
                                </td>
                                
                                <td>
                                    @if ($project->CostIteration !== null)
                                        {{ $project->CostIteration }}
                                    @else
                                        <input type="number" class="form-control cost-iteration" data-project-number="{{ $project->ProjectNumber }}" />
                                        <button class="btn cosi-check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                        <button class="btn cosi-cancel mt-1"><i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="/js/moment.js"></script>

    {{-- @*Function to disable the input if data already actualized*@ --}}
    <script>
        // Function to disable the input if date is already actualized
        function disableActualizedActivities() {
            $('.activity-input').each(function () {
                var inputElement = $(this);
                var actualized = inputElement.data('actlzd');
    
                console.log(actualized);
                if (actualized === 'A') {
                    inputElement.prop('disabled', true);
                    inputElement.nextAll('.check, .cancel').hide();
                    inputElement.next('.actualized').show();
                }
            });
        }
    
        $(document).ready(function () {
            disableActualizedActivities();
        });
    </script>

    {{-- @*Function to make table with datatable*@ --}}
    <script>
        $(document).ready(function () {

            $('#select2').select2()

            $('#projectTable').DataTable({
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
                scrollCollapse: true,
                scrollX: true,
                fixedColumns: {
                    left: 4
                },
                fixedHeader: {
                    header: true,
                    footer: false
                },
                initComplete: function () {
                    var statusColumnIndex = 35;

                    var statusOptions = [
                        "Preliminary", "1st Cost", "Prep 1st Cost",
                        "1st Cost CR", "FPR Cost", "CR Approval", "FPR Approval",
                        "CR Cost Done", "FPR Cost Done", "Prep CR Model", "Prep FPR Model",
                        "Drop", "Change Source", "Re-ICR/Re-Design",
                        "CR Approved", "FPR Approved", "CR/FPR Approved"
                    ];

                    this.api().column(statusColumnIndex).every(function () {
                        var column = this;
                        var select = $('<select class="form-select form-select-lg"><option value="">All Status</option></select>')
                            .appendTo($('#statusFilterPlaceholder'))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        statusOptions.forEach(function (status) {
                            select.append($('<option></option>').attr('value', status).text(status));
                        });
                    });
                    this.api().columns("7").every(function () {
                        var column = this;
                        var select = $('<select class="form-select form-select-lg"><option value="">All PE</option></select>')
                            .appendTo($('#AllPE'))
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

        });
    </script>

    {{-- Function to post actual date, actualized date, and cost iteration --}}
    <script>
        $(document).ready(function() {
            $(document).on('focus', '.activity-input', function() {
                $(this).nextAll('button.check, button.cancel, button.actualized, button.la-check, button.la-cancel').show();
            });

            $(document).on('click', function(event) {
                var target = $(event.target);
                if (!target.hasClass('activity-input') && !target.is('button.check') && !target.is('button.cancel') && !target.is('button.actualized') && !target.is('button.la-check') && !target.is('button.la-cancel')) {
                    $('button.check, button.cancel, button.actualized, button.la-check, button.la-cancel').hide();
                }
            });

            //Add an event listener for the "keydown" event on date input fields
            $(document).on('keydown', 'input[type="date"]', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // Prevent the default behavior (form submission)
                    var inputElement = $(this);
                    var actualDate = inputElement.val();
                    var actName = inputElement.data('act-name');
                    var projectNo = inputElement.data('project-number');

                    console.log('actual date: ' + actualDate + ' act name: ' + actName + ' project no: ' + projectNo);

                    var updateData = {
                        projNum: projectNo,
                        field: actName,
                        after: actualDate.toString()
                    };

                    console.log(updateData);

                    // Send the updateData to the server using AJAX
                    $.ajax({
                        method: 'POST',
                        url: '{{ route("log_changes") }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: updateData,
                        success: function(response) {
                            console.log('Data posted successfully:', response);
                        },
                        error: function(error) {
                            console.error('Error posting data:', error);
                        }
                    });

                    handleActivityClick(inputElement, actualDate, actName, projectNo);
                }
            });

            $(document).on('click', 'button.check', function() {
                var inputElement = $(this).siblings('input[type="date"]');
                var actualDate = inputElement.val();
                var actName = inputElement.data('act-name');
                var projectNo = inputElement.data('project-number');

                console.log('actual date: ' + actualDate + ' act name: ' + actName + ' project no: ' + projectNo);

                var updateData = {
                    projNum: projectNo,
                    field: actName,
                    after: actualDate.toString()
                };

                console.log(updateData);

                // Send the updateData to the server using AJAX
                $.ajax({
                    method: 'POST',
                    url: '{{ route("log_changes") }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: updateData,
                    success: function(response) {
                        console.log('Data posted successfully:', response);
                    },
                    error: function(error) {
                        console.error('Error posting data:', error);
                    }
                });

                handleActivityClick(inputElement, actualDate, actName, projectNo);
            });

            function handleActivityClick($activity, actualDate, actName, projectNo) {

                if (actualDate && actName && projectNo) {
                    $.ajax({
                        url: '{{ route("update_actual_date") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            actualizedDate: actualDate,
                            activityName: actName,
                            projectNumber: projectNo,
                        },
                        success: function(response) {
                            if (response.success) {
                                console.log('Actual date updated successfully.');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Actual date updated successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                console.log('Actualized date update failed: ' + response.message);
                            }
                        },
                        error: function() {
                            console.log('Error while updating actualized date.');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Error while updating actualized date.',
                            });
                        }
                    });
                } else {
                    console.log('Actualized date, activity name, or project number is missing.');
                }
            }

            $(document).on('click', 'button.actualized', function() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success text-white",
                        cancelButton: "btn btn-danger text-white mr-2"
                    },
                    buttonsStyling: false
                });

                var activityInput = $(this).parent().find('.activity-input');
                var actualDate = $(this).parent().find('.activity-input').val();

                if (actualDate === '') {
                    swalWithBootstrapButtons.fire({
                        title: "Oops!",
                        text: "Please input the actual date first!",
                        icon: "error"
                    });
                    return;
                }

                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "Actual date won't be able to edit after actualizing the activity.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, actualized it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var activityName = $(this).parent().find('.activity-input').data('act-name');
                        var projectNumber = $(this).parent().find('.activity-input').data('project-number');

                        console.log('Activity Name:', activityName);
                        console.log('Project Number:', projectNumber);

                        $.ajax({
                            url: '{{ route("activity_actualized") }}',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                activityName: activityName,
                                projectNumber: projectNumber
                            },
                            success: function(response) {
                                swalWithBootstrapButtons.fire({
                                    title: "Yahoo! (∩˃o˂∩)♡ ",
                                    text: activityName + " has been actualized!",
                                    icon: "success"
                                });

                                // Disable the date input if the activity is actualized
                                activityInput.prop('disabled', true);
                                activityInput.siblings('.check, .cancel').prop('disabled', true);
                                $(this).prop('disabled', true);


                                console.log('Activity actualized:', response);

                            },
                            error: function(error) {
                                console.error('Error actualizing activity:', error);
                            }
                        });

                    } else if (

                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled (˶' ᵕ '˶)",
                            text: "Activtiy is not actualized :)",
                            icon: "error"
                        });
                    }
                });
            });
            // -- Post actual date & actualized activity end --

            $(document).on('focus', '.cost-iteration', function() {
                $(this).nextAll('button.cosi-check, button.cosi-cancel').show();
            });

            $(document).on('click', function(event) {
                var target = $(event.target);
                if (!target.hasClass('cost-iteration') && !target.is('button.cosi-check') && !target.is('button.cosi-cancel')) {
                    $('button.cosi-check, button.cosi-cancel').hide();
                }
            });

            // -- Post Cost Iteration Start --
            $(document).on('keydown', 'input[type="number"]', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    var inputElement = $(this);
                    var afterValue = inputElement.val();
                    var projectNo = inputElement.data('project-number');

                    var cosi = {
                        projNum: projectNo,
                        cosiValue: afterValue
                    };

                    $.ajax({
                        method: 'POST',
                        url: '{{ route("update_cosi") }}',
                        headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: cosi,
                        success: function(response) {
                            Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Cost Iteration added successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                        },
                        error: function(error) {
                            console.error('Error posting data: ', error);
                        }
                    });
                }
            });

            $(document).on('click', 'button.cosi-check', function() {
                var inputElement = $(this).siblings('input[type="number"]');
                var afterValue = inputElement.val();
                var projectNo = inputElement.data('project-number');

                var cosi = {
                    projNum: projectNo,
                    cosiValue: afterValue
                };

                $.ajax({
                    method: 'POST',
                    url: '{{ route("update_cosi") }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: cosi,
                    success: function(response) {
                        Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Cost Iteration added successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                        });
                    },
                    error: function(error) {
                        console.error('Error posting data: ', error);
                    }
                });

            });

            $(document).on('click', 'button.cosi-cancel', function() {
                var input = $(this).siblings('input[type="number"]');
                input.val('');
                $(this).siblings('button.cosi-check, button.cosi-cancel').hide();
            });
            // -- Post Cost Iteration End --    

            $(document).on('click', 'button.la-check', function() {
                var $inputField = $(this).siblings('.activity-input');
                var projectNumber = $inputField.data('project-number');
                var activityName = $inputField.data('act-name');
                var activityValue = $inputField.val();

                // Send data to the backend using AJAX
                $.ajax({
                    url: '{{ route("storeLACommit") }}', // Replace with your actual endpoint
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        p_projnum: projectNumber,
                        a_name: activityName,
                        a_act: activityValue
                    },
                    success: function (response) {
                        Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Launch Avail added successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle error response if needed
                        console.error('Error posting data:', error);
                    }
                });
            });

        });
    </script>
    
@endsection