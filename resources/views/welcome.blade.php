<x-layout :name="$name">
    <div class="container-fluid p-5 text-center bg-primary-subtle">
        <div class="row justify-content-center ">
            <div class="col-12">
                <h1 class="display-1 text-dark montserrat-medium">The Aulab Post</h1>
                @auth
                    <h1 class="text-dark montserrat-uniquifier">Ciao {{$name->name}}!</h1>
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
               <x-article-card :article="$article"/>
            @endforeach
        </div>
    </div>
    <x-footer />
</x-layout>
