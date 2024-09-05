<x-layout>
    <div class="container-fluid p-5  text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1 text-capitalize montserrat-medium">{{ $category->name }}</h1>
            </div>
        </div>
    </div>
    
    <div class="container my-5">
        <div class="row justify-content-evenly">
            @foreach ($articles as $article)
                <div class="col-12 col-md-3 mb-4">
                    <div class="card h-100" style="width: 18rem;">
                        <img src="{{Storage::url($article->image)}}" class="card-img-top" 
                             alt="Immagine dell'articolo: {{ $article->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-subtitle">{{ $article->subtitle }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            
                            
                            <p class="small text-muted my-0">
                                @foreach ($article->tags as $tag)
                                    #{{ $tag->name }}
                                @endforeach
                            </p>
                            <p>
                                Redatto il {{ $article->created_at->format('d/m/Y') }} <br>
                                da {{ $article->user->name }}
                            </p>
                            <a href="{{ route('article.show', $article) }}" class="btn btn-outline-secondary">Leggi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <x-footer />
</x-layout>