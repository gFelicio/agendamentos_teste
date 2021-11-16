<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('patients.index') }}"
                            class="nav-link">
                            Ver Pacientes
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('schedules.index') }}"
                            class="nav-link">
                            Ver Agendamentos
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout"
                                class="nav-link"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                Sair
                            </a>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link">Cadastrar</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>