<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.import-form');
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file');

            if (!$file) {
                return back()->with('error', 'Por favor, selecciona un archivo para importar.');
            }

            if (!in_array($file->getClientOriginalExtension(), ['csv', 'xlsx', 'xls'])) {
                return back()->with('error', 'El archivo debe tener formato CSV o Excel.');
            }


            Excel::import(new ProductsImport, $file);


            return back()->with('success', 'Se han añadido los productos correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar productos: ' . $e->getMessage());
        }
    }
}
