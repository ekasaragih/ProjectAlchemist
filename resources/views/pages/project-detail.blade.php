@extends('layouts.navbar.sidebar')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <!-- Include Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="/css/ProjectDetail.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        button.check,
        button.cancel,
        button.actualized {
            display: none;
        }

        td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Project Detail'])
<div class="container">
    <div>
        <CENTER>
            <iframe src="https://giphy.com/embed/MJcDxcJE6xpcs" style="pointer-events: none; margin-top: -50px;" width="250" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
            <h1 class="text-white text-bolder">Project Detail</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-rounded btnGreen rubik-font">Back to Dashboard</a>
            <a href="{{ route('project_list') }}" class="btn btn-rounded btnGreen rubik-font ml-2">Back to Project Lists</a>
        </CENTER>
    </div>

    <div class="card m-0">
        {{-- @*Page Tab*@ --}}
        <div class="">
            <div class="card-body p-2 centered">
                <nav>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-secondary rubik-font"
                               id="pills-information-tab"
                               data-toggle="tab"
                               href="#pills-information"
                               role="tab"
                               aria-controls="pills-information"
                               aria-selected="true">Project Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary rubik-font"
                               id="pills-members-tab"
                               data-toggle="tab"
                               href="#pills-members"
                               role="tab"
                               aria-controls="pills-members"
                               aria-selected="false">Project Members</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary rubik-font"
                               id="pills-schedule-tab"
                               data-toggle="tab"
                               href="#pills-schedule"
                               role="tab"
                               aria-controls="pills-schedule"
                               aria-selected="false">Project Schedule</a>
                        </li>
                    </ul>
    
                </nav>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active rubik-font" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
                    <div class="text-center mt-4">
                        <span class="text-bold ml-2 mr-2" style="font-size: 24px;">Product</span>
                        <h4 class="p-2 m-0 rubik-font" style="color: #588157;">{{ $project->p_desc }}</h4>
                    </div>
                    <div class="row p-4">
                        <div class="col">
                            {{-- @*Toy Picture*@ --}}
                            <div class="card border-1 mb-3" id="toy-card-container">
                                <h3 class="mt-3 text-center"><b style="color: #0A5C36;">Toy Photo</b></h3>
                                <hr class="bg-dark" />
                                <div style="padding:10px; position: relative;">
                                    <!-- Left arrow -->
                                    <button class="slider-arrow left-arrow" onclick="showPrevImage()">&#8249;</button>
                                    <div class="slide-content" style="max-width: 850px; text-align: center;">
                                        <CENTER>
                                            <div id="slideshow-container fade">
                                                @if(isset($imageUrls) && count($imageUrls) > 0)
                                                    @foreach($imageUrls as $imageUrl)
                                                        <div class="image-container" data-photo-name="{{ $imageUrl }}">
                                                            <a class="image-link" data-mfp-src="{{ $imageUrl }}" data-effect="mfp-zoom-in">
                                                                <img class="mySlides img-fluid border-radius-md product-photo" height="300" src="{{ $imageUrl }}" style="display:block;" />
                                                            </a>
                                                            <!-- Overlay div for icons -->
                                                            <div class="image-overlay">
                                                                <ul class="icon-left">
                                                                    <!-- Use the "data-mfp-src" attribute instead of "href" -->
                                                                    <li><a class="magnific-popup text-white" data-mfp-src="{{ $imageUrl }}"><i class="fa fa-search"></i></a></li>
                                                                </ul>
                                                                <ul class="icon-right">
                                                                    <!-- Assuming you want to call JavaScript function deleteImage on icon click -->
                                                                    <li><a class="text-white" onclick="deleteImage('{{ $imageUrl }}')"><i class="fa fa-trash"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <!-- Display the default image when there are no images -->
                                                    <div class="image-container">
                                                        <img id="uploadedImage" class="mySlides img-fluid border-radius-md" width="300" src="https://media.istockphoto.com/id/1392182937/vector/no-image-available-photo-coming-soon.jpg?s=612x612&w=0&k=20&c=3vGh4yj0O2b4tPtjpK-q-Qg0wGHsjseL2HT-pIyJiuc=" style="display:block;" />
                                                    </div>
                                                @endif
                                            </div>
                                        </CENTER>
                                    </div>                                
                                    <!-- Right arrow -->
                                    <button class="slider-arrow right-arrow" onclick="showNextImage()">&#8250;</button>
                                </div>
                                <hr class="bg-dark" />
                                    <CENTER>
                                        <button class="btn btn-rounded btnGreen rubik-font" style="background-color: #92817A !important;" data-bs-toggle="modal" data-bs-target="#upfoto"> Add Photo </button>
                                    </CENTER>
                            </div>

                            {{-- @*Project Remarks/Note*@ --}}
                        <div class="card border-1 mb-2">
                            <div class="container">
                                <div class="card-body p-3 rubik-font toy-note">
                                    <h3><b style="color: #0A5C36;">Remarks</b></h3>
                                    @if($project->p_notes)
                                        <p class="rubik-font mt-2 text-dark" style="white-space: pre-line;">{{ $project->p_notes }}</p>
                                    @else
                                        <p class="rubik-font mt-2"><i>No remarks...</i></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @*Project Information*@ --}}
                    <div class="col">
                        <div class="card border-1">
                            <div class="container">
                                <div class="card-body px-3 pt-2 pb-3 rubik-font">
                                    <h3 class="mt-3">
                                        <b style="color: #0A5C36;">Project Information</b>
                                        {{-- @if (new[] { 117, 2, 1 }.Contains((int)Session["grp_ID"]))
                                        { --}}
                                            <span><a class="ml-2 edit-info" data-bs-toggle="modal" data-bs-target="#updateProjectInfo"><i class="fa fa-edit"></i></a></span>
                                        {{-- } --}}
                                    </h3>
                                    <p class="
                                    @switch($project->p_stat)
                                        @case('Draft')
                                            badge badge-pill badge-soft-warning
                                            @break
                                        @case('Ongoing')
                                            badge badge-pill badge-soft-success
                                            @break
                                        @case('Preliminary')
                                        @case('BOM Input')
                                        @case('Prep 1st Cost')
                                        @case('1st Cost')
                                            badge badge-pill badge-primary-subtle
                                            @break
                                        @case('CR Cost Done')
                                        @case('FPR Cost Done')
                                            badge badge-pill badge-success
                                            @break
                                        @case('Prep CR Model')
                                        @case('Prep FPR Model')
                                            badge badge-pill badge-warn-subtle
                                            @break
                                        @case('CR Approval')
                                        @case('FPR Approval')
                                            badge badge-pill badge-secondary-subtle
                                            @break
                                        @case('CR Approved')
                                        @case('FPR Approved')
                                        @case('CR/FPR Approved')
                                            badge badge-pill badge-info-subtle
                                            @break
                                        @case('Drop')
                                        @case('Change Source')
                                        @case('Re-ICR')
                                            badge badge-pill badge-danger-subtle
                                            @break
                                        @default
                                            // Default class if status doesn't match any case
                                    @endswitch
                                ">
                                    {{ $project->p_stat }}
                                </p>
                                    <div class="text-center rubik-font mb-2 row">
                                        <div class="col">
                                            <h4 style="color: #0A5C36; opacity: 0.6;"><b>Project #</b></h4>
                                            <h5>{{ $project->p_projnum }}</h5>
                                        </div>
                                        <br />
                                        <div class="col">
                                            <h4 style="color: #0A5C36; opacity: 0.6;"><b>Product #</b></h4>
                                            <h5 class="text-uppercase">{{ $project->p_prodnum }}</h5>
                                        </div>
                                    </div>
                                    <hr class="bg-dark mb-3" />
                                    <div class="list-group list-group-flush mt-4">
                                        <div class="row">
                                            <div class="col rubik-font">
                                                {{-- <h6>Project Path</h6> <p>ProjectPath</p> --}}
                                                <h6 class="text-dark">Categories</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_categories }}</p>
                                                <h6 class="text-dark">Product</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_desc }}</p>
                                                <h6 class="text-dark">Toy Complexity</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_complx }}</p>
                                                <h6 class="text-dark">Age Grade</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_agegrd }}</p>
                                                <h6 class="text-dark">Licensed</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_licen == 1 ? 'Yes' : 'No' }}</p>
                                                <h6 class="text-dark">Type</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_type }}</p>
                                                <h6 class="text-dark">Quota (K)</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_quota }}</p>
                                            </div>

                                            <div class="col rubik-font">
                                                <h6 class=" text-dark">Launch Quantity</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_lq }}</p>
                                                <h6 class="text-dark">Launch Avail</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_la }}</p>
                                                <h6 class="text-dark">Season</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_season }}</p>
                                                <h6 class="text-dark">Suggested Retail Price</h6>
                                                <p style="font-size: 14px;" class="font-italic">
                                                    ${{ $project->p_retail }}
                                                </p>
                                                <h6 class="text-dark">Tool Cost Budget</h6>
                                                <p style="font-size: 14px;" class="font-italic">
                                                    ${{ $project->p_toolbdg }}
                                                </p>
                                                <h6 class="text-dark">Target X-Factory</h6>
                                                <p style="font-size: 14px;" class="font-italic">
                                                    ${{ $project->p_tgtcost }}
                                                </p>
                                                <h6 class="text-dark">CR/FPR Combine</h6> <p style="font-size: 14px;" class="font-italic">{{ $project->p_crfpr == 1 ? 'Yes' : 'No'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

        {{-- @*Project Members*@ --}}
        <div class="tab-pane fade p-4" id="pills-members" role="tabpanel" aria-labelledby="pills-members-tab">
            <center>
                <iframe src="https://giphy.com/embed/revNpXRWOAkESvo1on" style="pointer-events: none;" width="600" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
            </center>              
            <h3 class="mt-3 text-center">
                <b style="color: #0A5C36;">Project Members</b>
                {{-- <span><a class="ml-2 edit-info" data-bs-toggle="modal" data-bs-target="#updateProjectMember"><i class="fa fa-edit"></i></a></span> --}}
            </h3>
            <div class="card border-1 mb-4">
                <div class="container">
                    <div class="card-body px-3 pt-2 pb-3 rubik-font">
                        <table class="table table-hover mt-3 table-bordered">
                            <thead style="background-color: #BEDBBB;">
                                <tr>
                                    <th class="pl-2 rubik-font" style="color: #92817A;">Role</th>
                                    <th class="pl-2 rubik-font" style="color: #92817A;">Members</th>
                                    {{-- <th class="pl-2 rubik-font" style="color: #92817A;">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($project->assigned as $assigned)
                                    <tr class="text-dark" data-role="{{ $assigned->role_name }}" data-proj-number="{{ $project->p_projnum }}">
                                        <td class="rubik-font">
                                            {{ $assigned->role_name }}
                                            @if ($assigned->role_name === 'Product Engineer')
                                                <svg style="color: white; margin-top: -6px; opacity: 0.6;" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                    <path d="M576 136c0 22.09-17.91 40-40 40c-.248 0-.4551-.1266-.7031-.1305l-50.52 277.9C482 468.9 468.8 480 453.3 480H122.7c-15.46 0-28.72-11.06-31.48-26.27L40.71 175.9C40.46 175.9 40.25 176 39.1 176c-22.09 0-40-17.91-40-40S17.91 96 39.1 96s40 17.91 40 40c0 8.998-3.521 16.89-8.537 23.57l89.63 71.7c15.91 12.73 39.5 7.544 48.61-10.68l57.6-115.2C255.1 98.34 247.1 86.34 247.1 72C247.1 49.91 265.9 32 288 32s39.1 17.91 39.1 40c0 14.34-7.963 26.34-19.3 33.4l57.6 115.2c9.111 18.22 32.71 23.4 48.61 10.68l89.63-71.7C499.5 152.9 496 144.1 496 136C496 113.9 513.9 96 536 96S576 113.9 576 136z" fill="#fbcf3b"></path>
                                                </svg>
                                            @endif
                                        </td>                                        
                                        <td class="rubik-font">
                                            {{ $assigned->user_name ?? 'No User Assigned' }}
                                        </td>
                                        {{-- <td>
                                            <a class="btn btn-danger delete-member"><i class="fa fa-trash text-white" aria-hidden="true"></i></a>
                                        </td> --}}
                                    </tr>
                                    <tr></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- @*Project Schedule/Activity*@ --}}
        <div class="tab-pane fade p-4" id="pills-schedule" role="tabpanel" aria-labelledby="pills-schedule-tab">
            <center>
                <iframe src="https://giphy.com/embed/C94TZbM4PLEM8" style="pointer-events: none;" width="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>           
            </center>            
            <h3 class="mt-3 text-center"><b style="color: #0A5C36;">Project Activity</b></h3>
            <div class="card border-1 mb-4">
                <div class="container">
                    <div class="card-body px-3 pt-2 pb-3">
                        <table id="activitiesTable" class="table table-bordered mt-3 table-responsive" style="vertical-align: middle;">
                            <thead style="background-color: #BEDBBB;">
                                <tr>
                                    <th class="pl-2 rubik-font" style="color: #92817A;">Activity Name</th>
                                    <th class="pl-2 rubik-font" style="color: #92817A;">Commitment Current Date</th>
                                    <th class="pl-2 rubik-font" style="color: #92817A;">Commitment Actual Date <span class="ml-2 mr-0" title="Edit is disabled if date already actualized."><i class="fa fa-info-circle" aria-hidden="true"></i></span></th>
                                    <th class="pl-2 rubik-font" style="color: #92817A;">Delay Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activity as $activity)
                                    <tr class="text-dark activity-row">
                                        <td class="rubik-font activity-name">{{ $activity->a_name }}</td>
                                        <td class="rubik-font">
                                            <input type="date" class="form-control" value="{{ $activity->a_sch }}" disabled />
                                        </td>
                                        <td class="rubik-font">
                                            @if($activity->a_name !== 'DSP Start (turnover to Plant)' && $activity->a_name !== 'KO Meeting')
                                                <input type="date" class="form-control activity-input"
                                                       value="{{ $activity->a_act }}"
                                                       id="actual-date"
                                                       data-date-before="{{ $activity->a_act }}"
                                                       data-act-name="{{ $activity->a_name }}" 
                                                       data-actlzd="{{ $activity->a_actlzd }}"/>
                                                <button class="btn btn-light check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                                <button class="btn btn-light cancel mt-1"> <i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                                <button class="btn btn-success text-white actualized mt-1" style="margin-left: 5px;" title="Actualized">A</button>
                                            @endif
                                        </td>
                                        <td style="background-color: {{ !empty($activity->ReasonForDelay) ? '#fbdd9d' : 'white' }}">
                                            @if ($activity->a_sch && $activity->a_sch && $activity->a_act > $activity->a_sch)
                                                @if (!empty($activity->ReasonForDelay))
                                                    <CENTER>{{ $activity->ReasonForDelay }}</CENTER>
                                                @else
                                                    <textarea class="form-control reason-textarea" rows="3" placeholder="Enter reason for delay"></textarea>
                                                    <button class="btn reason-check mt-1"><i class="fa-solid fa-check" style="cursor: pointer;"></i></button>
                                                    <button class="btn reason-cancel mt-1"><i class="fa-solid fa-xmark" style="cursor: pointer;"></i></button>
                                                @endif
                                            @endif
                                        </td>                                        
                                    </tr>
                                    <tr></tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <div class="pl-4 pb-4">
            <button class="btn btn-danger text-center" id="btn-drop" style="display: inline-block; padding: 8px;">Drop Project</button>
        </div>

    </div>
</div>

<!--Modal Up Foto-->
<div class="modal fade rubik-font" id="upfoto" tabindex="-1" role="dialog" aria-labelledby="upfoto" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #92817A;"><b>Add Photo</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('upload_images') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="projectNumber" type="hidden" value="{{ $project->p_projnum }}" />

                    <div class="row g-2 mt-1">
                        <div class="col-sm-12">
                            <div id="queuedImages" class="queued-div p-2">
                                <div id="imagePreviewContainer" class="d-flex flex-wrap mr-3"></div>
                            </div>
                            <div id="id-input-div" class="input-div mt-2">
                                <p>Drag & drop photos here or click to browse</p>
                                <input name="files" id="input_image" type="file" class="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg" onchange="previewImage()" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="uploadButton" type="submit" class="btn btn-primary">Upload Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- @*Modal Update Project Information*@ --}}
