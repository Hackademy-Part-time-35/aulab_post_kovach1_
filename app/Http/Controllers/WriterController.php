<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WriterController extends Controller
{
    // Muestra el dashboard del redactor con sus artículos
    public function dashboard(){
        // Obtiene los artículos del redactor autenticado, filtrados por estado
        $articles = Auth::user()->articles()->orderBy('created_at', 'desc')->get();
        $acceptedArticles = $articles->where('is_accepted', true);
        $rejectedArticles = $articles->where('is_accepted', false);
        $unrevisionedArticles = $articles->where('is_accepted', NULL);
        
        // Retorna la vista del dashboard del redactor
        return view('writer.dashboard', compact('acceptedArticles', 'rejectedArticles', 'unrevisionedArticles'));
    }
}

