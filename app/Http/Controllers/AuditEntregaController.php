<?php

namespace App\Http\Controllers;

use App\Models\AuditEntrega;
use Illuminate\Http\Request;

class AuditEntregaController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditEntrega::with(['expediente', 'solicitante', 'operador'])
            ->orderByDesc('delivered_at');

        if ($request->filled('from')) {
            $query->whereDate('delivered_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->whereDate('delivered_at', '<=', $request->input('to'));
        }

        if ($request->filled('expediente')) {
            $query->whereHas('expediente', function ($q) use ($request) {
                $q->where('codigo', $request->input('expediente'));
            });
        }

        if ($request->filled('operador')) {
            $query->whereHas('operador', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->input('operador').'%');
            });
        }

        if ($request->filled('solicitante')) {
            $query->whereHas('solicitante', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->input('solicitante').'%');
            });
        }

        $audits = $query->paginate();

        return view('auditoria.entregas.index', compact('audits'));
    }
}
