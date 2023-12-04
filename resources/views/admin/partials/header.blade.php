<header class="bg-dark px-3">
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a href="{{ route("home") }}" target="_blank" class="navbar-brand fs-4 btn">Vai al sito <i class="fa-solid fa-square-arrow-up-right"></i></a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                @csrf
                <button class="btn" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
    </nav>
</header>
