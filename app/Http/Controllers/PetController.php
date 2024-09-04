<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'peso' => 'required|numeric',
            'imagem' => 'required|image|max:1024',
        ]);

        $path = $request->file('imagem')->store('imagens', 'public');
        
        $pet = new Pet();
        $pet->nome = $validated['nome'];
        $pet->peso = $validated['peso'];
        $pet->imagem = $path;
        $pet->user_id = auth()->id();
        $pet->save();

        return redirect()->route('pets.index')->with('success', 'Pet cadastrado com sucesso!');
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'peso' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pet->nome = $request->input('nome');
        $pet->peso = $request->input('peso');

        if ($request->hasFile('imagem')) {
            // Remove a imagem antiga se existir
            if ($pet->imagem) {
                Storage::disk('public')->delete($pet->imagem);
            }
            $imagePath = $request->file('imagem')->store('images', 'public');
            $pet->imagem = $imagePath;
        }

        $pet->save();

        return redirect()->route('pets.index')->with('success', 'Pet atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);

    if ($pet->imagem) {

        $pet = Pet::findOrFail($id);
        // dd($dado);
        $image_path = public_path('storage/imagens/'.$pet->imagem);

        if(file_exists($image_path)){
            unlink($image_path);
        }

    }
        
        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet deletado com sucesso!');
    }
}
