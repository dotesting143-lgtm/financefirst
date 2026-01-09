<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Clients;
use App\Livewire\Users;
use App\Livewire\SuitabilityLetter;
use App\Livewire\MortgageSuitabilityLetter;
use App\Livewire\PersonalAccSuitabilityLetter;
use App\Livewire\PensionLetter;
use App\Livewire\ThankyouLetter;
use App\Livewire\PersonalAccThankyouLetter;
use App\Livewire\MortgageThankyouLetter;
use App\Livewire\PensionThankyouLetter;
use App\Livewire\Products;
use App\Livewire\ProductNotes;
use App\Livewire\PaymentTracker;
use App\Livewire\ProductCounts;
use App\Livewire\BrokerProductivity;
use App\Livewire\InsurerReport;
use App\Livewire\CommissionDue;
use App\Livewire\PaymentTrackerReport;
use App\Http\Controllers\PdfLetterController;
use App\Http\Controllers\PdfNotesController;
use App\Http\Controllers\PdfThankyouController;

//Route::redirect('/', '/login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
    Route::get('clients', Clients::class)->middleware('auth')->name('clients');
    Route::get('users', Users::class)->name('users');
    Route::get('suitabilityletter', SuitabilityLetter::class)->name('suitabilityletter');
    Route::get('mortgagesuitabilityletter', MortgageSuitabilityLetter::class)->name('mortgagesuitabilityletter');
    Route::get('personalaccsuitabilityletter', PersonalAccSuitabilityLetter::class)->name('personalaccsuitabilityletter');
    Route::get('pensionletter', PensionLetter::class)->name('pensionletter');
    Route::get('thankyouletter', ThankyouLetter::class)->name('thankyouletter');
    Route::get('personalacc-thankyouletter', PersonalAccThankyouLetter::class)->name('personalacc-thankyouletter');
    Route::get('mortgage-thankyouletter', MortgageThankyouLetter::class)->name('mortgage-thankyouletter');
    Route::get('pension-thankyouletter', PensionThankyouLetter::class)->name('pension-thankyouletter');
    Route::get('products', Products::class)->name('products');
    Route::get('product-notes', ProductNotes::class)->name('product-notes');
    Route::get('payment-tracker', PaymentTracker::class)->name('payment-tracker');
    Route::get('product-count', ProductCounts::class)->name('product-count');
    Route::get('broker-productivity', BrokerProductivity::class)->name('broker-productivity');
    Route::get('insurer-report', InsurerReport::class)->name('insurer-report');
    Route::get('commission-due', CommissionDue::class)->name('commission-due');
    Route::get('payment-tracker-report', PaymentTrackerReport::class)->name('payment-tracker-report');
    Route::get('/pdf/letter', [PdfLetterController::class, 'generate'])->name('pdf.letter');
    Route::get('/pdf/notes', [PdfNotesController::class, 'generate'])->name('pdf.notes');
    Route::get('/pdf/thankyou', [PdfThankyouController::class, 'generate'])->name('pdf.thankyou');
});

Route::get('/', function () {
    return redirect('/clients');
});