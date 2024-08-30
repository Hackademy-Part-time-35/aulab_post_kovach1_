<?php

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
    public static function middleware()
    {
        // return [
        //     new Middleware('auth', except: ['hompage']),
        // ];
    }

    public function homepage(){
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(4)->get();
        $user = Auth::user();

        return view('welcome', compact('articles'), [
            'name' => $user
        ]);
    }

    public function careers(){
        return view('mail.careers');
    }

    public function careersSubmit(Request $request){
        $request->validate([
            'role'=>'required',
            'email'=>'required|email',
            'message'=>'required'
        ]);
        
        $user = Auth::user();
        $role = $request->role;
        $email = $request->email;
        $message = $request->message;
        $info = compact('role', 'email', 'message');

        // Send email using Laravel's Mail facade
        Mail::to('admin@theaulabpost.it')->send(new CareerRequestMail($info));

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

        $user->update();
        return redirect(route('homepage'))->with('message', 'Mail inviata con successo!');
    }
}
