@extends('layouts.navbar.sidebar')

@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
{{-- Using Datatable from JQuery --}}
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="/css/WIP.css" rel="stylesheet" />
<link href="/css/ProjectDetail.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    * {
        box-sizing: border-box;
    }

    td {
        vertical-align: middle;
    }

    button.check,
    button.cancel,
    button.cost-check,
    button.cost-cancel {
        display: none;
    }

    .mt-1 {
        margin-top: 1rem;
    }

    th {
        vertical-align: middle !important;
    }
</style>
@endsection

@section('content')
@include('layouts.navbar.topnav', ['title' => 'WIP Report'])
<div class="container">

    <div class="row pb-3 mt-3">
        <div class="col">
            <label style="font-size: 14px; color: #EBF2E1;" class=""><i>Category</i></label>
            <select id="select_category" class="select2 form-select" data-control="select2" data-live-search="true">
                <option selected disabled>-- Select Category --</option>
                <option value="Upper Body Clothing">Upper Body Clothing</option>
                <option value="Lower Body Clothing">Lower Body Clothing</option>
                <option value="Undergarments">Undergarments</option>
                <option value="Swimwear">Swimwear</option>
            </select>
        </div>
        <div class="col">
            <label style="font-size: 14px; color: #EBF2E1;" class=""><i>Prod #</i></label>
            <select id="select_prodnum" class="select2 form-control" data-control="select2" data-live-search="true">
                <option selected disabled value="null">-- Select Product Number --</option>
            </select>
        </div>
    </div>

    <input type="hidden" id="pNum">

    <div class="card rubik-font">
        <h5 class="card-header">
            <p>Product:</p>
            <span style="color: #0A5C36;" id="asst"></span> <span style="color: #0A5C36;" class="text-uppercase" id="prodno"></span> <span style="color: #0A5C36;" id="proddesc"></span> <span class="text-uppercase" style="float: right; color: #588157;" id="brand"></span>
        </h5>
        <div class="card-body rubik-font">

            <CENTER class="p-0">
                <table id="WIPTable" class="table display table-bordered rubik-font mt-1 p-1">
                    <thead class="text-center">
                        <tr>
                            <th>Prod #</th>
                            <th>Retail</th>
                            <th>Target Cost</th>
                            <th>Current Cost <span><a class="ml-2 mt-2" style="cursor: pointer; color: #EBF2E1; font-size: 18px; vertical-align: middle;" title="Add Current Cost" data-bs-toggle="modal" data-bs-target="#addCurrentCost"><i class="fas fa-plus-circle"></i></a></span></th>
                            <th>Var</th>
                            <th>DSP (F)</th>
                            <th>1st Cost</th>
                            <th>CR Cost Done</th>
                            <th>CR</th>
                            <th>FPR</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #BEDBBB;" class="text-center">
                        <tr>
                            <td id="prodnum" class="text-dark text-bold">-</td>
                            <td id="srp" class="text-dark text-bold">-</td>
                            <td id="tgtcost" class="text-dark text-bold">-</td>
                            <td id="crncost" class="text-dark text-bold">-</td>
                            <td id="var" class="text-dark text-bold">-</td>
                            <td id="dspf" class="text-dark text-bold">-</td>
                            <td id="costext" class="text-dark text-bold">-</td>
                            <td id="crcostdone" class="text-dark text-bold">-</td>
                            <td id="crmeet" class="text-dark text-bold">-</td>
                            <td id="fprmeet" class="text-dark text-bold">-</td>
                        </tr>
                        <tr></tr>
                    </tbody>
                </table>


                <div class="row">
                    {{-- Display Product Detail - Members --}}
                    <table class="table-bordered rubik-font" style="width: 20%;">
                        <tr>
                            <th class="tbl">Complexity</th>
                            <td class="info" id="cmplx"></td>
                        </tr>
                        <tr>
                            <th class="tbl">LA/LQ</th>
                            <td class="info" id="la"></td>
                        </tr>
                        <tr>
                            <th class="tbl">Quota (K)</th>
                            <td class="info" id="quota"></td>
                        </tr>
                        <tr>
                            <th class="tbl">Plant PE</th>
                            <td class="info" id="pe"></td>
                        </tr>
                        <tr>
                            <th class="tbl">Plant Design</th>
                            <td class="info" id="designer"></td>
                        </tr>
                        <tr>
                            <th class="tbl">Plant Pkg</th>
                            <td class="info" id="pkg"></td>
                        </tr>
                        <tr>
                            <th class="tbl">Plant Cost</th>
                            <td class="info" id="cost"></td>
                        </tr>
                        <tr>
                            <th class="tbl">Plant Creative</th>
                            <td class="info" id="creative"></td>
                        </tr>
                        <tr>
                            <th class="tbl">Plant SG TE</th>
                            <td class="info" id="sgte"></td>
                        </tr>
                    </table>

                    {{-- Display Product Photo --}}
                    <div class="col-md-7 rubik-font" style="margin-right: -15px;">
                        <CENTER>
                            {{-- @*Product Image*@ --}}
                            <div class="card border-1" id="product-card-container">
                                <h3 class="mt-3 text-center"><b style="color: #0A5C36;">Product Image</b></h3>
                                <hr class="bg-dark" />

                                <div id="carouselExampleIndicators" class="carousel slide mx-auto mb-5 mt-3" data-bs-ride="carousel" data-bs-interval="8000" style="max-width: 600px; height: 420px;">
                                    <div class="carousel-indicators" id="carouselIndicators">

                                    </div>
                                    {{-- @*Image Container*@ --}}
                                    <div class="p-2 bg-white rounded carousel-inner" id="carouselInner">
                                        <div class="carousel-item active"><svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="600" height="400" xmlns="https://cdn3d.iconscout.com/3d/premium/thumb/no-photo-5590994-4652997.png" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Product Image</title><rect width="100%" height="100%" fill="#666"></rect><CENTER><text x="50%" y="50%" fill="#444" dy=".3em">Image Not Found.</text></CENTER></svg></div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="slider-arrow" aria-hidden="true" style="color: #0A5C36;" title="Previous Product">&#8249;</span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="slider-arrow" aria-hidden="true" style="color: #0A5C36;" title="Next Product">&#8250;</span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                    <!-- Overlay div for icons -->
                                    <div class="image-overlay"><ul class="icon-right"><li><a class="text-white"><i class="fa fa-search-plus"></i></a></li><li><a class="text-white"><i class="fa fa-trash"></i></a></li></ul></div>
                                </div>
                                
                            </div>
                        </CENTER>
                    </div>

                    {{-- @*Display Product Key Updates*@ --}}
                    <div class="col">
                        <div class="card border-1 p-2">
                            <h5 class="mt-3 text-center">
                                <b style="color: #8DB596; ">Key Updates</b>
                                
                                    <span><a class="ml-2 btn mt-2" style="background-color: #CBE2C9; color: #707070;" data-bs-toggle="modal" data-bs-target="#addKeyUpdate"><i class="fas fa-plus"></i></a></span>
                                
                            </h5>
                            <hr class="bg-dark" />
                            <div class="card" id="product-key-updates"></div>
                        </div>
                    </div>

                </div>
            </CENTER>

            {{-- @*Modal Add Current Cost*@ --}}
            <div class="modal fade" id="addCurrentCost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Current Cost</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label class="col-form-label">Input Current Cost: </label>
                                    <input type="number" step="0.01" class="form-control activity-input" id="crnxfty" style="font-size: 13px;" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary current-cost" id="current-cost">Save change</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @*Modal Add Key Updates*@ --}}
            <div class="modal fade" style="color: black;" id="addKeyUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Key Update</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <h3><b>Project Number: <span id="projnum"></span></b></h3>
                                <hr class="bg-dark" />
                                <p>Update</p>
                                <textarea name="" class="form-control" id="key-update" cols="30" rows="5"></textarea>
                                <br>
                                <p>Key Date</p>
                                <input type="date" class="form-control" name="" id="dateInput">
                                <br>
                                <p>Shown at</p>
                                <label class="form-check-label" style="color: black;">
                                    <input type="checkbox" class="form-check-input" name="" id="shown-at" value="1" />
                                    <span class="custom-checkbox"></span>
                                    WIP External
                                </label>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="add" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @*Modal Edit Key Updates*@ --}}
            <div class="modal fade" id="editKeyUpdate" style="color: black;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Key Update</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <h3><b>Project Number: <span id="projNo"></span></b></h3>
                                <hr class="bg-dark" />
                                <p>Update</p>
                                <textarea name="" class="form-control" id="edit-key" cols="30" rows="5"></textarea>
                                <br>
                                <p>Key Date</p>
                                <input type="date" class="form-control" name="" id="edit-date">
                                <br>
                                <p>Shown at</p>
                                <label class="form-check-label" style="color: black;">
                                    <input type="checkbox" class="form-check-input" name="" id="edit-shown-at" value="1" />
                                    <span class="custom-checkbox"></span>
                                    WIP External
                                </label>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="edit-btn" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('layouts.footer.footer')
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="/js/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

 
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
    $(document).ready(function () {
        var selectCategory = $("#select_category");
        var selectProdNum = $("#select_prodnum");

        selectCategory.change(function () {
            var selectedCategory = selectCategory.val();
            selectProdNum.empty();

            if (selectedCategory) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('get_prodnum') }}",
                    data: { selectedCategory: selectedCategory },
                    success: function (data) {
                        selectProdNum.append("<option selected disabled value='null'>-- Select Product Number --</option>");
                        $.each(data, function (index, value) {
                            selectProdNum.append("<option value='" + value + "'>" + value + "</option>");
                        });
                    }
                });
            }
        });
    });
