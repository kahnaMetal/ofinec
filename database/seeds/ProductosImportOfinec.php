<?php

use Illuminate\Database\Seeder;

class ProductosImportOfinec extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=50; $i++){
          $ref = date('ymd').$i;
          $categorias = array("granos", "líquidos", "verduras");
          $estados = array("activo","inactivo");
          DB::table('productos')->insert(
            array(
              'ReferenciaProducto'          => $ref,
              'NombreProducto'              => "Producto Seeder # ".$i,
              'Peso'                        => rand(0, 10) / 10,
              'Precio'                      => rand(1000, 10000) / 100,
              'FotoProducto'                => '',
              'Cantidad'                    => rand(1,30),
              'Categoria'                   => $categorias[array_rand($categorias)],
              'Estado'                      => $estados[array_rand($estados)],
              'Usuario_id'                  => 1
            )
          );
        }

        $this->command->info('Tabla de productos rellenada con 50 productos de prueba');
    }
}