<div class="modal fade rubik-font" id="updateProjectInfo" tabindex="-1" role="dialog" aria-labelledby="updateProjectInfo" aria-hidden="true" width="1000">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Project Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group">
                        <div class="rubik-font">
                            <CENTER>
                                <iframe src="https://giphy.com/embed/BkXcskc0k35UQ" width="250" style="pointer-events: none;" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                                <h4 style="color: #5e72e4; opacity: 0.6;"><b>Project Information</b></h4>
                            </CENTER>
                            <br />
                            <div class="row mt-3">
                                <div class="col">
                                    <label>Project Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ProjectNumber" id="ProjectNumber" placeholder="Input Project Number" value="{{ $project->p_projnum }}" disabled />
                                </div>

                                <div class="col">
                                    <label>Product Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ProdDesc" id="ProdDesc" placeholder="Input Product Description" value="{{ $project->p_desc }}"/>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label>Categories <span class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Default select example" name="Categories" id="Categories" disabled>
                                        <option>{{ $project->p_categories }}</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Type</label>
                                    <select class="form-select" name="Type" id="Type">
                                        <option selected>{{ $project->p_type }}</option>
                                        <option value="Process A">Process A</option>
                                        <option value="Process B">Process B</option>
                                        <option value="Process C">Process C</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label>Product # <span class="text-danger">*</span></label>
                                    <input type="text" aria-label="Default select example" class="form-control text-uppercase" name="ProdNum" id="ProdNum" placeholder="Input Product Number" value="{{ $project->p_prodnum }}" required />
                                </div>

                                <div class="col">
                                    <label for="ToyCmplx">Complexity</label>
                                    <select class="form-select" aria-label="Default select example" name="Cmplx" id="Cmplx">
                                        <option>{{ $project->p_complx }}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label>Age Grade</label>
                                    <input type="text" class="form-control" name="AgeGrd" id="AgeGrd" placeholder="Input Age Grade" value="{{ $project->p_agegrd }}" />
                                </div>

                                <div class="col">
                                    <label>Quota (K)</label>
                                    <input type="number" class="form-control" name="Quota" id="Quota" placeholder="Input Toy Quota" value="{{ $project->p_quota }}" />
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label>Launch Quantity (K)</label>
                                    <input type="number" class="form-control" name="LQ" id="LQ" placeholder="Input Launch Quantity" value="{{ $project->p_lq }}" />
                                </div>

                                <div class="col">
                                    <label>Launch Avail</label>
                                    <input type="date" class="form-control" name="LA" id="LA" placeholder="Input Launch Avail" value="{{ $project->p_la }}" />
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label>Season <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="Season" id="Season" value="{{ $project->p_season }}" required readonly />
                                </div>

                                {{-- @*Auto Season based on LA/MRD Date*@ --}}
                                <script>
                                    function getSeasonFromDate(selectedDate) {
                                        if (!selectedDate) return '';

                                        const date = new Date(selectedDate);
                                        const year = date.getFullYear();

                                        if ((date >= new Date(`${year - 1}-11-01`) && date <= new Date(`${year}-05-31`))) {
                                            return `S ${year}`; // Spring season
                                        } else if ((date >= new Date(`${year}-06-01`) && date <= new Date(`${year}-10-31`))) {
                                            return `F ${year}`; // Fall season
                                        } else {
                                            return `S ${year + 1}`; // If date doesn't fit in previous criteria, it belongs to the next spring
                                        }
                                    }

                                    // Function to update Season based on LA field value
                                    function updateSeason() {
                                        const selectedDate = document.getElementById('LA').value;

                                        const season = getSeasonFromDate(selectedDate);

                                        document.getElementById('Season').value = season;

                                        console.log(season);
                                    }

                                    document.getElementById('LA').addEventListener('change', updateSeason);
                                </script>

                                <div class="col">
                                    <label>Retail <span class="text-danger">*</span> <span style="font-size: 12px;"><i>(If none, put '0')</i></span></label>
                                    <input type="number" step="0.01" class="form-control" name="Retail" id="Retail" placeholder="Input Suggested Retail Price" value="{{ $project->p_retail }}" required />
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label>Target Cost <span class="text-danger">*</span> <span style="font-size: 12px;"><i>(If none, put '0')</i></span></label>
                                    <input type="number" step="0.01" class="form-control" name="TgtCost" id="TgtCost" placeholder="Input Target Cost" value="{{ $project->p_tgtcost }}" />
                                </div>

                                <div class="col">
                                    <label>Tooling Budget <span class="text-danger">*</span> <span style="font-size: 12px;"><i>(If none, put '0')</i></span></label>
                                    <input type="number" step="0.01" class="form-control" name="ToolBdg" id="ToolBdg" placeholder="Input Tooling Budget" value="{{ $project->p_toolbdg }}" disabled/>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="Licensed" id="Licensed" value="{{ $project->p_licen }}" disabled />
                                        <span class="custom-checkbox"></span>
                                        Licensed
                                    </label>
                                </div>

                                <div class="col">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="viewModel.CRFPR" id="CRFPR" value="{{ $project->p_crfpr }}" disabled />
                                        <span class="custom-checkbox"></span>
                                        CR/FPR Combine
                                    </label>
                                </div>
                            </div>

                            <br />

                            <div class="row mt-3">
                                <div class="col">
                                    <label>Remarks <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" style="height: 80px; white-space: pre-wrap;" name="Note" id="Notes" placeholder="Input Remarks" required>{{ $project->p_notes }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateProjectButton">Save Changes</button>
            </div>
        </div>
    </div>
