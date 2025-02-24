<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\bidController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/items', ItemController::class)->names([
        'index' => 'items',
        'create' => 'items.create',
        'store' => 'items.store',
        'show' => 'items.show',
        'edit' => 'items.edit',
        'update' => 'items.update',
        'destroy' => 'items.destroy',
    ]);
    Route::delete('/items/{item}/delete-image', [ItemController::class, 'deleteImage'])->name('items.delete-image');
    Route::get('/items/clientShow/{item}', [ItemController::class, 'clientShow'])->name('items.clientShow');
    Route::get('/items/bid/{item}', [bidController::class, 'bid'])->name('items.bid');
    Route::patch('/items/bid/{item}', [bidController::class, 'updateBid'])->name('items.updateBid');

    Route::get('/verify-human/{item}', [CaptchaController::class, 'show'])->name('captcha.show');
    Route::post('/verify-human/{item}', [CaptchaController::class, 'verify'])->name('captcha.verify');

});



require __DIR__.'/auth.php';