</script>

<script>
    function loadProductInformation() {
        var prodNum = $('#select_prodnum').val();
        var dataInput = { prodNum: prodNum };

        $.ajax({
            url: "{{ route('get_wip') }}",
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: dataInput,
            success: function (response) {
                var asst = response.projectData.p_projnum;
                var prodno = response.projectData.p_prodnum.toUpperCase();
                var proddesc = response.projectData.p_desc;

                // Concatenate values with dashes
                var combinedValues = asst + ' - ' + prodno + ' - ' + proddesc;

                $('#asst').text(combinedValues);
                $('#brand').text(response.projectData.p_categories);
            
                $('#pNum').text(response.projectData.p_projnum);
                $('#projnum').text(response.projectData.p_projnum);
                $('#prodnum').text(response.projectData.p_prodnum);
                $('#srp').text(response.projectData.p_retail);
                $('#tgtcost').text(response.projectData.p_tgtcost);
                $('#crncost').text(response.projectData.p_crncost);
                $('#cmplx').text(response.projectData.p_complx);
                $('#la').text(response.projectData.p_la);
                $('#quota').text(response.projectData.p_quota);
            
                // Get related activity date
                $('#dspf').text(response.scheduleData['DSP Finish (Control Drawing & Artwork Complete)'] || '-');
                $('#costext').text(response.scheduleData['1st Cost External'] || '-');
                $('#crcostdone').text(response.scheduleData['CR Cost Done'] || '-');
                $('#crmeet').text(response.scheduleData['CR Meeting'] || '-');
                $('#fprmeet').text(response.scheduleData['FPR Meeting'] || '-');

                // Get variance value
                var tgtCost = parseFloat(response.projectData.p_tgtcost);
                var crnCost = parseFloat(response.projectData.p_crncost);

                if (!isNaN(tgtCost) && !isNaN(crnCost)) {
                    var variance = tgtCost - crnCost;
                    $('#var').text(variance.toFixed(2)); // Display variance with two decimal places
                } else {
                    $('#var').text('-'); // Display '-' if values are not numeric
                }

                // Get assigned member
                $.ajax({
                    url: "{{ route('get_member') }}",
                    type: 'GET',
                    data: { projectNumber: response.projectData.p_projnum },
                    success: function (memberResponse) {
                        updateMemberName('Product Engineer', memberResponse, 'pe');
                        updateMemberName('Product Designer', memberResponse, 'designer');
                        updateMemberName('Product Packaging', memberResponse, 'pkg');
                        updateMemberName('Product Costing', memberResponse, 'cost');
                        updateMemberName('Creative', memberResponse, 'creative');
                        updateMemberName('Soft Goods Textile Engineer', memberResponse, 'sgte');
                    },
                    error: function () {
                        console.log("Error while fetching member names.");
                    }
                });

                // Get image
                $.ajax({
                    url: "{{ route('getToyPhotoPresent') }}", // Update with your route for fetching image URLs
                    type: 'GET',
                    data: { projectNumber: response.projectData.p_projnum },
                    success: function (data) {
                        var carouselInner = $("#carouselInner");
                        var carouselIndicators = $("#carouselIndicators");

                        carouselInner.empty();
                        carouselIndicators.empty();

                        if (data.imageUrls.length > 0) {
                            data.imageUrls.forEach(function (imageUrl, index) {
                                var activeClass = index === 0 ? "active" : "";

                                carouselInner.append(
                                    `<div class="carousel-item ${activeClass}">
                                        <div class="rounded-frame" style="width: 600px; height: 400px; overflow: hidden; background-color: white;">
                                            <div class="image-container">
                                                <a class="image-popup-vertical-fit">
                                                    <img src="{{ asset('uploads/scheduler-img/') }}/${imageUrl}" class="d-block mx-auto" height="400" style="object-fit: contain;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>`
                                );

                                carouselIndicators.append(`<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${index}" class="${activeClass}" aria-label="Slide ${index + 1}"></button>`);
                            });

                        

                        } else {
                            carouselInner.append('<div class="carousel-item active"><img src="https://media.istockphoto.com/id/1392182937/vector/no-image-available-photo-coming-soon.jpg?s=612x612&w=0&k=20&c=3vGh4yj0O2b4tPtjpK-q-Qg0wGHsjseL2HT-pIyJiuc=" class="d-block w-100" width="800" height="400" alt="Image Not Found"></div>');
                        }
                    },
                    error: function () {
                        console.log("Error while getting photo");
                    }
                });

                // Get key updates
                var keyUpdatesData = response.keyUpdatesData;

                $('#product-key-updates').empty();

                if (keyUpdatesData && keyUpdatesData.length > 0) {
                    for (var i = 0; i < keyUpdatesData.length; i++) {
                        var keyUpdate = keyUpdatesData[i].ku_keyupdate;
                        var keyDate = keyUpdatesData[i].ku_keydate;
                        var keyUpdateContainer = $('<div class="card border-3 border-primary mb-3"></div>');
                        var cardBody = $('<div class="card-body" style="font-size: 13px; padding: 5px; text-align: left; white-space: pre-line;"></div>');

                        cardBody.text(moment(keyDate).format('MM/DD/YY') + '\n\n' + keyUpdate);

                        var button = $('<div class="text-center"><a class="btn btn-primary edit-key-update text-white mt-3 mb-0 mr-1" data-bs-toggle="modal" title="Edit Record" data-bs-target="#editKeyUpdate"><i class="fas fa-edit"></i></a><button class="btn btn-danger delete-key-update text-white mt-3 mb-0" title="Delete Record"><i class="fas fa-trash-alt"></i></button></div>');

                        if (button) {
                            cardBody.append(button);
                        }

                        keyUpdateContainer.append(cardBody);
                        $('#product-key-updates').append(keyUpdateContainer);
                    }
                }


            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    function updateMemberName(role, members, elementId) {
        var member = members.find(function (m) {
            return m.role_name === role;
        });

        var memberName = member ? member.user.us_name : "-";

        $('#' + elementId).text(memberName);
    }

    $(document).ready(function () {
        // Trigger the function on change of select_toynum
        $(document).on('change', '#select_prodnum', function () {
            loadProductInformation();
        });

        $('#add').click(function () {
            var projnum = $('#projnum').text();
            var keyUpdates = $('#key-update').val();
            var keyDate = $('#dateInput').val();
            var shownAt = $('#shown-at').prop('checked') ? '1' : '0';

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('add_key_update') }}",
                data: {
                    projnum: projnum,
                    keyUpdates: keyUpdates,
                    keyDate: keyDate,
                    shownAt: shownAt
                },
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Key updates added successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#addKeyUpdate').modal('hide');
                        loadProductInformation();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error while adding key updates: ' + data.message,
                        })
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error occurred.',
                    })
                }
            });
        });

        $(document).on('click', '.edit-key-update', function () {
            var keyUpdateDescription = $(this).closest('.card-body').text();
            var projectNumber = $('#pNum').text();

            // Extracting keyUpdate from keyUpdateDescription
            var keyUpdate = keyUpdateDescription.split('\n\n')[1]; // Assuming the keyUpdate is after the double line break

            // Make sure to trim whitespace and remove any leading/trailing whitespace
            keyUpdate = keyUpdate.trim();

            $.ajax({
                url: '/getKeyUpdateData', // Update with your route for fetching key update data
                type: 'GET',
                data: { projectNumber: projectNumber, keyUpdate: keyUpdate },
                success: function (response) {
                    if (response) {
                        $('#projNo').text(response.p_projnum);
                        $('#edit-key').val(response.ku_keyupdate);
                        var date = response.ku_keydate ? new Date(response.ku_keydate) : null;
                        $('#edit-date').val(date ? date.toISOString().split('T')[0] : '');
                        $('#edit-shown-at').prop('checked', response.shown_at === 'WIP External');
                        // $('#editKeyUpdate').modal('show');
                    } else {
                        console.log('No data received.');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus);
                    console.log('Error details: ' + errorThrown);
                }
            });
        });

        $(document).on('click', '#edit-btn', function() {
            var projectNumber = $('#projNo').text();
            var keyUpdateDescription = $('#edit-key').val();
            var keyDate = $('#edit-date').val();
            var shownAt = $('#edit-shown-at').is(":checked") ? 'WIP External' : 'WIP Internal';

            // Create an object to send the updated data to the server
            var updatedData = {
                projectNumber: projectNumber,
                updatedKey: keyUpdateDescription,
                updatedDate: keyDate,
                updatedShownAt: shownAt
            };

            console.log(updatedData);
            // Make an AJAX POST request to update the data
            $.ajax({
                url: '/updateKeyUpdateData',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: updatedData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Actual date updated successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#editKeyUpdate').modal('hide');
                        loadProductInformation();
                    } else {
                        alert('Data update failed');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus);
                    console.log('Error details: ' + errorThrown);
                }
            });
        });

        $(document).on('click', '.delete-key-update', function () {
            var keyUpdateDescription = $(this).closest('.card-body').text().trim();
            var projectNumber = $('#pNum').text();
            var keyUpdate = keyUpdateDescription.split('\n\n')[1].trim();

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
                        url: '/deleteKeyUpdate', // Update this with your actual route for deletion
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: { projectNumber: projectNumber, keyUpdate: keyUpdate },
                        success: function (response) {
                            if (response.success) {
                                $(this).closest('.card').remove();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: '"' + keyUpdate + '" deleted successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                loadProductInformation();
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
                        text: "Key update is not deleted.",
                        icon: "error"
                    });
                }
            });
        });

        $(document).on('click', '#current-cost', function() {
            var projectNo = $('#pNum').text();
            var costValue = $('#crnxfty').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("updateCost") }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    projectNumber: projectNo,
                    cost: costValue
                },
                success: function(response) {
                    if (response.success) {
                        // Update successful
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Current cost updated successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#addCurrentCost').modal('hide');
                        loadProductInformation();
                    } else {
                        // Handle failure
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error while updating current cost.',
                        });
                    }
                },
                error: function(error) {
                    // Handle AJAX error
                    console.error('AJAX Error:', error);
                }
            });
        });

    });

</script>


@endsection