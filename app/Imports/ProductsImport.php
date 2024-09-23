<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProductsImport implements ToModel, WithHeadingRow, WithMapping, WithCustomCsvSettings
{

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';', // Cambia esto al delimitador que uses en el CSV, puede ser ',' o ';'
        ];
    }
    
    public function model(array $row)
    {
        return new Product([
            'tipo'                     => $row['tipo'] ?? null,
            'category_id'              => $row['category_id'] ?? null,
            'main_category_id'         => $row['main_category_id'] ?? null,
            'id_interno'               => $row['id_interno'] ?? null,
            'proveedor'                => $row['proveedor'] ?? null,
            'referencia'               => $row['referencia'] ?? null,
            'marca'                    => $row['marca'] ?? null,
            'codigo_barras'            => $row['codigo_barras'] ?? null,
            'stock'                    => $row['stock'] ?? null,
            'nombre_es'                => $row['nombre_es'] ?? null,
            'precio_es'                => $row['precio_es'] ?? null,
            'descripcion'              => $row['descripcion'] ?? null,
            'precio_oferta_es'         => $row['precio_oferta_es'] ?? null,
            'precio_flash_es'          => $row['precio_flash_es'] ?? null,
            'precio_flash_fecha_fin_es' => $row['precio_flash_fecha_fin_es'] ?? null,
            'precio_coste'             => $row['precio_coste'] ?? null,
            'publicado'                => $row['publicado'] ?? null,
            'padre'                    => $row['padre'] ?? null,
            'ubicacion'                => $row['ubicacion'] ?? null,
            'nombre_completo'          => $row['nombre_completo'] ?? null,
        ]);
    }

    public function map($row): array
    {
        return [
            'tipo'                     => $row['tipo'] ?? null,
            'category_id'              => $row['category_id'] ?? null,
            'main_category_id'         => $row['main_category_id'] ?? null,
            'id_interno'               => $row['id_interno'] ?? null,
            'proveedor'                => $row['proveedor'] ?? null,
            'referencia'               => $row['referencia'] ?? null,
            'marca'                    => $row['marca'] ?? null,
            'codigo_barras'            => $row['codigo_barras'] ?? null,
            'stock'                    => $row['stock'] ?? null,
            'nombre_es'                => $row['nombre_es'] ?? null,
            'precio_es'                => $row['precio_es'] ?? null,
            'descripcion'              => $row['descripcion'] ?? null,
            'precio_oferta_es'         => $row['precio_oferta_es'] ?? null,
            'precio_flash_es'          => $row['precio_flash_es'] ?? null,
            'precio_flash_fecha_fin_es' => $row['precio_flash_fecha_fin_es'] ?? null,
            'precio_coste'             => $row['precio_coste'] ?? null,
            'publicado'                => $row['publicado'] ?? null,
            'padre'                    => $row['padre'] ?? null,
            'ubicacion'                => $row['ubicacion'] ?? null,
            'nombre_completo'          => $row['nombre_completo'] ?? null,
        ];
    }
}
