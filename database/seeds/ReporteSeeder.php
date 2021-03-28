<?php

use Illuminate\Database\Seeder;


class ReporteSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('es_PE');
        for($i=0; $i<=500;$i++){
            \App\Reporte::create([
                'fecha'=>$faker->dateTimeBetween('-80 days', 'now')->format('d-m-Y'),
                'total'=>random_int(230,1300)
            ]);
        }
    }
}
