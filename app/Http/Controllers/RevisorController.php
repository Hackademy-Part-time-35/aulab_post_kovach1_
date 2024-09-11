<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
class RevisorController extends Controller
{
    // Muestra el dashboard del revisor
    public function dashboard(){
        // Obtiene los artículos pendientes de revisión, aceptados y rechazados
        $unrevisionedArticles = Article::where('is_accepted', NULL)->get();
        $acceptedArticles = Article::where('is_accepted', true)->get();
        $rejectedArticles = Article::where('is_accepted', false)->get();
        
        // Retorna la vista con los artículos filtrados por estado
        return view('revisor.dashboard', compact('unrevisionedArticles', 'acceptedArticles', 'rejectedArticles'));
    }

    // Acepta un artículo
    public function acceptArticle(Article $article) {
        $article->is_accepted = true;
        $article->save();
        
        return redirect(route('revisor.dashboard'))->with('message', 'Articolo pubblicato');
    }
    
    // Rechaza un artículo
    public function rejectArticle(Article $article) {
        $article->is_accepted = false;
        $article->save();
        
        return redirect(route('revisor.dashboard'))->with('message', 'Articolo rifiutato');
    }
    
    // Devuelve un artículo a revisión
    public function undoArticle(Article $article) {
        $article->is_accepted = NULL;
        $article->save();
        
        return redirect(route('revisor.dashboard'))->with('message', 'Articolo rimandato in revisione');
    }
}
