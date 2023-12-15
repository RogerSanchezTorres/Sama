<?php

// app/Http/Controllers/ImportController.php

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

            if (!$file->getClientOriginalExtension() === 'xlsx' || $file->getClientOriginalExtension() === 'xls') {
                return back()->with('error', 'El archivo debe tener formato Excel (xlsx o xls).');
            }

            Excel::import(new ProductsImport, $file);
            return back()->with('success', 'Se han añadido los productos correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar productos: ' . $e->getMessage());
        }
    }
}


/*public function importProducts(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');
        ImportProducts::dispatch($file);

        return redirect('/import-form')->with('success', 'Importación iniciada. Verifica los registros para obtener el estado.');
    }*/