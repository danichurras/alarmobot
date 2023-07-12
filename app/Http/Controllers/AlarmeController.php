<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alarme;
use App\Models\Ativacao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AlarmeController extends Controller
{
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
            'status' => 'required',
            'mac_esp' => 'required|size:17'
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
            ->route('dashboard')
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
            'mac_esp' => 'required|max:17'
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
            ->route('dashboard')
            ->withSuccess('Alarme atualizado com sucesso.');

    }

    public function deletar(int $id) : RedirectResponse|JsonResponse
    {
        $a = Alarme::findOrFail($id);

        if (!$a) {
            return response()->json([
                "message" => "Alarme não encontrado."
            ], 404);
        }

        foreach ($a->ativacaos as $ativacao) 
        {
            foreach ($ativacao->disparos as $disparo)
            {
                $disparo->delete();
            }

            $ativacao->delete();
        }

        $deletou = $a->delete();

        if (!$deletou) {
            return response()->json([
                "message" => "Não foi possível deletar o alarme. (500)"
            ], 500);
        }

        return redirect()
            ->route('dashboard')
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

        if($newStatus == 'ativado') {
            $a = new Ativacao();
            $a->fill([
                'data_ativacao' => now(),
                'alarme_id' => $alarme->id
            ]);
            $salvouAtiv = $a->save();

            if (!$salvouAtiv) {
                return response()->json([
                    "message" => "Não foi possível salvar a ativação no banco."
                ], 500);
            }
        } else {
            $a = Ativacao::where('alarme_id', '=', $alarme->id)->latest()->first();
            
            $atualizouAtiv = $a->update([
                'data_desativacao' => now()
            ]);

            if (!$atualizouAtiv) {
                return response()->json([
                    "message" => "Não foi possível atualizar a ativação no banco. (500)"
                ], 500);
            }
        }

        return redirect()
            ->route('alarmes.gerenciar', $alarme)
            ->withSuccess('Alarme ' . $newStatus . '.');
    }
}
