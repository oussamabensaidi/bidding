<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\bidController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// ---------------------------------------- things to add in the future: google recaptcha for the bidding page make sure it work fine no sneaking , online users , advance bidding system , making sure one user cant bid in different bids at the same time , good ui for phone users 
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/advanceSearch', [DashboardController::class, 'advanceSearch'])->name('advanceSearch');
    Route::get('/items_search', [DashboardController::class, 'items_search'])->name('items_search');
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
        // 'destroy' => 'items.destroy',
    ]);
    
    
    Route::delete('/items/{item}/destroy', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::delete('/items/{item}/delete-image', [ItemController::class, 'deleteImage'])->name('items.delete-image');
    Route::get('/items/clientShow/{item}', [ItemController::class, 'clientShow'])->name('items.clientShow');


    
    Route::middleware('human.verified')->group(function(){
        Route::get('/items/bid/{item}', [bidController::class, 'bid'])->name('items.bid');
        Route::patch('/items/bid/{item}', [bidController::class, 'updateBid'])->name('items.updateBid');
    });
    
    Route::post('/comment', [CommentController::class, 'comment'])->name('comment');
    
    Route::get('/verify-human/{item}', [CaptchaController::class, 'show'])->name('captcha.show');
    Route::post('/verify-human/{item}', [CaptchaController::class, 'verify'])->name('captcha.verify');
    
    Route::get('/trackItems', [ItemController::class,'trackItems'])->name('trackItems');
    Route::get('/trackItems/history/{item}', [ItemController::class,'trackItemsHistory'])->name('trackItemsHistory');
    Route::get('/trackItems/update/{item}', [ItemController::class,'trackItemsUpdateState'])->name('trackItemsUpdateState');
    Route::put('trackItemsUpdateState/{item}', [ItemController::class,'trackItemsUpdateStateForm'])->name('trackItemsUpdateStateForm');
    
});



require __DIR__.'/auth.php';
