<x-layout>
    <div class="container-fluid p-5 text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1 montserrat-medium">Tutti gli articoli per {{ $query }}</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-evenly">
            @foreach ($articles as $article)
                <x-article-card :article="$article"/>
            @endforeach
        </div>
    </div>
    <x-footer />
</x-layout>
