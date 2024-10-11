<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Soon</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
            rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/timer.css" rel="stylesheet">
    </head>

    <body>
        <!-- ======= Header ======= -->
      
        <header id="header" class="d-flex align-items-center">
            
            <div class="container d-flex flex-column align-items-center">
                <img src="log_suptech.png" alt="" class="heading-section mb-5" width="300">
               
                <div class="p-3 mb-5" style="display:flex; justify-content:flex-end;">
                <a href="{{route('profile.edit')}}">
                    <i class="bi bi-person-circle" style="font-size:3rem; padding-right:20px;"></i>
                </a>
            </div>
                <h1>Concours</h1>
                <h2>l'examen commencera dans</h2>
                <div class="countdown d-flex justify-content-center" data-count="{{ $Exam->exam_date }}">
                    <div>
                        <h3>%d</h3>
                        <h4>Jours</h4>
                    </div>
                    <div>
                        <h3>%h</h3>
                        <h4>Heures</h4>
                    </div>
                    <div>
                        <h3>%m</h3>
                        <h4>Minutes</h4>
                    </div>
                    <div>
                        <h3>%s</h3>
                        <h4>Seconds</h4>
                    </div>
                </div>
            </div>
        </header>
        <!-- End #header -->

        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/timer.js"></script>

    </body>

</html>