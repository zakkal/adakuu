<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class CleanupDummyOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get real orders (yang ada customer nya zakkal atau user real lainnya)
        $realCustomers = ['zakkal']; // tambahkan nama customer real lainnya di sini
        
        // Hapus semua orders KECUALI yang customer_name ada di list real customers
        $deletedCount = Order::whereNotIn('customer_name', $realCustomers)->delete();

        $this->command->warn("Deleted {$deletedCount} dummy/sample orders");

        $remainingOrders = Order::count();
        $this->command->info("Remaining real orders: {$remainingOrders}");

        $this->command->info('✅ Cleanup completed! Dashboard will now show only real data.');
    }
}
