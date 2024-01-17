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

class PlansController
{
    public function __construct(Repository $config)
    {
        Assets::setConfig($config->get('plugins.marketplace.assets', []));
    }

    public function index()
    {
        PageTitle::setTitle(__('Membership Plans'));

        // $store = auth('customer')->user()->store;

        // $vendorId = auth('customer')->user()->id;
        // $vendor = Customer::find($vendorId);

        // $kyc = []; 

        return MarketplaceHelper::view('dashboard.plans');
    }
}
