<?php

use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('fuelType')->insert(array(
            array(
              'name' => 'motorGasoline'
            ),
            array(
              'name' => 'diesel'
            ),
            array(
                'name' => 'aviationGasoline'
            ),
            array(
                'name' => 'jetFuel'
            )
          ));
    }
}
