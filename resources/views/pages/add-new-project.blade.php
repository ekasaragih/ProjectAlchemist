@section('head')
{{-- <link rel="stylesheet" href="{{ asset('assets/calendar-20/css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/InputStyle.css') }}">
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .swal2-popup {
        font-family: 'Rubik', sans-serif;
    }

    .swal2-cancel {
        display: none !important;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@extends('layouts.navbar.sidebar')

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Add New Project'])

<div class="container">
    
        <div class="card">
            <div class="card-body">
                <span class="rubik-font">Please ensure that there are no <span class="text-danger rubik-font">typo(s)</span> while inputting the data ✧˖°🌷📎⋆ ˚｡⋆୨୧˚</span>
            </div>
        </div>
    
        <br />
    
        <!-- MultiStep Form -->
        <div class="container-fluid" id="grad1">
            <div class="row justify-content-center mt-0">
                <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mb-2 base">
                    <div class="card px-0 pt-4 pb-0 mb-3">
                        <div class="text-center">
                            <center>
                                <div class="text-center">
                                    <iframe src="https://giphy.com/embed/LxbL175q1fTNK" style="pointer-events: none; margin-bottom: -20px;" width="250" height="200" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                                </div>
                            </center>
                        </div>
                        <h2><strong>Add New Project</strong></h2>
                        <p>Fill all form field to go to next step</p>
                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <form id="msform" method="POST" action="{{ route('projects.store') }}">
                                    @csrf
                                
                                    <!-- progressbar -->
                                    <ul id="progressbar" class="rubik-font">
                                        <li class="active" id="information"><strong>Project Detail</strong></li>
                                        <li id="members"><strong>Project Members</strong></li>
                                        <li id="activity"><strong>Project Activity</strong></li>
                                    </ul>
    
                                    <!-- fieldsets -->
                                    {{-- Project Information/Details --}}
                                    <fieldset>
                                        <div class="form-card rubik-font">
                                            <h2 class="fs-title text-center" style="color: #5e72e4; opacity: 0.6;">Project Information</h2>
                                            <br />
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Project Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="ProjectNumber" id="ProjectNumber" placeholder="Input Project Number" />
                                                </div>

                                                <div class="col">
                                                    <label>Product Description <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="ProdDesc" id="ProdDesc" placeholder="Input Product Description" />
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Categories <span class="text-danger">*</span></label>
                                                    <select class="form-select js-my-select form-control" aria-label="Default select example" name="Categories" id="Categories" onchange="startDate()">
                                                        <option disabled selected>-- Select Categories --</option>
                                                        <option value="Apparel Accessories">Apparel Accessories</option>
                                                        <option value="Base layer">Base layer</option>
                                                        <option value="Dress">Dress</option>
                                                        <option value="Hosiery">Hosiery</option>
                                                        <option value="Jacket">Jacket</option>
                                                        <option value="Jersey">Jersey</option>
                                                        <option value="Legging/Tight">Legging/Tight</option>
                                                        <option value="Pants">Pants</option>
                                                        <option value="Shirt">Shirt</option>
                                                        <option value="Skirt">Skirt</option>
                                                        <option value="Socks">Socks</option>
                                                        <option value="Sweater">Sweater</option>
                                                        <option value="Swimsuit">Swimsuit</option>
                                                        <option value="T-Shirt">T-Shirt</option>
                                                        <option value="Underwear">Underwear</option>
                                                    </select>
                                                </div>
    
                                                <div class="col">
                                                    <label>Type</label>
                                                    <select class="form-select" aria-label="Default select example" name="Type" id="Type">
                                                        <option selected disabled>-- Select Type --</option>
                                                        <option value="Process A">Process A</option>
                                                        <option value="Process B">Process B</option>
                                                        <option value="Process C">Process C</option>
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Product # <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control text-uppercase" name="ProdNum" id="ProdNum" placeholder="Input Product Number" />
                                                </div>
    
                                                <div class="col">
                                                    <label for="ToyCmplx">Complexity</label>
                                                    <select class="form-select" name="Cmplx" id="Cmplx">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Age Grade</label>
                                                    <input type="text" class="form-control" name="AgeGrd" id="AgeGrd" placeholder="Input Age Grade" />
                                                </div>
    
                                                <div class="col">
                                                    <label>Quota (K)</label>
                                                    <input type="number" class="form-control" name="Quota" id="Quota" placeholder="Input Product Quota" />
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Launch Quantity (K)</label>
                                                    <input type="number" class="form-control" name="LQ" id="LQ" placeholder="Input Launch Quantity" />
                                                </div>
    
                                                <div class="col">
                                                    <label>Launch Avail</label>
                                                    <input type="date" class="form-control" name="LA" id="LA" placeholder="Input Launch Avail" />
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Season <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="Season" id="Season" readonly />
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
    
                                                        console.log(season); // Output the season to console (for testing)
                                                    }
    
                                                    document.getElementById('LA').addEventListener('change', updateSeason);
                                                </script>
    
                                                <div class="col">
                                                    <label>Retail <span class="text-danger">*</span> <span style="font-size: 12px;"><i>(If none, put '0')</i></span></label>
                                                    <input type="number" step="0.01" class="form-control" name="Retail" id="Retail" placeholder="Input Suggested Retail Price" />
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Target Cost <span class="text-danger">*</span> <span style="font-size: 12px;"><i>(If none, put '0')</i></span></label>
                                                    <input type="number" step="0.01" class="form-control" name="TargetCost" id="TargetCost" placeholder="Input Target Cost" />
                                                </div>
    
                                                <div class="col">
                                                    <label>Tooling Budget <span class="text-danger">*</span> <span style="font-size: 12px;"><i>(If none, put '0')</i></span></label>
                                                    <input type="number" step="0.01" class="form-control" name="ToolBdg" id="ToolBdg" placeholder="Input Tooling Budget" onchange="startDate()" />
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col mt">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="Licensed" id="Licensed" value="1" />
                                                        <span class="custom-checkbox"></span>
                                                        Licensed
                                                    </label>
                                                </div>
    
                                                <div class="col mt">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="CRFPR" id="CRFPR" value="1" />
                                                        <span class="custom-checkbox"></span>
                                                        CR/FPR Combine
                                                    </label>
                                                </div>
                                            </div>
    
                                            <br />
    
                                            <div class="row">
                                                <div class="col">
                                                    <label>Remarks <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control" style="height: 80px; white-space: pre-wrap;" name="Note" id="Note" placeholder="Input Remarks"></textarea>
                                                </div>
                                            </div>
                                            <br />
                                            {{-- <div class="row g-2 mt-1">
                                                <div class="col-sm-12">
                                                    <p class="text-dark text-bold">Insert product picture(s) <span class="text-danger">*</span></p>
                                                    <div id="queuedImages" class="queued-div p-2">
                                                        <div id="imagePreviewContainer" class="d-flex flex-wrap mr-3"></div>
                                                    </div>
                                                    <div id="id-input-div" class="mt-2">
                                                        <input name="files" id="input_image" type="file" class="form-control" multiple="multiple" accept="image/jpeg, image/png, image/jpg" onchange="previewImage()" />
                                                    </div>
                                                </div>
                                            </div> --}}
    
                                        </div>
    
                                        {{-- Button --}}
                                        <input type="button" name="next" class="next action-button rubik-font" value="Next Step" />
                                    </fieldset>

                                    {{-- Project Members --}}
                                    <fieldset>
                                        <div class="form-card rubik-font">
                                            <h2 class="fs-title text-center" style="color: #5e72e4; opacity: 0.6;">Project Members</h2>
                                            <br />
                                            {{-- @*Fix Section*@ --}}
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="member-container">
                                                            <label>Product Engineer <span class="text-danger">*</span></label>
                                                            <select class="form-select fix-section" id="PE" data-role="Product Engineer" required>
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>
    
                                                    <div class="col">
                                                        <div class="member-container">
                                                            <label>Product Designer <span class="text-danger">*</span></label>
                                                            <select class="form-select fix-section" id="ProdDes" data-role="Product Designer" required>
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="member-container">
                                                            <label>Product Costing <span class="text-danger">*</span></label>
                                                            <select class="form-select fix-section" id="ProdCost" data-role="Product Costing" required>
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>
    
                                                    <div class="col">
                                                        <div class="member-container">
                                                            <label>Product Packaging <span class="text-danger">*</span></label>
                                                            <select class="form-select fix-section" id="ProdPack" data-role="Product Packaging" required>
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- @*Removable Section*@ --}}
                                                <div>
                                                    <div class="row">
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Quality Engineer </label>
                                                            <select class="form-select removable-section" data-role="Quality Engineer" id="QE">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
        
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Textile Engineer </label>
                                                            <select class="form-select removable-section" data-role="Textile Engineer" id="TE">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>
        
                                                    <div class="row">
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Soft Goods Textile Engineer </label>
                                                            <select class="form-select removable-section" data-role="Soft Goods Textile Engineer" id="SGTE">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
        
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Soft Goods Developer </label>
                                                            <select class="form-select removable-section" data-role="Soft Goods Developer" id="SGDev">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>
        
                                                    <div class="row">
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Logistic Coordinator </label>
                                                            <select class="form-select removable-section" data-role="Logistic Coordinator" id="LC">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
        
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Inventory </label>
                                                            <select class="form-select removable-section" data-role="Inventory" id="Inv">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Production Team </label>
                                                            <select class="form-select removable-section" data-role="Production Team" id="PT">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
        
                                                        <div class="col remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Sewing Machine Operator </label>
                                                            <select class="form-select removable-section" data-role="Sewing Machine Operator" id="SMO">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6 remove-container">
                                                            <label><span style="font-size: 12px; margin-right: 5px;" class="btn btn-danger p-2 mb-0 remove"><i class="fa fa-trash" aria-hidden="true"></i></span> Creative </label>
                                                            <select class="form-select removable-section" data-role="Creative" id="Creative">
                                                                <option selected disabled>-- Select member --</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Get member name based on the role --}}
                                                <script>
                                                    $(document).ready(function() {
                                                        // Define role IDs and dropdown IDs
                                                        var roles = [
                                                            { roleId: 3, dropdownId: '#PE' },
                                                            { roleId: 4, dropdownId: '#ProdDes' },
                                                            { roleId: 5, dropdownId: '#ProdCost' },
                                                            { roleId: 6, dropdownId: '#ProdPack' },
                                                            { roleId: 7, dropdownId: '#QE' },
                                                            { roleId: 8, dropdownId: '#TE' },
                                                            { roleId: 9, dropdownId: '#SGTE' },
                                                            { roleId: 10, dropdownId: '#SGDev' },
                                                            { roleId: 11, dropdownId: '#Creative' },
                                                            { roleId: 12, dropdownId: '#PT' },
                                                            { roleId: 13, dropdownId: '#SMO' },
                                                            { roleId: 14, dropdownId: '#LC' },
                                                            { roleId: 15, dropdownId: '#Inv' }
                                                        ];

                                                        // Function to fetch members for a given role
                                                        function fetchMembersForRole(roleId, dropdownId) {
                                                            $.ajax({
                                                                url: '/get-members/' + roleId,
                                                                type: 'GET',
                                                                success: function(response) {
                                                                    var options = '<option selected disabled>-- Select member --</option>';
                                                                    response.forEach(function(user) {
                                                                        options += '<option value="' + user.us_ID + '">' + user.us_name + '</option>';
                                                                    });
                                                                    $(dropdownId).html(options);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                        }

                                                        // Fetch members for each role using the defined IDs
                                                        roles.forEach(function(role) {
                                                            fetchMembersForRole(role.roleId, role.dropdownId);
                                                        });

                                                        // For removable section
                                                        $('.remove').click(function() {
                                                            $(this).closest('.remove-container').remove();
                                                        });
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous rubik-font" value="Previous" />
                                        <input type="button" name="next" class="next action-button rubik-font" value="Next Step" />

                                    </fieldset>

                                    {{-- @*Project Activity*@ --}}
                                    <fieldset>
                                        <div class="form-card rubik-font">
                                            <h2 class="fs-title text-center" style="color: #5e72e4; opacity: 0.6;">Project Activity</h2>
    
                                            <br />
    
                                            <div>
                                                <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <br />
                                                        <p class="text-dark text-bold mt-2" data-act-name="DSP Start (turnover to Plant)">DSP Start (turnover to Plant) <span class="text-danger">*</span></p>
                                                    </div>
                                                    <div class="col">
                                                        <label>Date</label>
                                                        <input type="date" class="form-control sch-date" onchange="startDate()" id="start" required />
                                                    </div>
                                                    <div class="col">
                                                        <label>Day</label>
                                                        <input type="text" class="form-control" id="startDay" readonly />
                                                    </div>
                                                </div>
                                                <hr class="bg-dark" />
    
                                                
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="KO Meeting">KO Meeting</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateKO" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayKO" readonly />
                                                        </div>
    
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltKO" onchange="startDate()" value="3" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="Fitting Submission">Fitting Submission</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateFS" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayFS" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltFS" onchange="startDate()" value="7" />
                                                        </div>
                                                    </div>
    
                                                    <br />
    
                                                    <div class="row" id="dspFinishRow">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="DSP Finish (Control Drawing & Artwork Complete)">DSP Finish (Control Drawing & Artwork Complete)</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateDSF" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayDSP" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltDSP" onchange="startDate()" value=3 />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="BOM Input">BOM Input</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateBOM" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayBOM" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltBOM" onchange="startDate()" value="4" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="1st Cost Internal">1st Cost Internal</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="date1st" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="day1st" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="lt1st" onchange="startDate()" value="2" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="1st Cost External">1st Cost Ext</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="date1stCost" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="day1stCost" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="lt1stCost" onchange="startDate()" value="2" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="CR Cost Done">CR Cost Done</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateCR" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayCR" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltCR" onchange="startDate()" value="7" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="CR Model Ready">CR Model Ready</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateCRModel" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayCRModel" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltCRModel" onchange="startDate()" value="5" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row cr-packout-section" id="crPackoutRow">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="CR Packout Photo Shot">CR Packout Photo Shot</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateCRPac" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayCRPac" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltCRPac" onchange="startDate()" value="1" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="CR Model Walkthrough">CR Model Walkthrough</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateCRModelW" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayCRModelW" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltCRModelW" onchange="startDate()" value="1" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="CR Model Send">CR Model Send</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateCRModelSend" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayCRModelSend" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltCRModelSend" onchange="startDate()" value="1" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="CR Meeting">CR Meeting</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateCRMeeting" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayCRMeeting" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltCRMeeting" onchange="startDate()" value="7" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row licensor-approval-section" id="licensorApprovalRow">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="Licensor Approval">Licensor Approval</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateLA" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayLA" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltLA" onchange="startDate()" value="14" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="FPR Cost Done">FPR Cost Done</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateFPR" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayFPR" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltFPR" onchange="startDate()" value="7" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="FPR Model Ready">FPR Model Ready</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateFPRModelReady" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayFPRModelReady" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltFPRModelReady" onchange="startDate()" value="13" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row fpr-packout-section" id="fprPackoutRow">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="FPR Packout Photo Shot">FPR Packout Photo Shot</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateFPRPack" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayFPRPack" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltFPRPack" onchange="startDate()" value="1" />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="FPR Model Walkthrough">FPR Model Walkthrough</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateFPRModel" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayFPRModel" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltFPRModel" onchange="startDate()" value=1 />
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="FPR Model Send">FPR Model Send</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateFPRModelSend" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayFPRModelSend" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltFPRModelSend" onchange="startDate()" value="1" />
                                                        </div>
    
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col">
                                                            <br />
                                                            <p class="text-dark mt-2" data-act-name="FPR Meeting">FPR Meeting</p>
                                                        </div>
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control sch-date" id="dateFPRMeeting" readonly />
                                                            <div style="font-size: 10px; font-weight: bold; color: black;" id="note"></div>
                                                        </div>
                                                        <div class="col">
                                                            <label>Day</label>
                                                            <input type="text" class="form-control" id="dayFPRMeeting" readonly />
                                                        </div>
                                                        <div class="col">
                                                            <label>LT</label>
                                                            <input type="number" class="form-control" id="ltFPRMeeting" onchange="startDate()" value="7" />
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <hr class="bg-dark" />
    
                                                {{-- @*Start Tooling Activity*@ --}}
                                                <div id="collapseTooling" class="collapse">
                                                    <div class="card-body px-3 pt-2 pb-3" style="font-family: 'Rubik', sans-serif;">
                                                        <br />
                                                        <h4>Tooling Activity</h4>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br />
                                                                    <p class="text-dark mt-2" data-toolact-name="CDI">CDI</p>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Date</label>
                                                                    <input type="date" class="form-control tool-date" id="DtCDI" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>Day</label>
                                                                    <input type="text" class="form-control" id="dayCDI" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>LT</label>
                                                                    <input type="number" class="form-control" id="ltCDI" onchange="startDate()" value=2 />
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br />
                                                                    <p class="text-dark mt-2" data-toolact-name="1st Digital Review">1st Digital Review</p>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Date</label>
                                                                    <input type="date" class="form-control tool-date" id="Dt1stDR" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>Day</label>
                                                                    <input type="text" class="form-control" id="day1stDR" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>LT</label>
                                                                    <input type="number" class="form-control" id="lt1stDR" onchange="startDate()" value=14 />
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br />
                                                                    <p class="text-dark mt-2" data-toolact-name="Approved Digital">Approved Digital</p>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Date</label>
                                                                    <input type="date" class="form-control tool-date" id="DAppDig" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>Day</label>
                                                                    <input type="text" class="form-control" id="dayAppDig" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>LT</label>
                                                                    <input type="number" class="form-control" id="ltAppDig" onchange="startDate()" value=14 />
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br />
                                                                    <p class="text-dark mt-2" data-toolact-name="Output Model">Output Model</p>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Date</label>
                                                                    <input type="date" class="form-control tool-date" id="DtOutModel" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>Day</label>
                                                                    <input type="text" class="form-control" id="dayOutModel" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>LT</label>
                                                                    <input type="number" class="form-control" id="ltOutModel" onchange="startDate()" value=14 />
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br />
                                                                    <p class="text-dark mt-2" data-toolact-name="Sample Ready to Sent">Sample Ready to Sent</p>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Date</label>
                                                                    <input type="date" class="form-control tool-date" id="DtSRTS" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>Day</label>
                                                                    <input type="text" class="form-control" id="daySRTS" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>LT</label>
                                                                    <input type="number" class="form-control" id="ltSRTS" onchange="startDate()" value=2 />
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br />
                                                                    <p class="text-dark mt-2" data-toolact-name="Final Part Geometry Start">Final Part Geometry Start</p>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Date</label>
                                                                    <input type="date" class="form-control tool-date" id="DtFPGS" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>Day</label>
                                                                    <input type="text" class="form-control" id="dayFPGS" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>LT</label>
                                                                    <input type="number" class="form-control" id="ltFPGS" onchange="startDate()" value=28 />
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br />
                                                                    <p class="text-dark mt-2" data-toolact-name="Final Part Geometry Finish">Final Part Geometry Finish</p>
                                                                </div>
                                                                <div class="col">
                                                                    <label>Date</label>
                                                                    <input type="date" class="form-control tool-date" id="DtFPGF" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>Day</label>
                                                                    <input type="text" class="form-control" id="dayFPGF" readonly />
                                                                </div>
                                                                <div class="col">
                                                                    <label>LT</label>
                                                                    <input type="number" class="form-control" id="ltFPGF" onchange="startDate()" value=14 />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- @*End Tooling Activity*@ --}}
                                            </div>
    
                                            <div class="row">
                                                <div class="col text-bold text-danger text-center"
                                                     style="margin-top: 30px; font-size: 14px; letter-spacing: 1px;"
                                                     id="SLA"></div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col text-bold text-white badge badge-rounded badge-dark"
                                                     style="margin-top: 10px; font-size: 14px; letter-spacing: 1px;"
                                                     id="weeksDifferenceValue"></div>
                                            </div>
    
                                            <div id="delayReasonSection" style="display: none;">
                                                <div class="form-group">
                                                    <label for="delayReason">Reason for Delay: <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control" name="DelayReason" id="delayReason" placeholder="Input Delay Reason"></textarea>
                                                </div>
                                            </div>
    
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous rubik-font" value="Previous" />
                                        <button id="saveDraftButton" name="submitButton" class="action-button draft-btn rubik-font" value="Save as Draft" >Save as Draft</button>
                                        <input type="submit" id="saveChangesButton" name="submitButton" class="action-button submit-btn" value="Save Changes" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
                                


<script src="/js/AddActivity.js"></script>
<script src="/js/moment.js"></script>
{{-- Function for stepper (next and previous) --}}
<script>
    $(document).ready(function () {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function () {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({ 'opacity': opacity });
                },
                duration: 600
            });
        });

        $(".previous").click(function () {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({ 'opacity': opacity });
                },
                duration: 600
            });
        });

    });
