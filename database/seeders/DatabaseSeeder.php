<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role = Role::create([
            'role' => 'admin',
            'description' => 'Admin'
        ]);

        Role::create([
            'role' => 'profesional',
            'description' => 'Usuario Profesional',
        ]);

        Role::create([
            'role' => 'particular',
            'description' => 'Usuario Particular',
        ]);

        $admin = User::create([
            'name' => 'Alberto',
            'surname' => 'Sánchez Indiano',
            'email' => 'betoindi@hotmail.com',
            'password' => Hash::make('alberto1234'),
            'phoneNumber' => '',
            'role_id' => 1,
        ]);

        $user = User::create([
            'name' => 'Roger',
            'surname' => 'Sánchez Torres',
            'email' => 'rogerst2002@gmail.com',
            'password' => Hash::make('roger12345'),
            'phoneNumber' => '',
            'role_id' => 2,
        ]);



        $this->call(ProductsTableSeeder::class);


        MainCategory::create([
            'nombre' => 'Calefacción y Acs',
            'slug' => 'calefaccion-y-acs',
        ]);
        MainCategory::create([
            'nombre' => 'Fontanería',
            'slug' => 'fontaneria',
        ]);
        MainCategory::create([
            'nombre' => 'Herramientas',
            'slug' => 'herramientas',
        ]);
        MainCategory::create([
            'nombre' => 'Sanitarios y Grifería',
            'slug' => 'sanitarios-y-griferia',
        ]);
        MainCategory::create([
            'nombre' => 'Ropa Laboral',
            'slug' => 'ropa-laboral',
        ]);
        MainCategory::create([
            'nombre' => 'Material Eléctrico',
            'slug' => 'material-electrico',
        ]);
        MainCategory::create([
            'nombre' => 'Construcción',
            'slug' => 'construcción',
        ]);


        Category::create([
            'nombre' => 'Calderas Murales',
            'slug' => 'calderas-murales',
            'main_category_id' => 1
        ]);
        Category::create([
            'nombre' => 'Termos Eléctricos',
            'slug' => 'termos-electricos',
            'main_category_id' => 1
        ]);
        Category::create([
            'nombre' => 'Radiadores',
            'slug' => 'radiadores',
            'main_category_id' => 1
        ]);
        Category::create([
            'nombre' => 'Complementos para la Instalación',
            'slug' => 'complementos-para-la-instalacion',
            'main_category_id' => 1
        ]);


        Category::create([
            'nombre' => 'Tratamientos del Agua',
            'slug' => 'tratamientos-del-agua',
            'main_category_id' => 2
        ]);
        Category::create([
            'nombre' => 'Accesorios Instalación',
            'slug' => 'accesorios-instalacion',
            'main_category_id' => 2
        ]);
        Category::create([
            'nombre' => 'Tuberías y Accesorios de Fontanería',
            'slug' => 'tuberias-y-accesorios-de-fontaneria',
            'main_category_id' => 2
        ]);
        Category::create([
            'nombre' => 'Gas',
            'slug' => 'gas',
            'main_category_id' => 2
        ]);
        Category::create([
            'nombre' => 'Jardín y Piscina',
            'slug' => 'jardin-y-piscina',
            'main_category_id' => 2
        ]);
        Category::create([
            'nombre' => 'Sifones y Desagües',
            'slug' => 'sifones-y-desagues',
            'main_category_id' => 2
        ]);


        Category::create([
            'nombre' => 'Herramientas Electricidad',
            'slug' => 'herramientas-electricidad',
            'main_category_id' => 3
        ]);
        Category::create([
            'nombre' => 'Herramientas Fontanería',
            'slug' => 'herramientas-fontaneria',
            'main_category_id' => 3
        ]);
        Category::create([
            'nombre' => 'Herramientas Electroportátiles',
            'slug' => 'herramientas-electroportatiles',
            'main_category_id' => 3
        ]);
        Category::create([
            'nombre' => 'Herramientas Construcción',
            'slug' => 'herramientas-construccion',
            'main_category_id' => 3
        ]);


        Category::create([
            'nombre' => 'Grifería',
            'slug' => 'griferia',
            'main_category_id' => 4
        ]);
        Category::create([
            'nombre' => 'Sanitarios',
            'slug' => 'sanitarios',
            'main_category_id' => 4
        ]);


        Category::create([
            'nombre' => 'Calzado',
            'slug' => 'calzado',
            'main_category_id' => 5
        ]);
        Category::create([
            'nombre' => 'Protección',
            'slug' => 'proteccion',
            'main_category_id' => 5
        ]);
        Category::create([
            'nombre' => 'Guantes y Mascarillas',
            'slug' => 'guantes-y-mascarillas',
            'main_category_id' => 5
        ]);


        Category::create([
            'nombre' => 'Mecanismos',
            'slug' => 'mecanismos',
            'main_category_id' => 6
        ]);
        Category::create([
            'nombre' => 'Sistemas de Control y Protección',
            'slug' => 'sistemas-de-control-y-proteccion',
            'main_category_id' => 6
        ]);
        Category::create([
            'nombre' => 'Iluminación',
            'slug' => 'iluminacion',
            'main_category_id' => 6
        ]);
        Category::create([
            'nombre' => 'Materiales de Instalación',
            'slug' => 'materiales-de-instalacion',
            'main_category_id' => 6
        ]);

        
        Category::create([
            'nombre' => 'Impermeabilización',
            'slug' => 'impermeabilizacion',
            'main_category_id' => 7
        ]);
        Category::create([
            'nombre' => 'Adhesivos y Selladores',
            'slug' => 'adhesivos-y-selladores',
            'main_category_id' => 7
        ]);
        Category::create([
            'nombre' => 'Espumas',
            'slug' => 'espumas',
            'main_category_id' => 7
        ]);
        Category::create([
            'nombre' => 'Masillas',
            'slug' => 'masillas',
            'main_category_id' => 7
        ]);
    }
}
