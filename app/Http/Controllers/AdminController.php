<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;

class AdminController extends Controller
{
    // Método para mostrar el dashboard de administración
    public function dashboard( ){
        // Obtiene todos los usuarios que no son administradores
        $adminRequests = User::where('is_admin', NULL)->get();
        
        // Obtiene todos los usuarios que no son revisores
        $revisorRequests = User::where('is_revisor', NULL)->get();
        
        // Obtiene todos los usuarios que no son redactores
        $writerRequests = User::where('is_writer', NULL)->get();
        
        // Retorna la vista con las listas de usuarios
        return view('admin.dashboard', compact('adminRequests', 'revisorRequests', 'writerRequests'));
    }

    // Asigna el rol de administrador a un usuario
    public function setAdmin(User $user) {
        // Marca el usuario como administrador
        $user->is_admin = true;
        $user->save();
    
        // Redirige al dashboard con un mensaje de éxito
        return redirect(route('admin.dashboard'))->with('message', "Hai reso $user->name amministratore");
    }
    
    // Asigna el rol de revisor a un usuario
    public function setRevisor(User $user) {
        $user->is_revisor = true;
        $user->save();
    
        return redirect(route('admin.dashboard'))->with('message', "Hai reso $user->name revisore");
    }
    
    // Asigna el rol de redactor a un usuario
    public function setWriter(User $user) {
        $user->is_writer = true;
        $user->save();
    
        return redirect(route('admin.dashboard'))->with('message', "Hai reso $user->name redattore");
    }

    // Edita un tag existente
    public function editTag(Request $request, Tag $tag) {
        // Valida que el nombre del tag sea único
        $request->validate([
            'name' => 'required|unique:tags', 
        ]);
    
        // Actualiza el nombre del tag
        $tag->update([
            'name' => strtolower($request->name),
        ]);
    
        return redirect()->back()->with('message', 'Tag aggiornato correttamente');
    }

    // Elimina un tag
    public function deleteTag(Tag $tag) {
        // Desvincula los artículos asociados al tag
        foreach ($tag->articles as $article) {
            $article->tags()->detach($tag);
        }

        // Elimina el tag
        $tag->delete();
        return redirect()->back()->with('message', 'Tag eliminato correttamente');
    }

    // Edita una categoría existente
    public function editCategory(Request $request, Category $category) {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
    
        $category->update([
            'name' => strtolower($request->name),
        ]);
    
        return redirect()->back()->with('message', 'Categoria aggiornata correttamente');
    }

    // Crea una nueva categoría
    public function storeCategory(Request $request) {
        Category::create([
            'name' => strtolower($request->name),
        ]);

        return redirect()->back()->with('message', 'Categoria inserita correttamente');
    }

    // Elimina una categoría
    public function deleteCategory(Category  $category) {
        $category->delete();
    
        return redirect()->back()->with('message', 'Categoria eliminata correttamente');
    }
}
