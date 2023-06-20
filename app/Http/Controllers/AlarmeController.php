<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alarme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AlarmeController extends Controller
{
    public function listar() : View
    {
        $usuario = Auth::user();
        
        $alarmes = $usuario->alarmes;

        return view('alarmes.listar', compact('alarmes'));
    }

    public function cadastrar(): View
    {
        $usuario = Auth::user();

        return view('alarmes.cadastrar', compact('usuario'));
    }

    public function salvar(Request $request) : RedirectResponse|JsonResponse
    {
        $validateRequest = $request->validate([
            'nome' => 'required|max:100',
            'user_id' => 'required',
            'status' => 'required'
        ]);

        $dados = collect($validateRequest);

        $a = new Alarme();
        $a->fill($dados->toArray());
        $salvou = $a->save();

        if (!$salvou) {
            return response()->json([
                "message" => "Não foi possível salvar o alarme."
            ], 500);
        }

        return redirect()
            ->route('alarmes.listar')
            ->withSuccess('Alarme cadastrado com sucesso.');
    }

    public function editar(int $id) : View
    {
        $alarme = Alarme::find($id);

        return view ('alarmes.editar', compact('alarme'));
    }

    public function atualizar(Request $request, int $id) : RedirectResponse|JsonResponse
    {
        $validateRequest = $request->validate([
            'nome' => 'required|max:100',
        ]);

        $dados = collect($validateRequest);

        $a = Alarme::find($id);

        if (is_null($a)) {
            return response()->json([
                "message" => "Não foi possível encontrar o alarme no banco. (404)"
            ], 404);
        }

        $a->fill($dados->toArray());
        $atualizou = $a->update();

        if (!$atualizou) {
            return response()->json([
                "message" => "Não foi possível atualizar o alarme. (500)"
            ], 500);
        }

        return redirect()
            ->route('alarmes.listar')
            ->withSuccess('Alarme atualizado com sucesso.');

    }

    public function deletar(int $id) : RedirectResponse|JsonResponse
    {
        $a = Alarme::find($id);

        if (!$a) {
            return response()->json([
                "message" => "Alarme não encontrado."
            ], 404);
        }

        $deletou = $a->delete();

        if (!$deletou) {
            return response()->json([
                "message" => "Não foi possível deletar o alarme. (500)"
            ], 500);
        }

        return redirect()
            ->route('alarmes.listar')
            ->withSuccess('Alarme deletado com sucesso.');
    }

    public function gerenciar(int $id) : View
    {
        $alarme = Alarme::find($id);

        return view('alarmes.gerenciar', compact('alarme'));
    }

    public function atualizarStatus(int $id) : RedirectResponse|JsonResponse
    {
        $alarme = Alarme::find($id);

        $newStatus = ($alarme->status == 'desativado') ? 'ativado' : 'desativado';

        $atualizou = $alarme->update([
            'status' => $newStatus
        ]);

        if (!$atualizou) {
            return response()->json([
                "message" => "Não foi possível atualizar o status do alarme. (500)"
            ], 500);
        }

        return redirect()
            ->route('alarmes.gerenciar', $alarme)
            ->withSuccess('Alarme' . $newStatus . '.');
    }
}
