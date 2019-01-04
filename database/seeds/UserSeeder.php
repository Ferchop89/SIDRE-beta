<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new User();
        $table->name = 'Biblioteca';
        $table->email = 'biblioteca@enp2.com.mx';
        $table->password = bcrypt('12345678');
        $table->departamento_id = 1;
        $table->save();

        $table = new User();
        $table->name = 'Ciencias Experimentales';
        $table->email = 'ciencias@enp2.com.mx';
        $table->password = bcrypt('12345678');
        $table->departamento_id = 1;
        $table->save();

        $table = new User();
        $table->name = 'Deportes';
        $table->email = 'deportes@enp2.com.mx';
        $table->password = bcrypt('12345678');
        $table->departamento_id = 1;
        $table->save();
    }
}
