<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::Title($request->get('title'))
            ->Profile($request->get('profile'))
            ->State($request->get('state'))
            ->latest()
            ->paginate(10);

        $states = ['Borrador','Vigente','Vencido'];
        $profiles = ['Estudiante','Docente','Egresado'];

        return view('documents.index', compact('documents', 'states', 'profiles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:80|unique:documents,code',
            'title' => 'required|string|max:255',
            'file_route' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
            'description' => 'nullable|string',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date',
            'version' => 'nullable|string|max:20',
            'profile' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:80',
        ]);

        // Guardar archivo
        if ($request->hasFile('file_route')) {
            $validated['file_route'] = $request->file('file_route')->store('documents', 'public');
        }

        Document::create($validated);
        return redirect()->route('documents.index')->with('success', 'Documento registrado correctamente.');
    }

    public function edit(Document $document)
    {
        return response()->json(array('document' => $document));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:80|unique:documents,code,' . $document->id,
            'title' => 'required|string|max:255',
            'file_route' => 'file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
            'description' => 'nullable|string',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date',
            'version' => 'nullable|string|max:20',
            'profile' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:80',
        ]);

        if ($request->hasFile('file_route')) {
            // Eliminar archivo anterior
            Storage::disk('public')->delete($document->file_route);
            $validated['file_route'] = $request->file('file_route')->store('documents', 'public');
        }

        $document->update($validated);
        return redirect()->route('documents.index')->with('success', 'Documento actualizado correctamente.');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Documento eliminado correctamente.');
    }
}
