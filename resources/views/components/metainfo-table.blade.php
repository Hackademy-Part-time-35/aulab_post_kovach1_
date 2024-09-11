<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome tag</th>
            <th scope="col">Q.tà articoli collegati</th>
            <th scope="col">Aggiorna</th>
            <th scope="col">Cancella</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($metaInfos as $metaInfo)
            <tr>
                <th scope="row">{{ $metaInfo->id }}</th>
                <td>{{ $metaInfo->name }}</td>
                <td>{{ count($metaInfo->articles) }}</td>

                <!-- Si el tipo de metadata es 'tags', muestra el formulario para editar o eliminar tags -->
                @if ($metaType == 'tags')
                    <td>
                        <form action="{{ route('admin.editTag', ['tag' => $metaInfo ]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" placeholder="Nuovo nome tag" class="form-control w-50 d-inline">
                            <button type="submit" class="btn btn-secondary">Aggiorna</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.deleteTag', ['tag' =>  $metaInfo]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                @else
                    <!-- Si el tipo de metadata es 'category', muestra el formulario para editar o eliminar categorías -->
                    <td>
                        <form action="{{ route('admin.editCategory', ['category' => $metaInfo ]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" value="{{$metaInfo->name}}" name="name" placeholder="Nuovo nome Categoria " class="form-control w-50 d-inline">
                            <button type="submit" class="btn btn-secondary">Aggiorna</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.deleteCategory', ['category' =>  $metaInfo]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
