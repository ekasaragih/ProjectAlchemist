<head>
    <link rel="stylesheet" href="/argon/assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
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
                            <h5 class="mt-1 text-primary">LOGIN</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('login') }}" id="login-form" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label>Username</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input Username" name="Username" autofocus />
                                    </div>
                                    {{-- @error('email') <div wire:key="form" class="invalid-feedback"> {{$message}} </div> --}}
                                    {{-- @enderror --}}
                                </div>
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                           
                                            <input wire:model.lazy="password" type="password" placeholder="Input Password"
                                                class="form-control" id="password" name="Password" required>
                                        </div>
                                        {{-- @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror --}}
                                    </div>
                                    <div class="d-flex justify-content-between align-items-top">
                                        <div class="form-check">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button style="color: white;" type="submit" name="submit" class="btn btn-primary w-100 my-4 mb-2 text-dark" id="login-btn">Login</button>
                                    <p class="mt-1 text-secondary" style="font-size: 14px;">Don't have an account? <a href="{{ route('register') }}" class="text-info">Register</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
