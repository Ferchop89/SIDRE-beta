<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ItemExtranjero;

class SearchController extends Controller
{
   public function busquedaExtranjeros(Request $request)
   {
         $data = ItemExtranjero::select("nombre")->where("nombre","LIKE","%{$request->input('query')}%")->orderBy('nombre', 'ASC')->get();
         $datos = array();
         foreach ($data as $value) {
            $datos[] = $value->nombre;
         }
         return response()->json($datos);
   }
}
