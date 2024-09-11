<div class="col-12 col-md-3 mb-4">
    <div class="card h-100">
        <!-- Muestra la imagen del artículo almacenada en Storage -->
            <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="Immagine dell'articolo: {{ $article->title }}">
            <div class="card-body d-flex flex-column">
                <!-- Muestra el título y subtítulo del artículo -->
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-subtitle">{{ $article->subtitle }}</p>

                <!-- Si el artículo tiene una categoría, muestra el nombre y enlaza a la vista por categoría -->
                    @if ($article->category)
                        <p class="small text-muted mt-auto">Categoria:
                            <a href="{{route('article.byCategory', $article->category)}}" class="text-capitalize text-muted">{{ $article->category->name }}</a>
                        </p>
                    @else
                        <p class="small text-muted">Nessuna Categoria</p>
                    @endif
                
                <!-- Muestra los tags asociados al artículo, precedidos por el símbolo # -->
                    <p class="small text-muted my-0">
                        @foreach ($article->tags as $tag)
                            {{ $tag->name }}
                        @endforeach
                    </p>

                <!-- Muestra el tiempo estimado de lectura del artículo -->
                    <p class="card-subtitle text-muted fst-italic small">Tempo di lettura {{$article->readDuration()}} min</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center bg-primary-subtle" data-bs-theme-value="light">
                <!-- Muestra la fecha de creación del artículo y enlaza al autor -->
                    <p>
                        Redatto il {{ $article->created_at->format('d/m/Y') }} <br>
                        da <a href="{{route('article.byUser', $article->user)}}" class="text-capitalize text-muted">{{ $article->user->name }}</a>
                    </p>
                <!-- Enlace para leer el artículo completo -->
                    <a href="{{route('article.show', $article )}}" class="btn btn-outline-secondary">Leggi</a>
            </div>
    </div>
</div>
