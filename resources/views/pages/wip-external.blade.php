@extends('layouts.navbar.sidebar')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    td {
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Weekly Meeting Report'])
<div class="container">
    <center>
        <iframe src="https://giphy.com/embed/xd22iKsu0Wn0Q" style="pointer-events: none;" width="200" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
    </center>
    <div class="card rubik-font p-3">
        <h5 class="card-header">
            Meeting Recap
        </h5>

        <hr>

        <div class="col-3">
            <div class="row">
                <div class="col">
                    <label>Key Date</label>
                    <select id="select_date" class="select2 form-select" data-control="select2" data-live-search="true" aria-label="Default select example">
                        <option disabled selected>-- Select a date --</option>
                        @foreach($keyDates as $keyDate)
                            <option value="{{ $keyDate }}">{{ $keyDate }}</option>
                        @endforeach
                    </select>                                      
                </div>
            </div>
        </div>

        <div class="card-body rubik-font">
            <div class="table-responsive p-0 rubik-font">
                <table id="projectTable" class="display table table-bordered">
                    <thead class="text-white bg-secondary">
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Project #</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Category</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Flag Status</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Prod #</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Product</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">PE</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Season</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Current Milestone</th>
                            <th rowspan="1" colspan="2" style="vertical-align: middle;" class="text-center">CR</th>
                            <th rowspan="1" colspan="2" style="vertical-align: middle;" class="text-center">FPR</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">LA</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">LA Commit</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Notes (Key Updates)</th>
                            {{-- <th rowspan="2" style="vertical-align: middle;" class="text-center">Feedback</th> --}}
                        </tr>

                        <tr>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>

                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Sch</th>
                            <th rowspan="1" style="vertical-align: middle;" class="text-center">Act</th>
                        </tr>

                    </thead>
                    <tbody id="projectTableBody">
                        <tr>
                            <td colspan="15" rowspan="2" style="vertical-align: middle;" class="text-center">No data available</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="/js/moment.js"></script>
<script>
    function loadProductInformation() {
        var keydate = $('#select_date').val();

        $.ajax({
            url: '{{ route("getWIPExtData") }}',
            type: 'GET',
            data: { keydate: keydate },
            success: function (response) {
                // Clear previous table data
                $('#projectTableBody').empty();

                // Loop through the response and populate the table
                $.each(response.projects, function (index, project) {
                    var keyUpdateValue = '';

                    var keyUpdate = response.keyUpdates.find(function(ku) {
                        return ku.p_projnum.toString() === project.p_projnum.toString();
                    });

                    if (keyUpdate) {
                        keyUpdateValue = keyUpdate.ku_keyupdate;
                    }

                    function getBackgroundColor(project) {
                        var laCommitDate = project.activity.find(act => act.a_name === 'Launch Avail' && act.a_act);
                        var mrdDate = moment(project.p_la).add(6, 'days');

                        if (laCommitDate) {
                            var laCommitMoment = moment(laCommitDate.a_act);
                            if (laCommitMoment.isSameOrBefore(mrdDate, 'day')) {
                                return '#00FF00'; // Green color if LA Commit <= MRD + 6 days
                            } else if (laCommitMoment.isAfter(mrdDate, 'day')) {
                                return '#FF0000'; // Red color if LA Commit > MRD + 6 days
                            }
                        }
                        return '#FFFFFF'; // Default color if conditions are not met
                    }

                    var row = '<tr>' +
                        '<td class="text-center">' + project.p_projnum + '</td>' +
                        '<td class="text-center">' + project.p_categories + '</td>' +
                        '<td style="background-color: ' + getBackgroundColor(project) + ';"></td>' +
                        '<td class="text-center">' + project.p_prodnum + '</td>' +
                        '<td class="text-center">' + project.p_desc + '</td>' +
                        '<td class="text-center">' + project.productEngineerName + '</td>' +
                        '<td class="text-center">' + project.p_season + '</td>' +
                        '<td class="text-center">' + project.p_stat + '</td>' +
                        
                        '<td class="text-center" style="background-color: ' + ((project.activity.find(act => act.a_name === 'CR Meeting' && act.a_sch)) ? '#BEDBBB' : 'inherit') + '">' + (project.activity.find(act => act.a_name === 'CR Meeting' && act.a_sch) ? project.activity.find(act => act.a_name === 'CR Meeting').a_sch : '-') + '</td>' +
                        '<td class="text-center">' + (project.activity.find(act => act.a_name === 'CR Meeting' && act.a_act) ? project.activity.find(act => act.a_name === 'CR Meeting').a_act || '-' : '-') + '</td>' +
                        '<td class="text-center" style="background-color: ' + ((project.activity.find(act => act.a_name === 'FPR Meeting' && act.a_sch)) ? '#BEDBBB' : 'inherit') + '">' + (project.activity.find(act => act.a_name === 'FPR Meeting' && act.a_sch) ? project.activity.find(act => act.a_name === 'FPR Meeting').a_sch || '-' : '-') + '</td>' +
                        '<td class="text-center">' + (project.activity.find(act => act.a_name === 'FPR Meeting' && act.a_act) ? project.activity.find(act => act.a_name === 'FPR Meeting').a_act || '-' : '-') + '</td>' +

                        '<td class="text-center">' + project.p_la + '</td>' +
                        '<td class="text-center">' + (project.activity.find(act => act.a_name === 'Launch Avail' && act.a_act) ? project.activity.find(act => act.a_name === 'Launch Avail').a_act || '-' : '-') + '</td>' +
                        '<td style="white-space: pre-line;">' + keyUpdateValue + '</td>' +
                        // '<td></td>' +
                        '</tr>';
                    $('#projectTableBody').append(row);
                });
            },
            error: function () {
                alert("Error while getting project information");
            }
        });
    }

    $(document).ready(function () {
        $('.select2').select2();

        $(document).on('change', '#select_date', function () {
            loadProductInformation();
        });
    });

</script>
@endsection