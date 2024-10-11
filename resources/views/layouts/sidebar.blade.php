<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4 pt-5">
            <h1>
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('log_suptech.png') }}" width="150"/>
                </a>
            </h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li>
                    <a
                        href="#filiereSubmenu"
                        data-toggle="collapse"
                        aria-expanded="false"
                        class="dropdown-toggle">Section Filière</a>
                    <ul class="collapse list-unstyled" id="filiereSubmenu">
                        <li>
                            <a href="{{ route('filiere_section') }}">Créer une filière</a>
                        </li>

                        <li>
                            <a href="{{ route('filiere_list') }}">Voir les filières</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a
                        href="#homeSubmenu"
                        data-toggle="collapse"
                        aria-expanded="false"
                        class="dropdown-toggle">Section Concours</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ route('exam_section') }}">Créer un examen</a>
                        </li>
                        <li>
                            <a href="{{ route('question_section') }}">Créer une question</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('List_users') }}">Liste Etudiants</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" onclick="event.preventDefault();this.closest('form').submit();">logout</a>
                    </form>
                </li>
            </ul>
        </nav>