</div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="/js/moment.js"></script>
<script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

{{-- Function for image slider --}}
<script>
    var slideIndex = 0;
    var slides;

    showSlides();

    function showSlides() {
        slides = document.getElementsByClassName("mySlides");
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex].style.display = "block";
    }

    function showPrevImage() {
        slideIndex--;
        if (slideIndex < 0) {
            slideIndex = slides.length - 1;
        }
        showSlides();
    }

    function showNextImage() {
        slideIndex++;
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }
        showSlides();
    }
</script>

{{-- @*Function for queued image and remove it and upload photos - POST to DB*@ --}}
<script>
    const queuedImagesArray = [];

    $("#uploadButton").on("click", function (e) {
        e.preventDefault();
        var projectNumber = $("#projectNumber").val();
        var formData = new FormData();
        var images = $("#input_image")[0].files;

        formData.append("projectNumber", projectNumber);

        for (let i = 0; i < images.length; i++) {
            formData.append("files[]", images[i]);
        }

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('upload_images') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log('Image uploaded successfully.');
                $('#upfoto').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Image uploaded successfully!',
                    showConfirmButton: false,
                    timer: 1500
                })
                location.reload();
            },
            error: function (error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: 'Image upload failed: ' + error
                });
            },
        });
    });

    // Function for queued image and remove it
    function previewImage() {
        const input = document.getElementById('input_image');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');

        imagePreviewContainer.innerHTML = ''; // Clear the container

        if (input.files && input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('queued-image-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('queued-image');

                    const deleteButton = document.createElement('span');
                    deleteButton.innerHTML = '&times;';
                    deleteButton.classList.add('delete-button');
                    deleteButton.addEventListener('click', function () {
                        imageContainer.remove();
                        const index = queuedImagesArray.indexOf(file);
                        if (index !== -1) {
                            queuedImagesArray.splice(index, 1);
                        }
                    });

                    imageContainer.appendChild(img);
                    imageContainer.appendChild(deleteButton);

                    imagePreviewContainer.appendChild(imageContainer);

                    queuedImagesArray.push(file);
                };

                reader.readAsDataURL(file);
            }
        }
    }
