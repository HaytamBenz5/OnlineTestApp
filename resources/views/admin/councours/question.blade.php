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
                width: 100%;
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

            .file-input {
                position: relative;
                display: inline-block;
            }

            .file-input__input {
                display: none;
            }

            .file-input__label {
                display: inline-block;
                padding: 10px 20px;
                background-color: #e9e9e9;
                color: #333;
                border-radius: 4px;
                cursor: pointer;
            }

            .file-input__filename {
                display: inline-block;
                margin-left: 10px;
                color: #888;
            }

            @media screen and (min-width: 767px) {
                .main #container{
                    height:300px;
                }
            }

        </style>
    </head>
    <body>
        @include('layouts.sidebar')
        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <header class="head mb-5">
                <h2>Section Concours</h2>
            </header>

            <main class="main mb-5 p-4" id="main">
                <form id="QuestionForm" action="{{ route('insertQuestion') }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="mb-4">Créer une question</h4>

                            <div class="mb-4">
                                <label for="custom-select" class="form-label">Titre de l'exam</label>
                                <select class="custom-select" name="ExamTitle" id="custom-select" required>
                                    <option disabled selected value>Sélectionnez</option>
                                    @foreach($Exams as $Exam)
                                    <option value="{{ $Exam->id }}">{{ $Exam->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="dateInspection" class="form-label">L'image de la question</label>
                                <div class="file-input">
                                    <div class="row ml-1">
                                        <input type="file" id="my-file" name="QuetionImage" class="file-input__input" accept="image/*" onchange="displayFileName()" required>
                                        <label for="my-file" class="file-input__label">Choose File</label>
                                        <span id="file-name" class="file-input__filename mt-2">No file chosen</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="custom-select" class="form-label">Type de question</label>
                                <select class="custom-select" name="QuetionType" id="custom-select" required>
                                    <option disabled selected value>Sélectionnez</option>
                                    <option value="mono">Une seule réponse</option>
                                    <!--<option value="multiple">Plusieurs réponse</option>-->
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="dateInspection" class="form-label">Le temps de réponse</label>
                                <input type="number" name="QuestionTime" class="form-control custom-input" id="QuestionTime" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h4>Les choix de la question</h4>

                            <div class="mb-1">
                                <label for="CorrectAnswwer" class="form-label">La réponse correct</label>
                                <select class="custom-select" name="CorrectAnswwer" id="CorrectAnswwer">
                                    <option disabled selected value>Sélectionnez</option>
                                </select>
                            </div>

                            <div style="text-align: right;">
                                <button type="button" id="addButton" class="btn btn-dark mb-4"><i class="fa fa-plus-circle"></i></button>
                            </div>

                            <div id="container">
                                
                            </div>
                        </div>
                    </div>

                    <div style="text-align: center; width:100%;">
                        <button type="submit" class="custom-button">Soumettre</button>
                    </div>
                </form>
            </main>

            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.foot')

    <script>
        function displayFileName() {
            const fileInput = document.getElementById('my-file');
            const fileName = document.getElementById('file-name');
            fileName.textContent = fileInput.files[0].name;
        }

        document.addEventListener("DOMContentLoaded", function() {
            var main = document.getElementById("main");
            var container = document.getElementById("container");
            var addButton = document.getElementById("addButton");
            var select = document.getElementById("CorrectAnswwer");
            var counter = 0;
            var maxInputs = 6;

            addButton.addEventListener("click", function() {
                if (counter < maxInputs) {
                    counter++;
                    var inputField = document.createElement("input");
                    inputField.type = "text";
                    inputField.setAttribute('name','Choix_'+counter);
                    inputField.classList.add("form-control");
                    inputField.classList.add("custom-input");
                    inputField.classList.add("mb-1");
                    inputField.placeholder = "Choix " + counter;
                    inputField.required = true;
                    container.appendChild(inputField);

                    var option = document.createElement("option");
                    option.value = counter;
                    option.text = "Choix "+ counter;
                    select.appendChild(option);
                }
            });
        });

        $("#QuestionForm").on("submit", function (e) {
            $.ajax({
                type: "POST",
                url: "{{ route('insertQuestion') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    document.getElementById("QuestionForm").reset();
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