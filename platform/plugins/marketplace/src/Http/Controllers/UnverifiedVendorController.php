<?php

namespace Botble\Marketplace\Http\Controllers;

use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Models\Customer;
use Botble\Marketplace\Facades\MarketplaceHelper;
use Botble\Marketplace\Tables\UnverifiedVendorTable;
use Botble\Marketplace\Tables\KYCVendorTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UnverifiedVendorController extends BaseController
{
    public function index(UnverifiedVendorTable $table)
    {
        PageTitle::setTitle(trans('plugins/marketplace::unverified-vendor.name'));

        return $table->renderTable();
    }

    public function view(int|string $id)
    {
        $vendor = Customer::query()
            ->where([
                'id' => $id,
                'is_vendor' => true,
            ])
            ->findOrFail($id);

        if ($vendor->vendor_verified_at) {
            return route('customers.edit', $vendor->id);
        }

        PageTitle::setTitle(trans('plugins/marketplace::unverified-vendor.verify', ['name' => $vendor->name]));

        Assets::addScriptsDirectly(['vendor/core/plugins/marketplace/js/marketplace-vendor.js']);

        return view('plugins/marketplace::customers.verify-vendor', compact('vendor'));
    }

    public function approveVendor(int|string $id, Request $request, BaseHttpResponse $response)
    {
        $vendor = Customer::query()
            ->where([
                'id' => $id,
                'is_vendor' => true,
                'vendor_verified_at' => null,
            ])
            ->firstOrFail();

        $vendor->vendor_verified_at = Carbon::now();
        $vendor->save();

        event(new UpdatedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $vendor));

        if (MarketplaceHelper::getSetting('verify_vendor', 1) && ($vendor->store->email || $vendor->email)) {
            EmailHandler::setModule(MARKETPLACE_MODULE_SCREEN_NAME)
                ->setVariableValues([
                    'store_name' => $vendor->store->name,
                ])
                ->sendUsingTemplate('vendor-account-approved', $vendor->store->email ?: $vendor->email);
        }

        return $response
            ->setPreviousUrl(route('marketplace.unverified-vendors.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function getKYC(KYCVendorTable $table) {

        // $store = auth('customer')->user()->store;

        // $vendorId = $store->id;
        PageTitle::setTitle('Verify KYC');

        return $table->renderTable();

         PageTitle::setTitle('KYC Details');

        return $table->renderTable();

        $vendors = Customer::all();

        PageTitle::setTitle(trans('Verify KYC', ['name' => 'KYC']));

        Assets::addScriptsDirectly(['vendor/core/plugins/marketplace/js/marketplace-vendor.js']);

        return view('plugins/marketplace::customers.verify-kyc', compact('vendors'));
    }

    public function viewKYC(int|string $id) {
        // dd($id);
        $vendor = Customer::query()
            ->where([
                'id' => $id,
                'is_kyc_approved' => NULL,
            ])
            ->find($id);
        
        // dd($vendor);
        if ($vendor == null) {
            return redirect(route('marketplace.kyc-vendors.index'));
        }

        PageTitle::setTitle(trans('plugins/marketplace::unverified-vendor.verify', ['name' => $vendor->name]));

        Assets::addScriptsDirectly(['vendor/core/plugins/marketplace/js/marketplace-vendor.js']);

        return view('plugins/marketplace::customers.verify-kyc', compact('vendor'));
    }

    public function approveKYC(int|string $id, Request $request, BaseHttpResponse $response) {
        // dd($id);
         $vendor = Customer::query()
            ->where([
                'id' => $id,
                'is_vendor' => true,
            ])
            ->firstOrFail();
        // dd($vendor);
        $vendor->is_kyc_approved = true;
        $vendor->save();

         return $response
            ->setPreviousUrl(route('marketplace.kyc-vendors.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
        // return redirect()->back()->with('success', trans('core/base::notices.update_success_message'));

    }
}
