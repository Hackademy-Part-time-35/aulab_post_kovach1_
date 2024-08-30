<x-layout :name="$name">
    <div class="container-fluid p-5 bg-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">the aulab post</h1>
                @auth
                    <h1>ciao {{$name->name}}</h1>
                @endauth
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-evenly">
            @if (session('alert'))
                <div class="alert alert-danger">
                    {{session('alert')}}
                </div>
            @endif
            @foreach ($articles as $article)
                <div class="col-12 col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="Immagine dell'articolo: {{ $article->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-subtitle">{{ $article->subtitle }}</p>
                            <p class="small text-muted mt-auto">Categoria:
                                <a href="{{route('article.byCategory', $article->category)}}" class="text-capitalize text-muted">{{ $article->category->name }}</a>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p>
                                Redatto il {{ $article->created_at->format('d/m/Y') }} <br>
                                da <a href="{{route('article.byUser', $article->user)}}" class="text-capitalize text-muted">{{ $article->user->name }}</a>
                            </p>
                            <a href="{{route('article.show', $article )}}" class="btn btn-outline-secondary">Leggi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-footer />
</x-layout>
