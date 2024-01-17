<?php

namespace Botble\Marketplace\Http\Controllers\Fronts;

use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Marketplace\Facades\MarketplaceHelper;
use Botble\Marketplace\Http\Requests\SettingRequest;
use Botble\Marketplace\Models\Store;
use Botble\Media\Facades\RvMedia;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Botble\Marketplace\Models\VendorInfo;
use Botble\Ecommerce\Models\Customer;

class KYCController
{
    public function __construct(Repository $config)
    {
        Assets::setConfig($config->get('plugins.marketplace.assets', []));
    }

    public function index()
    {
        PageTitle::setTitle(__('KYC'));

        Assets::addScriptsDirectly('vendor/core/plugins/location/js/location.js');

        $store = auth('customer')->user()->store;

        $vendorId = auth('customer')->user()->id;
        $vendor = Customer::find($vendorId);

        $kyc = []; 

        return MarketplaceHelper::view('dashboard.kyc', compact(['store', 'vendor']));
    }

    public function saveKYCDetails(Request $request, BaseHttpResponse $response)
    {

    	//  $request->validate([
	    //     'kyc_video' => 'required|file|mimes:mp4|max:20480', // Example video validation rules
	    //     'adhaar_photo' => 'required|image|mimes:jpeg,png,jpg|max:4096', // Example Aadhaar photo validation rules
	    //     'pan_photo' => 'required|image|mimes:jpeg,png,jpg|max:4096', // Example PAN photo validation rules
	    //     // Add other validation rules for other fields here
	    // ]);
    	// dd($request->all());
        $store = auth('customer')->user()->store;

        $vendorId = auth('customer')->user()->id;
        $vendor = Customer::find($vendorId);

        // Handle video upload
	    if ($request->hasFile('kyc_video')) {
		    $result = RvMedia::handleUpload($request->file('kyc_video'), 0, $store->upload_folder);
            if (! $result['error']) {
                $file = $result['data'];
                // $request->merge(['kyc_video' => $file->url]);
                $vendor->kyc_video = $file->url;
	        	$vendor->save();
            }
		}

		 if ($request->hasFile('adhaar_photo_input')) {
            $result = RvMedia::handleUpload($request->file('adhaar_photo_input'), 0, $store->upload_folder);
            if (! $result['error']) {
                $file = $result['data'];
                $request->merge(['adhaar_photo' => $file->url]);
                $vendor->adhaar_photo = $request->input('adhaar_photo');
	        	$vendor->save();
            }
        }

		if ($request->hasFile('pan_photo_input')) {
            $result = RvMedia::handleUpload($request->file('pan_photo_input'), 0, $store->upload_folder);
            if (! $result['error']) {
                $file = $result['data'];
                $request->merge(['pan_photo' => $file->url]);
                $vendor->pan_photo = $request->input('pan_photo');
	        	$vendor->save();
            }
        }


        // $customer = $store->customer;

        // if ($customer && $customer->id) {
        //     $vendorInfo = $customer->vendorInfo;
        //     $vendorInfo->payout_payment_method = $request->input('payout_payment_method');
        //     $vendorInfo->bank_info = $request->input('bank_info', []);
        //     $vendorInfo->tax_info = $request->input('tax_info', []);
        //     $vendorInfo->save();
        // }

        return $response
            ->setNextUrl(route('marketplace.vendor.kyc'))
            ->setMessage(__('Added successfully!'));
    }
}
