<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithMapping, WithCustomCsvSettings, SkipsEmptyRows, WithValidation
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';', // Asegura el delimitador correcto
        ];
    }

    public function map($row): array
    {
        // Mapeamos los datos según tus columnas
        return [
            'tipo'                       => $row['tipo'] ?? null,
            'category_id'                => $row['category_id'] ?? null,
            'main_category_id'           => $row['main_category_id'] ?? null,
            'id_interno'                 => $row['id_interno'] ?? null,
            'proveedor'                  => $row['proveedor'] ?? null,
            'referencia'                 => $row['referencia'] ?? null,
            'marca'                      => $row['marca'] ?? null,
            'codigo_barras'              => $row['codigo_barras'] ?? null,
            'stock'                      => $row['stock'] ?? null,
            'nombre_es'                  => $row['nombre_es'] ?? null,
            'precio_es'                  => $row['precio_es'] ?? null,
            'descripcion'                => $row['descripcion'] ?? null,
            'precio_oferta_es'           => $row['precio_oferta_es'] ?? null,
            'precio_flash_es'            => $row['precio_flash_es'] ?? null,
            'precio_flash_fecha_fin_es'  => $row['precio_flash_fecha_fin_es'] ?? null,
            'precio_coste'               => $row['precio_coste'] ?? null,
            'publicado'                  => $row['publicado'] ?? null,
            'padre'                      => $row['padre'] ?? null,
            'ubicacion'                  => $row['ubicacion'] ?? null,
            'nombre_completo'            => $row['nombre_completo'] ?? null,
        ];
    }

    public function model(array $row)
    {
        // Si no hay referencia, no hacemos nada
        if (empty($row['referencia'])) {
            return null;
        }

        // Buscamos el producto por referencia
        $product = Product::where('referencia', $row['referencia'])->first();

        if ($product) {
            // 🔄 Si existe, lo actualizamos
            $product->update([
                'tipo'                       => $row['tipo'] ?? $product->tipo,
                'category_id'                => $row['category_id'] ?? $product->category_id,
                'main_category_id'           => $row['main_category_id'] ?? $product->main_category_id,
                'id_interno'                 => $row['id_interno'] ?? $product->id_interno,
                'proveedor'                  => $row['proveedor'] ?? $product->proveedor,
                'marca'                      => $row['marca'] ?? $product->marca,
                'codigo_barras'              => $row['codigo_barras'] ?? $product->codigo_barras,
                'stock'                      => $row['stock'] ?? $product->stock,
                'nombre_es'                  => $row['nombre_es'] ?? $product->nombre_es,
                'precio_es'                  => $row['precio_es'] ?? $product->precio_es,
                'descripcion'                => $row['descripcion'] ?? $product->descripcion,
                'precio_oferta_es'           => $row['precio_oferta_es'] ?? $product->precio_oferta_es,
                'precio_flash_es'            => $row['precio_flash_es'] ?? $product->precio_flash_es,
                'precio_flash_fecha_fin_es'  => $row['precio_flash_fecha_fin_es'] ?? $product->precio_flash_fecha_fin_es,
                'precio_coste'               => $row['precio_coste'] ?? $product->precio_coste,
                'publicado'                  => $row['publicado'] ?? $product->publicado,
                'padre'                      => $row['padre'] ?? $product->padre,
                'ubicacion'                  => $row['ubicacion'] ?? $product->ubicacion,
                'nombre_completo'            => $row['nombre_completo'] ?? $product->nombre_completo,
            ]);

            return null; // No crear uno nuevo
        }

        // 🆕 Si no existe, lo creamos
        return new Product([
            'tipo'                       => $row['tipo'] ?? null,
            'category_id'                => $row['category_id'] ?? null,
            'main_category_id'           => $row['main_category_id'] ?? null,
            'id_interno'                 => $row['id_interno'] ?? null,
            'proveedor'                  => $row['proveedor'] ?? null,
            'referencia'                 => $row['referencia'] ?? null,
            'marca'                      => $row['marca'] ?? null,
            'codigo_barras'              => $row['codigo_barras'] ?? null,
            'stock'                      => $row['stock'] ?? null,
            'nombre_es'                  => $row['nombre_es'] ?? null,
            'precio_es'                  => $row['precio_es'] ?? null,
            'descripcion'                => $row['descripcion'] ?? null,
            'precio_oferta_es'           => $row['precio_oferta_es'] ?? null,
            'precio_flash_es'            => $row['precio_flash_es'] ?? null,
            'precio_flash_fecha_fin_es'  => $row['precio_flash_fecha_fin_es'] ?? null,
            'precio_coste'               => $row['precio_coste'] ?? null,
            'publicado'                  => $row['publicado'] ?? null,
            'padre'                      => $row['padre'] ?? null,
            'ubicacion'                  => $row['ubicacion'] ?? null,
            'nombre_completo'            => $row['nombre_completo'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.referencia' => ['required', 'string'],
        ];
    }
}
