<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use BT\Modules\CompanyProfiles\Controllers\CompanyProfileController;
use BT\Modules\CompanyProfiles\Controllers\LogoController;

// Public logo route (no auth.admin) so email/client-facing <img> tags can load
// the logo without an authenticated admin session. Declared before the admin
// group and name-first per the SP route-loading quirk noted in AppServiceProvider.
Route::name('companyProfiles.logo')->get('company_profiles/{id}/logo', [LogoController::class, 'logo']);

Route::middleware(['web', 'auth.admin'])
    ->prefix('company_profiles')->name('companyProfiles.')->group(function () {
        Route::name('index')->get('/', [CompanyProfileController::class, 'index']);
        Route::name('create')->get('create', [CompanyProfileController::class, 'create']);
        Route::name('store')->post('/', [CompanyProfileController::class, 'store']);
        Route::name('edit')->get('{id}/edit', [CompanyProfileController::class, 'edit']);
        Route::name('update')->post('{id}', [CompanyProfileController::class, 'update']);
        Route::name('delete')->get('{id}/delete', [CompanyProfileController::class, 'delete']);
        Route::name('ajax.modalLookup')->post('ajax/modal_lookup', [CompanyProfileController::class, 'ajaxModalLookup']);
        Route::name('deleteLogo')->post('{id}/delete_logo', [CompanyProfileController::class, 'deleteLogo']);
    });
