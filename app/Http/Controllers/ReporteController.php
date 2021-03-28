<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function ventas(Request $request){
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $ventas = DB::table('reporte')
            ->selectRaw('fecha , sum(total) as total_diario')
            ->where("fecha",">=",$desde)
            ->where("fecha","<=",$hasta)
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        if($ventas->isEmpty())
            return 0;
        else
            return response(json_encode($ventas), 200)->header('Content-type', 'text/plain');
    }
}
