<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Public Front-end Store Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategori', [HomeController::class, 'catalogue'])->name('catalogue');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/ketentuan', [TermsController::class, 'index'])->name('terms.index');

// Checkout & Order Routes
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/{orderNumber}', [CheckoutController::class, 'showCheckout'])->name('orders.checkout');
Route::post('/checkout/{orderNumber}/pay-simulate', [CheckoutController::class, 'simulatePayment'])->name('orders.pay.simulate');
Route::get('/order/success/{orderNumber}', [CheckoutController::class, 'success'])->name('orders.success');

// Customer Order Search & Detail
Route::get('/pesanan-saya', [CustomerOrderController::class, 'index'])->name('orders.index');
Route::get('/pesanan/{orderNumber}', [CustomerOrderController::class, 'show'])->name('orders.show');

// Order History (for logged in users)
Route::middleware('auth')->group(function () {
    Route::get('/riwayat-pesanan', [OrderHistoryController::class, 'index'])->name('orders.history');
    Route::get('/riwayat-pesanan/{orderNumber}', [OrderHistoryController::class, 'show'])->name('orders.history.show');
});

// Refund Request
Route::post('/pesanan/{orderNumber}/refund', [RefundController::class, 'request'])->name('orders.refund.request');

// Payment Gateway Webhook
Route::post('/api/payment/webhook', [WebhookController::class, 'handle'])->name('webhook.payment');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer Login Page (separate from admin)
Route::get('/masuk', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }

    return view('auth.customer-login');
})->name('customer.login');

Route::post('/masuk', [CustomerAuthController::class, 'login'])->name('customer.login.post');

Route::get('/daftar', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/daftar', [CustomerAuthController::class, 'register'])->name('customer.register.post');

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

// Admin Panel Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/paid', [AdminOrderController::class, 'paid'])->name('orders.paid');
    Route::get('/orders/refunds', [AdminOrderController::class, 'refunds'])->name('orders.refunds');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/process', [AdminOrderController::class, 'process'])->name('orders.process');
    Route::post('/orders/{id}/complete', [AdminOrderController::class, 'complete'])->name('orders.complete');
    Route::post('/orders/{id}/refund/approve', [AdminOrderController::class, 'approveRefund'])->name('orders.refund.approve');
    Route::post('/orders/{id}/refund/reject', [AdminOrderController::class, 'rejectRefund'])->name('orders.refund.reject');

    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/packages/{productId}', [AdminProductController::class, 'storePackage'])->name('packages.store');
    Route::put('/packages/{packageId}/update', [AdminProductController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{packageId}', [AdminProductController::class, 'destroyPackage'])->name('packages.destroy');
});
