<?php

namespace App\Http\Controllers;

use App\Models\Article;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerRequestMail;

namespace App\Http\Controllers;

use App\Models\Article;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerRequestMail;

class PublicController extends Controller implements HasMiddleware
{
    // Define middlewares (aún no implementado)
    public static function middleware()
    {
        // Se puede usar middleware 'auth' para proteger rutas excepto 'homepage'
    }

    // Muestra la página principal con los 4 artículos más recientes aceptados
    public function homepage(){
        // Obtiene los 4 artículos más recientes que han sido aceptados
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(4)->get();
        $user = Auth::user();

        // Retorna la vista 'welcome' pasando los artículos y el usuario autenticado
        return view('welcome', compact('articles'), [
            'name' => $user
        ]);
    }

    // Muestra el formulario de solicitud de trabajo
    public function careers(){
        return view('mail.careers');
    }

    // Procesa el envío de la solicitud de trabajo
    public function careersSubmit(Request $request){
        // Valida los datos del formulario
        $request->validate([
            'role'=>'required',
            'email'=>'required|email',
            'message'=>'required'
        ]);
        
        // Obtiene los datos del formulario y el usuario autenticado
        $user = Auth::user();
        $role = $request->role;
        $email = $request->email;
        $message = $request->message;
        $info = compact('role', 'email', 'message');

        // Envía un correo al administrador con la solicitud de trabajo
        Mail::to('admin@theaulabpost.it')->send(new CareerRequestMail($info));

        // Actualiza el estado del rol del usuario dependiendo de la solicitud
        switch ($role) {
            case 'admin':
                $user->is_admin = NULL;
                break;
            case 'revisor':
                $user->is_revisor = NULL;
                break;
            case 'writer':
                $user->is_writer = NULL;
                break;
        }

        // Guarda los cambios del usuario
        $user->update();
        return redirect(route('homepage'))->with('message', 'Mail inviata con successo!');
    }
}
