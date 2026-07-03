<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

require __DIR__.'/auth.php';

// ============================================================
// Routes épreuves (protégées, utilisateur connecté)
// ============================================================
use App\Http\Controllers\EpreuveController;

Route::middleware('auth')->group(function () {
    Route::get('/epreuves', [EpreuveController::class, 'index'])->name('epreuves.index');
    Route::get('/epreuves/ajouter', [EpreuveController::class, 'create'])->name('epreuves.create');
    Route::post('/epreuves/ajouter', [EpreuveController::class, 'store'])->name('epreuves.store');
});

// ============================================================
// Routes admin (protégées, utilisateur connecté + rôle admin)
// ============================================================
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/documents', [AdminController::class, 'documents'])->name('documents');
    Route::delete('/documents/{epreuve}', [AdminController::class, 'supprimerDocument'])->name('documents.supprimer');
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::patch('/utilisateurs/{user}/role', [AdminController::class, 'changerRole'])->name('utilisateurs.role');
    Route::delete('/utilisateurs/{user}', [AdminController::class, 'supprimerUtilisateur'])->name('utilisateurs.supprimer');
});