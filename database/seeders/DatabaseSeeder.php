<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\{Role, User, ExtraType, Extra, RequestExtra, Turn, Customer, Payment};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['admin', 'customer', 'extra'];
        for ($i=0; $i < 3 ; $i++) {
            Role::create([
                'name' => $roles[$i],
            ]);
        }

        User::factory()->create([
            'role_id' => 1,
            'name' => 'Jorge Admin',
            'email' => 'jorge@admin.com',
            'password' =>  Hash::make('12345678'),
            'extra' => false
        ]);

        User::factory()->create([
            'role_id' => 2,
            'name' => 'Restaurant paris',
            'email' => 'paris@customer.com',
            'password' =>  Hash::make('12345678'),
        ]);

        User::factory()->create([
            'role_id' => 3,
            'name' => 'Diego Extra',
            'email' => 'diego@extra.com',
            'password' =>  Hash::make('12345678'),
            'extra' => true
        ]);

        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1
            ],
            [
                'role_id' => 2,
                'user_id' => 2
            ],
            [
                'role_id' => 3,
                'user_id' => 3
            ]
        ]);

        $extra_types = ['ayudante de camarero', 'camarero', 'office', 'maitre', 'pinche de cocina', 'cocinero', 'jefe de cocina'];
        for ($i=0; $i < 7 ; $i++) {
            ExtraType::create([
                'name' => $extra_types[$i],
            ]);
        }

        Customer::create([
            'status' => 'active',
            'name_fiscal' => 'Restaurant paris CA',
            'name_comercial' => 'Restaurant paris',
            'nif' => '123321',
            'email' => 'paris@customer.com',
            'phone' => '123123',
            'dress_code' => 'Casual',
            'street' => '5',
            'apartament' => '3',
            'municipality' => 'tetuan',
            'province' => 'madrid',
            'postal_code' => '12100',
        ]);

        Extra::create([
            'extra_type_id' => 1,
            'status' => 'pending',
            'first_name' => 'Diego',
            'last_name' => 'Rojas',
            'birth_day' => '06-01-2000',
            'dni' => '123123',
            'dni_expiration' => '14-02-2026',
            'phone' => '312123',
            'genre' => 'M',
            'street' => 'Calle Topete, 5',
            'apartament' => '3D',
            'municipality' => 'Tetuan',
            'province' => 'Madrid',
            'postal_code' => '28039',
            'height' => '123',
            'weight' => '123',
            'shirt_size' => '12',
            'shoe_size' => '32',
            'has_vehicle' => true,
            'vehicle' => 'corolla',
            'vehicle_capacity' => '5',
            'specialities' => '',
            'experience' => '',
            'profile' => '',
            'dni_front' => '',
            'dni_back' => '',
            'social_security_front' => '',
            'social_security_back' => '',
            'license_front' => '',
            'license_back' => '',
            'food_front' => '',
            'food_back' => '',
            'title_hosteleria' => '',
        ]);

        RequestExtra::create([
            'date' => '2024-07-09',
            'extra_type' => 'cocinero',
            'quantity' => 1,
            'entry_time' => '23:00',
            'departure_time' => '04:30',
            'dress_code' => 'Nada en especiofico',
            'status' => 'aproved',
        ]);

        RequestExtra::create([
            'date' => '2024-07-09',
            'extra_type' => 'cocinero',
            'quantity' => 2,
            'entry_time' => '23:00',
            'departure_time' => '04:30',
            'dress_code' => 'Nada en especiofico',
            'status' => 'pending',
        ]);

        RequestExtra::create([
            'date' => '2024-07-09',
            'extra_type' => 'cocinero',
            'quantity' => 2,
            'entry_time' => '23:00',
            'departure_time' => '04:30',
            'dress_code' => 'Nada en especiofico',
            'status' => 'rejected',
        ]);

        DB::table('customer_request_extra')->insert([
            [
                'customer_id' => 1,
                'request_extra_id' => 1
            ],
            [
                'customer_id' => 1,
                'request_extra_id' => 2
            ],
            [
                'customer_id' => 1,
                'request_extra_id' => 3
            ]
        ]);

        Payment::create([
            'turn_id' => 1,
            'customer_id' => 1,
            'extra_id' => 1,
            'status' => 'pagado',
            'multas' => 10,
            'bonos' => 20,
            'total' => 10,
            'fecha_pago' => '2024-07-25 15:06:11',
        ]);

        Payment::create([
            'turn_id' => 1,
            'customer_id' => 1,
            'extra_id' => 1,
            'status' => 'pagado',
            'multas' => 0,
            'bonos' => 0,
            'total' => 100,
            'fecha_pago' => '2024-07-25 15:06:11',
        ]);

        Turn::create([
            'extra_id' => 1,
            'customer_id' => 1,
            'date' => '2024-08-08',
            'entry_time' => '00:00',
            'departure_time' => '03:00',
            'total_hours' => '3',
            'status' => 'pendiente',
            'hourly_rate' => 10, //precio x hora €
            'total' => 30, // total generado €
        ]);
    }
}
