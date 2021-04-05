<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $users = [
            ['Fulano de Tal',     '(49) 98541-4569', 22, 1255, null], 
            ['Beltrano Tomé',     '(48) 99876-4239', 22, 2328, 1],
            ['Pedro Pederneiras', '(21) 98541-4123', 19, 3273, 1],
            ['José das Dores',    '(11) 98221-1129', 20, 3469, 3],
            ['Zézinho dos Codes', '(91) 98541-4529', 5, 581, 1],
            ['Maria Recursiva',   '(47) 96812-8765', 22, 632, 4],
        ];

        foreach($users as $u) {
            \App\User::create([
                'name'      => $u[0],
                'phone'     => $u[1],
                'estate_id' => $u[2],
                'city_id'   => $u[3],
                'father_id' => $u[4],
            ]);
        }
    }
}