</script>

{{-- @*Function for Zoom and Delete the photo from the container*@ --}}
<script>
        $(document).ready(function () {
            // Initialize Magnific Popup for image links with class "magnific-popup"
            $('.magnific-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                gallery: {
                    enabled: true,
                },
            });

        });

        function deleteImage(photoName) {
            $.ajax({
                url: '{{ route("delete_image") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: { photoName: photoName },
                success: function (response) {
                    if (response.success) {
                        console.log('Image deleted successfully.');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Image deleted successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    } else {
                        // Handle deletion failure
                        console.log('Image deletion failed: ' + response.message);
                    }
                },
                error: function () {
                    // Handle AJAX error
                    console.log('Error while deleting image.');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error while deleting image.'
                    });
                }
            });
        }
</script>

{{-- Update Project Information --}}
<script>
    $('#updateProjectButton').click(function () {
        var projectData = {
            ProjectNumber: $('#ProjectNumber').val(),
            Type: $('#Type').val(),
            ProdNum: $('#ProdNum').val(),
            Cmplx: $('#Cmplx').val(),
            ProdDesc: $('#ProdDesc').val(),
            AgeGrd: $('#AgeGrd').val(),
            Quota: $('#Quota').val(),
            LQ: $('#LQ').val(),
            LA: $('#LA').val(),
            Season: $('#Season').val(),
            Retail: $('#Retail').val(),
            TgtCost: $('#TgtCost').val(),
            ToolBdg: $('#ToolBdg').val(),
            Note: $('#Notes').val()
        };

        $.ajax({
            url: '{{ route("update_project") }}',
            method: 'POST',
            data: projectData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    $('#updateProjectInfo').modal('hide');
                    location.reload();
                    console.log('Project updated successfully.');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Project Information updated successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    console.log('Project update failed: ' + response.message);
                }
            },
            error: function () {
                console.log('Error while updating project.');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error while updating project information.'
                })
            }
        });
    });
