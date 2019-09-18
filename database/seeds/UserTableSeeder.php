<?php

use Illuminate\Database\Seeder;
use Main\Models\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create(['name' => 'Roelof Jan Elsinga', 'email' => 'roelofjanelsinga@gmail.com', 'password' => '$2y$10$X/pPBQcWR03wHBI7P/IPk.SwIfs0zwu90hjXDdgF1JmJW.Dp3GUnC']);
    }
}
