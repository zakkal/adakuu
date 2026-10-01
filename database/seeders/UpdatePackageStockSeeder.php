<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class UpdatePackageStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update all existing packages with random stock values
        Package::all()->each(function (Package $package) {
            $stock = rand(5, 20); // Random stock between 5-20
            $soldCount = rand(0, min(3, $stock - 1)); // Random sold count (max 3 or stock-1)

            $package->update([
                'stock' => $stock,
                'sold_count' => $soldCount,
            ]);

            $this->command->info("Updated {$package->name}: Stock={$stock}, Sold={$soldCount}, Remaining={$package->remaining_stock}");
        });

        // Create one package that is sold out for testing
        $firstPackage = Package::first();
        if ($firstPackage) {
            $firstPackage->update([
                'stock' => 5,
                'sold_count' => 5,
                'is_available' => false,
            ]);
            $this->command->warn("Set {$firstPackage->name} as SOLD OUT (Stock=5, Sold=5)");
        }

        $this->command->info('Stock update completed!');
    }
}
