<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/argon/assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Project Alchemist</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Rubik', sans-serif;
        }

        .dataTables_wrapper table.dataTable thead th,
        .dataTables_wrapper table.dataTable tbody td,
        .dataTables_length select,
        .dataTables_filter input,
        .dataTables_info,
        .dataTables_paginate {
            font-family: 'Rubik', sans-serif;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            height: 30px;
            width: 30px;
            padding: 0px;
            margin: 0 0.125rem;
            line-height: 30px;
            text-align: center;
            font-size: 13px;
            vertical-align: middle;
            border-radius: 0.375rem;
            border: 0 !important;
            color: floralwhite !important;
            background: #CBE2C9;
            cursor: pointer;
            box-shadow: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: black;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #92817A;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: white;
            color: black !important;
        }

        .dataTables_info,
        .dataTables_paginate {
            margin-top: 10px;
        }

        table.dataTable thead tr>.dtfc-fixed-left,
        table.dataTable thead tr>.dtfc-fixed-right,
        table.dataTable tfoot tr>.dtfc-fixed-left,
        table.dataTable tfoot tr>.dtfc-fixed-right {
            top: 0;
            bottom: 0;
            z-index: 3;
            background-color: #F684AF;
        }

        table.dataTable tbody tr>.dtfc-fixed-left,
        table.dataTable tbody tr>.dtfc-fixed-right {
            z-index: 1;
            background-color: white;
        }
    </style>
    @yield('head')
</head>

<body class="g-sidenav-show bg-gray-200">
    <div class="min-height-300 position-absolute w-100" style="background-color: #92817A; position: fixed;"></div>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main" style="background-color: #BEDBBB;">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <CENTER>
                <a class="m-0" href="{{ route('dashboard') }}">
                    <img src="/img/alchemist-logo.png" height="150" style="margin-top: -30px;" alt="main_logo">
                </a>
            </CENTER>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'project_list' ? 'active' : '' }}"
                        href="{{ route('project_list') }}">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">Project List</span>
                    </a>
                </li>
                {{-- @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'dashboard_admin' ? 'active' : '' }}"
                        href="{{ route('dashboard_admin') }}">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">Dashboard Admin</span>
                    </a>
                </li>
                @endif --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Summary</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'wip_internal' ? 'active' : '' }}"
                        href="{{ route('wip_internal') }}">
                        <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">WIP Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'wip_external' ? 'active' : '' }}"
                        href="{{ route('wip_external') }}">
                        <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">Weekly Meeting Report</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
            <div class="card card-plain shadow-none" id="sidenavCard">
                <div class="text-center">
                    <svg data-v-26b8dc30="" data-v-7dc7fc7a="" width="150" viewBox="0 0 296 136" fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="tasks-search-results__list--empty-image image-container">
                        <path data-v-26b8dc30="" data-v-7dc7fc7a=""
                            d="M173.968 102.046c2.578 7.241 18.846 30.098 18.879 30.134 11.762 12.421 32.858-8.44 20.285-19.955-.035-.033-22.976-16.328-30.335-18.863"
                            fill="#F03063"></path>
                        <path data-v-26b8dc30="" data-v-7dc7fc7a=""
                            d="M159.871 103.657l7.628 7.591c2.486 2.475 6.46 2.624 9.145.364 5.743-4.834 10.697-10.56 15.691-16.246a6.692 6.692 0 00-.095-8.94c-2.244-2.457-4.069-4.597-7.252-7.767-6.811 9.702-16.362 16.989-25.117 24.998z"
                            fill="#727491"></path>
                        <path data-v-26b8dc30="" data-v-7dc7fc7a=""
                            d="M82.096 74.297C110.818 150.865 211.044 109.04 195.3 42.13c-4.38-18.615-19.526-34.279-38.052-39.811-42.878-12.804-91.015 29.694-75.153 71.98z"
                            fill="#B3B9CE"></path>
                        <path data-v-26b8dc30="" data-v-7dc7fc7a=""
                            d="M97.562 69.648c20.773 55.109 93.264 25.006 81.878-23.153-3.168-13.399-14.123-24.672-27.522-28.654-31.013-9.215-65.83 21.373-54.356 51.807z"
                            fill="#BAF8DD"></path>
                        <path data-v-26b8dc30="" data-v-7dc7fc7a=""
                            d="M115.798 55.87c-1.064 0-1.927-.924-1.927-2.065 0-4.255 3.312-6.655 6.429-6.753 3.435-.109 5.981 2.367 6.181 6.02.062 1.138-.749 2.115-1.811 2.182-1.062.066-1.974-.802-2.036-1.94-.105-1.914-1.437-2.16-2.221-2.134-1.081.034-2.688.76-2.688 2.625 0 1.14-.863 2.065-1.927 2.065zM153.639 55.135c-1.065 0-1.929-.92-1.929-2.054 0-4.396 3.377-6.768 6.554-6.768 1.585 0 3.06.581 4.15 1.635.87.841 1.909 2.38 1.909 4.936 0 1.134-.864 2.054-1.93 2.054-1.065 0-1.929-.92-1.929-2.054 0-.845-.217-1.482-.643-1.894-.38-.367-.932-.569-1.558-.569-.933 0-2.696.556-2.696 2.66.002 1.135-.862 2.054-1.928 2.054zM128.405 72.043c-.293 0-.59-.064-.869-.2-.947-.458-1.324-1.563-.844-2.468 2.054-3.859 6.859-6.273 12.245-6.149 4.851.112 8.731 2.269 10.378 5.771.434.925.002 2.012-.967 2.427-.969.415-2.107.002-2.542-.923-1.025-2.18-3.627-3.528-6.962-3.605-3.203-.073-7.147 1.178-8.724 4.142-.339.638-1.014 1.005-1.715 1.005z"
                            fill="#494E6A"></path>
                    </svg>
                </div>
                <div class="card-body text-center p-3 w-100 pt-0">
                    <div class="docs-info">
                        <h6 class="mb-0">Reminder!</h6>
                        <p class="text-xs font-weight-bold mb-0">Please always update your project</p>
                    </div>
                </div>
            </div>
            <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-dark btn-sm w-100 mb-3">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Log out</span>
                </a>
            </form>
        </div>
    </aside>

    <main class="main-content position-relative border-radius-lg">
        <div class="content">
            @yield('content')
            <!-- This defines a content section -->
        </div>
    </main>
</body>