</script>

{{-- @*Function to disable the input if data already actualized*@ --}}
<script>
    // Function to disable the input if date is already actualized
    function disableActualizedActivities() {
        $('.activity-input').each(function () {
            var inputElement = $(this);
            var actualized = inputElement.data('actlzd');

            if (actualized === 'A') {
                inputElement.prop('disabled', true);
            }
        });
    }

    $(document).ready(function () {
        disableActualizedActivities();
    });
</script>

{{-- @*Function for Update Actual Date*@ --}}
<script>
        $(document).ready(function () {
            $('.activity-input').focus(function () {
                $(this).siblings('button.check, button.cancel, button.actualized').show();
            });

            $(document).on('click', function (event) {
                var target = $(event.target);
                if (!target.hasClass('activity-input') && !target.is('button.check') && !target.is('button.cancel') && !target.is('button.actualized')) {
                    $('button.check, button.cancel, button.actualized').hide();
                }
            });

            //Add an event listener for the "keydown" event on date input fields
            $(document).on('keydown', 'input[type="date"]', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // Prevent the default behavior (form submission)
                    var inputElement = $(this);
                    var actualDate = inputElement.val();
                    var actName = inputElement.data('act-name');
                    var projectNo = '{{ $project->p_projnum }}';

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
                        success: function (response) {
                            console.log('Data posted successfully:', response);
                        },
                        error: function (error) {
                            console.error('Error posting data:', error);
                        }
                    });

                    handleActivityClick(inputElement, actualDate, actName, projectNo);
                }
            });

            $(document).on('click', 'button.check', function () {
                var inputElement = $(this).siblings('input[type="date"]');
                var actualDate = inputElement.val();
                var actName = inputElement.data('act-name');
                var projectNo = '{{ $project->p_projnum }}';

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
                        success: function (response) {
                            console.log('Data posted successfully:', response);
                        },
                        error: function (error) {
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
                        success: function (response) {
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
                        error: function () {
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

            $(document).on('click', 'button.actualized', function () {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success text-white",
                            cancelButton: "btn btn-danger text-white mr-2"
                        },
                        buttonsStyling: false
                    });

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
                            var projectNumber = '{{ $project->p_projnum }}';

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
                                success: function (response) {
                                    swalWithBootstrapButtons.fire({
                                        title: "Yahoo! (∩˃o˂∩)♡ ",
                                        text: activityName + " has been actualized!",
                                        icon: "success"
                                    });

                                    // Disable the date input if the activity is actualized
                                    if (response.success) {
                                        var isActivityActualized = activityInput.data('actlzd');
                                        if (isActivityActualized === 'A') {
                                            activityInput.prop('disabled', true);
                                        }
                                    }

                                    console.log('Activity actualized:', response);

                                },
                                error: function (error) {
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

        });
</script>

{{-- @*Function for Input Reason Delay for Each Stage*@ --}}
<script>
    $(document).ready(function () {
        $('.reason-textarea').focus(function () {
            $(this).siblings('button.reason-check, button.reason-cancel').show();
        });

        $(document).on('click', function (event) {
            var target = $(event.target);
            if (!target.hasClass('reason-textarea') && !target.is('button.reason-check') && !target.is('button.reason-cancel')) {
                $('button.reason-check, button.reason-cancel').hide();
            }
        });

        $(document).on('click', 'button.reason-check', function () {
            var inputElement = $(this).siblings('textarea');
            var delayDescription = inputElement.val();
            var projectNumber = '{{ $project->p_projnum }}';

            if (delayDescription) {
                var activityName = getActivityNameFromTableRow($(this));
                var delayType = 'Activity';

                var data = {
                    delayType: delayType,
                    projnum: projectNumber,
                    activityName: activityName,
                    delayDesc: delayDescription
                };

                console.log(data);

                // Make an AJAX POST request to your controller.
                $.ajax({
                    url: '{{ route("add_delay_reason") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            console.log('Delay reason saved successfully.');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delay reason: ' + data.delayDesc + ' has been posted.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            console.log('Error saving delay reason: ' + response.message);
                            // You can handle errors here.
                        }
                    },
                    error: function () {
                        console.log('Error while saving delay reason.');
                        // Handle AJAX request errors here.
                    }
                });
            } else {
                console.log('Delay description is empty.');
                // Handle this case as needed.
            }
        });


        function getActivityNameFromTableRow(buttonElement) {
            var activityName = buttonElement.closest('tr').find('.activity-name').text();
            return activityName;
        }

        $('button.reason-cancel').click(function () {
            var textarea = $(this).siblings('textarea');
            textarea.val('');
            $(this).siblings('button.reason-check, button.reason-cancel').hide();
        });
    });
</script>

{{-- Function to drop project --}}
<script>
    $(document).ready(function () {
        $('#btn-drop').on('click', function () {
            const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success text-white",
                        cancelButton: "btn btn-danger text-white mr-2"
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "Actual date won't be able to edit after actualizing the activity.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, drop it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

            var projectNumber = '{{ $project->p_projnum }}';
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{ route("drop_project") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
                    projectNumber: projectNumber
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Project dropped successfully.');
                    } else {
                        console.log('Error dropping project: ' + response.message);
                    }
                },
                error: function () {
                    console.log('Error dropping project.');
                }
            });

        } else if (

            result.dismiss === Swal.DismissReason.cancel
            ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled (˶' ᵕ '˶)",
                        text: "Project is not dropped :)",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>
@endsection