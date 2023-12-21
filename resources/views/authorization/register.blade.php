<head>
    <link rel="stylesheet" href="/argon/assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <style>
        .border-danger{
            border-color: red;
        }
    </style>
</head>

<body class="bg-primary">
    <main class="main-content">
        <div class="container">
            <div class="row mt-lg-5 justify-content-center align-items-center mx-auto">
                <div class="col-xl-4 col-lg-5 ml-md-5">
                    <div class="card z-index-0 shadow p-3 mb-5">
                        <div class="text-center">
                            <img src="img/logo-login.png" width="400" style="margin-top: -140px;"/>
                            <h5 style="margin-top: -50px;">PROJECT ALCHEMIST</h5>
                            <h5 class="mt-1 text-primary">REGISTER</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit="login" action="{{ route('registerAccount') }}" id="regist-form" method="POST">
                                @csrf
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label>User ID <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input User ID" name="UserID" autofocus />
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input Full Name" name="Name" />
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Role <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                           <select class="form-select" name="GrpID">
                                            <option selected disabled>-- Select Role --</option>
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
                                </div>
                                <div class="form-group mb-4">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input Username" name="Username" required />
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input wire:model="email" type="email" class="form-control"
                                            placeholder="example@gmail.com" id="email" name="Email" required>
                                    </div>
                                    <div id="emailError" class="border-danger text-danger" style="display: none;">Please enter a valid email address.</div>

                                </div>
                                    <div class="form-group mb-4">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input wire:model.lazy="password" type="password" placeholder="Input Password"
                                                class="form-control" name="Password" id="password" required>
                                        </div>
                                    </div>
                            </form>
                            <div class="text-center">
                                <button style="color: white;" type="submit" name="submit" class="btn btn-primary w-100 my-4 mb-2 text-dark" id="regist-btn">Register</button>
                                <p class="mt-1 text-secondary" style="font-size: 14px;">Already have account? <a href="{{ route('login') }}" class="text-info">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    
</body>

<script>
    function validateEmail(email) {
        const re = /\S+@\S+\.\S+/;
        return re.test(String(email).toLowerCase());
    }

    function regist(){
    var formData = $("#regist-form").serialize();
    
    var email = $("#email").val();

    if (!validateEmail(email)) {
        $("#emailError").show();
        $('#email').addClass('border-danger'); // Add border color
        return; // Prevent form submission if email format is invalid
    } else {
        $("#emailError").hide();
        $('#email').removeClass('border-danger'); // Remove border color if email is valid
    }
 
                $.ajax({
                    type: "POST",
                    url: "{{ route('registerAccount') }}",
                    data: formData,
                    success: function (response) {
                        console.log(formData);

                        Swal.fire({
                            title: 'Registration in process...',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            willClose: () => {
                                window.location.href = "{{ route('login') }}";
                            },
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            $("#regist-btn").click(function (event) {
                event.preventDefault();
                regist(); 
            });
</script>