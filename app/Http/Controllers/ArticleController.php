<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return[new Middleware('auth',except: ['index', 'show', 'byCategory', 'byUser', 'articleSearch']),];
    }

    // Muestra los artículos aceptados
    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at','desc')->get();
        return view('article.index', compact('articles'));
    }

    // Muestra los artículos por categoría
    public function byCategory(Category $category){
        $articles = $category->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.byCategory', compact('category', 'articles'));
    }

    // Muestra los artículos escritos por un usuario
    public function articleByUser(User $user)
    {
        $articles = $user->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.redattore', compact('articles', 'user'));
    }

    // Búsqueda de artículos
    public function articleSearch(Request $request){
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->orderBy('created_at', 'desc')->get();

        return view('article.search-index', compact('articles', 'query'));
    }

    // Retorna la vista para crear un artículo
    public function create(){
        return view('article.create');
    }

    // Almacena un nuevo artículo
    public function store(Request $request){
        $request->validate( [
            'title' => 'required|unique:articles|min:5',
            'subtitle' => 'required|min:5',
            'body' => 'required|min:10',
            'image' => 'required|image',
            'category' => 'required',
            'tags' => 'required',
        ]);

        $article = Article::create( [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'image' => $request->file('image')->store('public/images'),
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->title),
        ]);

        // Procesa los tags
        $tags = explode(',', $request->tags);
        foreach ($tags as $i => $tag) {
            $tags[$i] = trim($tag);
        }

        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate(['name' => strtolower($tag)]);
            $article->tags()->attach($newTag);
        }

        return redirect(route('homepage'))->with('message', 'Articolo creato con successo');
    }

    // Muestra un artículo
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    // Edita un artículo si el usuario es el autor
    public function edit(Article $article)
    {
        if (Auth::user()->id != $article->user_id) {
            return redirect()->route('homepage')->with('alert', 'Accesso non consentito');
        }
        return view('article.edit', compact('article'));
    }

    // Actualiza un artículo
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|min:5|unique:articles,title,' . $article->id,
            'subtitle' => 'required|min:5',
            'body' => 'required|min:10',
            'image' => 'image',
            'category' => 'required',
            'tags' => 'required',
        ]);

        $article->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title),
        ]);

        // Si se sube una nueva imagen, elimina la anterior
        if ($request->image) {
            Storage::delete($article->image);
            $article->update([
                'image' => $request->file('image')->store('public/images'),
            ]);
        }

        // Actualiza los tags
        $tags = explode(',', $request->tags);
        foreach ($tags as $i => $tag) {
            $tags[$i] = trim($tag);
        }

        $newTags = [];
        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate(['name' => strtolower($tag)]);
            $newTags[] = $newTag->id;
        }
        $article->tags()->sync($newTags);

        return redirect(route('writer.dashboard'))->with('message', 'Articolo modificato con successo');
    }

    // Elimina un artículo
    public function destroy(Article $article)
    {
        foreach ($article->tags as $tag) {
            $article->tags()->detach($tag);
        }
        $article->delete();
        return redirect()->back()->with('message', 'Articolo cancellato con successo');
    }
}
