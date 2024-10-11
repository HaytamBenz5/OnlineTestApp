<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link
            href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
            rel="stylesheet">

        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="assets/css/style.css">

    </head>
    <body style="background: url('Background.png'); background-size: cover; background-repeat: no-repeat;">
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <img src="log_suptech.png" alt="" class="heading-section" width="300">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="img" style="background-image: url(logoSlider.svg); background-size:contain;"></div>
                            <div class="login-wrap p-4 p-md-5">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h3 class="mb-4">Sign In</h3>
                                    </div>
                                </div>
                                <form class="signin-form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="label" for="name">Username</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            placeholder="Username"
                                            name="email"
                                            required="required">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="password">Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Password"
                                            name="password"
                                            required="required">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>