</script>


{{-- Function for submit form --}}
<script>
    
    function storeActivity() {
        var projectNumber = $('#ProjectNumber').val();
        var activities = [];

        $('.container > .row:not(#collapseTooling .container .row)').each(function(index) {
            var activityName = $(this).find('.text-dark').attr('data-act-name');
            var activityDate = $(this).find('.sch-date').val();

            activities.push({
                p_projnum: projectNumber,
                a_name: activityName,
                a_sch: activityDate,
            });
        });

        // Get the tooling budget value
        var toolingBudget = parseFloat($('#ToolBdg').val());

        // Check if the tooling budget is greater than 0
        if (toolingBudget > 0) {
            // Iterate through each tooling activity section
            $('#collapseTooling .container').each(function() {
                var activityName = $(this).find('.text-dark').attr('data-toolact-name');
                var activityDate = $(this).find('.tool-date').val();

                // Push tooling activity data to activities array
                activities.push({
                    p_projnum: projectNumber,
                    a_name: activityName,
                    a_sch: activityDate,
                });
            });
        }

        console.log(activities);

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // AJAX request
        $.ajax({
            url: '{{ route("post_activities") }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            data: {
                activities: activities
            }, // Send all activities in one request
            success: function(response) {
                console.log('Data saved:', response);
                // Show a success message or update the UI as needed
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                // Handle error: Show an error message to the user
            }
        });
    }

    function submitForm(status){
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
        }).then((result) => {
            if (result.isConfirmed) {
                // Store the checkboxs value
                var licensedValue = $('#Licensed').is(':checked') ? 1 : 0;
                var crfprValue = $('#CRFPR').is(':checked') ? 1 : 0;
                
                // Member Fix Sections
                var fixedSectionsData = [];
                $(".fix-section").each(function () {
                    fixedSectionsData.push({
                        role: $(this).data("role"),
                        memberId: $(this).val()
                    });
                });

                // Member Removable Sections
                var removedSectionsData = [];
                $(".remove-container").each(function () {
                    var role = $(this).find("select.removable-section").data("role");
                    var memberId = $(this).find("select.removable-section").val();
                    removedSectionsData.push({ role: role, memberId: memberId });
                });

                // If the user clicks "Save," proceed with form submission
                var formData = $("#msform").serialize();
                formData += '&Licensed=' + licensedValue;
                formData += '&CRFPR=' + crfprValue;
                formData += "&fixedSections=" + JSON.stringify(fixedSectionsData);
                formData += "&removedSections=" + JSON.stringify(removedSectionsData);

                $.ajax({
                    type: "POST",
                    url: "{{ route('projects.store') }}",
                    data: formData + '&status=' + status,
                    success: function (response) {
                        console.log(response);

                        storeActivity();

                        Swal.fire({
                            title: 'Saving changes...',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            willClose: () => {
                                window.location.href = "{{ route('project_list') }}";
                            },
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            } else if (result.isDenied) {
                // If the user clicks "Don't save," do nothing or show a message
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    }

    $(".submit-btn").click(function(event) {
        event.preventDefault();
        var status = 'Preliminary';
        submitForm(status);
    });

    $(".draft-btn").click(function(event) {
        event.preventDefault();
        var status = 'Draft';
        submitForm(status);
    });

</script>
@endsection