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
                width: 270px;
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

            /* Custom Table Style */
            #dataTable {
                border-collapse: collapse;
                width: 100%;
            }

            #dataTable th,
            #dataTable td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            #dataTable thead th {
                background-color: #f2f2f2;
            }

            #dataTable tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            /* Search Box Style */
            #searchInput {
                padding: 8px;
                width: 200px;
            }
        </style>
    </head>
    <body>
        @include('layouts.sidebar')
        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <header class="head mb-5">
                <h2>Section etudiants</h2>
            </header>

            <main class="main mb-5 p-4">
                <h4 class="mb-4">Liste des étudiants </h4>
                
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom et prénom</th>
                            <th>Email</th>
                            <th>Date de création</th>
                            <th>Outils</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Users as $User)
                            <tr>
                                <td>{{$Val++}}</td>
                                <td>{{$User->name}}</td>
                                <td>{{$User->email }}</td>
                                @if($User->sector)
                                    <p>Sector: {{ $User->sector->Name }}</p>
                                @else
                                    <p>No sector assigned</p>
                                @endif

                                <td>{{$User->created_at}}</td>

                                <td class="text-center">
                                    <a href="{{ route('UserResultat', ['id' => $User->id]) }}">
                                        <button type="submit" class="btn btn-success mr-2 mb-2">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('ViewUser', ['id' => $User->id]) }}">
                                        <button type="submit" class="btn btn-primary mr-2 mb-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('deleteUser', ['id' => $User->id]) }}">
                                        <button type="submit" class="btn btn-danger mb-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>

            @include('layouts.footer')
        </div>
    </div>
    
    @include('layouts.foot')

    <script>
        $(document).ready(function () {
            // Initialize DataTable
            var table = $('#dataTable').DataTable();

            // Add search functionality
            $('#searchInput').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
</body>
</html>