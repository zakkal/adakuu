<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Package;
use Illuminate\Database\Seeder;

class SampleOrdersSeeder extends Seeder
{
    public function run(): void
    {
        // Get first package for sample orders
        $package = Package::first();

        if (! $package) {
            $this->command->error('No packages found. Please create products and packages first.');

            return;
        }

        // Generate sample orders for last 12 months
        $months = [
            ['month' => 1, 'orders' => 16],  // Jan
            ['month' => 2, 'orders' => 23],  // Feb
            ['month' => 3, 'orders' => 23],  // Mar
            ['month' => 4, 'orders' => 7],   // Apr
            ['month' => 5, 'orders' => 34],  // May
            ['month' => 6, 'orders' => 7],   // Jun
            ['month' => 7, 'orders' => 18],  // Jul
            ['month' => 8, 'orders' => 21],  // Aug
            ['month' => 9, 'orders' => 31],  // Sep
            ['month' => 10, 'orders' => 4],  // Oct
            ['month' => 11, 'orders' => 14], // Nov
            ['month' => 12, 'orders' => 16], // Dec
        ];

        foreach ($months as $data) {
            for ($i = 0; $i < $data['orders']; $i++) {
                // Random date in that month of 2026
                $createdAt = now()->setYear(2026)->setMonth($data['month'])->setDay(rand(1, 28))->setHour(rand(0, 23))->setMinute(rand(0, 59));

                Order::create([
                    'order_number' => 'YP-'.$createdAt->format('Ymd').'-'.strtoupper(fake()->bothify('???##')),
                    'package_id' => $package->id,
                    'customer_name' => fake()->name(),
                    'customer_whatsapp' => '08'.fake()->numerify('##########'),
                    'total_amount' => $package->price,
                    'payment_method' => 'Midtrans Snap / QRIS',
                    'payment_status' => 'PAID',
                    'order_status' => fake()->randomElement(['PAID', 'PROCESSING', 'COMPLETED']),
                    'paid_at' => $createdAt,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }
        }

        $this->command->info('✅ Sample orders created successfully!');
        $this->command->info('📊 Total: '.array_sum(array_column($months, 'orders')).' orders across 12 months');
    }
}
