<!doctype html>
<html lang="fr">
    <head>
        @include('layouts.head')
        <style>
            .head{
                height: 150px;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            }

            .head{
                display: flex;
                align-items: center;
                padding-left:25px;
            }

            .main{
                width:100%;
                height: auto;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            }

            .main #dateExam{
                width:60%;
            }

            .main .custom-input {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
                font-size: 16px;
                width: 100%;
            }

            .main .custom-input:focus {
                outline: none;
                border-color: #007bff;
            }

            .main label {
                display: block;
                margin-bottom: 10px;
            }

            .main .custom-select {
                appearance: none;
                background-color: #f2f2f2;
                border: none;
                border-radius: 5px;
                padding: 10px;
                font-size: 16px;
                width: 200px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .main .custom-select:focus {
                outline: none;
                box-shadow: 0 0 0 2px #007bff;
            }

            .main .custom-select option {
                background-color: white;
                color: black;
            }

            .main .custom-button {
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
            }

            .main .custom-button:hover {
                background-color: #0056b3;
            }

            .main .custom-button:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
            }

            .main .custom-button:active {
                background-color: #004999;
            }
        </style>
    </head>
    <body>
        @include('layouts.sidebar')
        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <header class="head mb-5">
                <h2>Section Filière</h2>
            </header>

            <main class="main mb-5 p-4">
                <h4 class="mb-4">Créer une filière</h4>
                
                <form id="FiliereForm" action="{{ route('insertFiliere') }}" method="POST">
                    @csrf
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <label for="dateInspection" class="form-label">Le nom de la filière</label>
                        <input type="text" name="TitleSector" class="form-control custom-input" id="TitleSector" required>
                    </div>
                    <button type="submit" class="custom-button mt-3">Soumettre</button>
                </form>
            </main>

            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.foot')

    <script>
        $("#FiliereForm").on("submit", function (e) {
            $.ajax({
                type: "POST",
                url: "{{ route('insertFiliere') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    document.getElementById("FiliereForm").reset();
                    alert("Les données sont envoyées correctement");
                },
                error: function (xhr, status, error) {
                    alert("Erreur, veuillez réessayer plus tard");
                }
            });
            e.preventDefault();
        });
    </script>
</body>
</html>