    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AktaController,KkController,EKtpController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('akta')->group(function () {
        Route::get('/', [AktaController::class,'index'])->name('akta.index');
        Route::get('/create', [AktaController::class,'create'])->name('akta.create');
        Route::get('/download/{id}', [AktaController::class,'download'])->name('akta.download');
        Route::post('/store', [AktaController::class,'store'])->name('akta.store');
        Route::get('/edit/{id}', [AktaController::class,'edit'])->name('akta.edit');
        Route::post('/update/{id}', [AktaController::class,'update'])->name('akta.update');
        Route::get('/delete/{id}', [AktaController::class,'destroy'])->name('akta.delete');
    });

    Route::prefix('kk')->group(function () {
        Route::get('/', [KkController::class,'index'])->name('kk.index');
        Route::get('/create', [KkController::class,'create'])->name('kk.create');
        Route::post('/store', [KkController::class,'store'])->name('kk.store');
        Route::get('/edit/{id}', [KkController::class,'edit'])->name('kk.edit');
        Route::post('/update/{id}', [KkController::class,'update'])->name('kk.update');
        Route::get('/delete/{id}', [KkController::class,'destroy'])->name('kk.delete');
    });

    Route::prefix('ektp')->group(function () {
        Route::get('/', [EKtpController::class,'index'])->name('ektp.index');
        Route::get('/create', [EKtpController::class,'create'])->name('ektp.create');
        Route::post('/store', [EKtpController::class,'store'])->name('ektp.store');
        Route::get('/edit/{id}', [EKtpController::class,'edit'])->name('ektp.edit');
        Route::post('/update/{id}', [EKtpController::class,'update'])->name('ektp.update');
        Route::get('/delete/{id}', [EKtpController::class,'destroy'])->name('ektp.delete');
    });

});
