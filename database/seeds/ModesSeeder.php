<?php

use Illuminate\Database\Seeder;

class ModesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('modes')->insert(array(
            array(
              'name' => 'dieselCar'
            ),
            array(
              'name' => 'petrolCar'
            ),
            array(
                'name' => 'anyCar'
            ),
            array(
                'name' => 'taxi'
            ),
            array(
                'name' => 'economyFlight'
            ),
            array(
                'name' => 'businessFlight'
            ),
            array(
                'name' => 'firstclassFlight'
            ),
            array(
                'name' => 'anyFlight'
            ),
            array(
                'name' => 'motorbike'
            ),
            array(
                'name' => 'bus'
            ),
            array(
                'name' => 'transitRail'
            )
          ));
    }
}
