<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            'worker',
            'accommodation type',
            'accommodation',
            'activity log',
            'air port',
            'contract source',
            'cost center',
            'country',
            'currency',
            'customer',
            'contract',
            'cv',
            'invoice',
            'payment',
            'marketer',
            'nationalitie',
            'office',
            'profession',
            'qualifications and experience',
            'relay',
            'religion',
            'rental request',
            'status',
            'terms and advantage',
            'transfer sponsership request',
            'visa type',
        ]);

        $collectionWithout = collect([
            'customer status',
            'accept contract',
            'cv report',
            'customer report',
            'contract report',
            'ticket report',
            'invoice report',
            'arrival report',
            'view ticket',
            'view my ticket',
            'create ticket',
        ]);

        $collectionWithout->each(function ($item, $key) {
            // create permissions for each collection item
            Permission::firstOrCreate(
                [
                    'name'    => $item,
                ],
                [ 'name' => $item, 'guard_name' => 'web']);
        });
        $collection->each(function ($item, $key) {
            // create permissions for each collection item
            Permission::firstOrCreate(
                [
                    'name'    => 'view ' . $item,
                ],
                [ 'name' => 'view ' . $item, 'guard_name' => 'web']);
            Permission::firstOrCreate(
                [
                    'name'    => 'create ' . $item,
                ],
                [ 'name' => 'create ' . $item, 'guard_name' => 'web']);
            Permission::firstOrCreate(
                [
                    'name'    => 'edit ' . $item,
                ],
                [ 'name' => 'edit ' . $item, 'guard_name' => 'web']);
            Permission::firstOrCreate(
                [
                    'name'    => 'delete ' . $item,
                ],
                [ 'name' => 'delete ' . $item, 'guard_name' => 'web']);
        });

        // Create a Super-Admin Role and assign all Permissions
        $role = Role::firstOrCreate(
            [
                'name'    => 'super-admin',
            ],
            [
                'name' => 'super-admin',
                'guard_name' => 'web'
            ]
        );
        $role->givePermissionTo(Permission::all());

        // Give User Super-Admin Role
        $admin = App\User::whereEmail('connectusdemo12@gmail.com')->first(); // Change this to your email.
        $admin->assignRole('super-admin');




    }
}