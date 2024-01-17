@extends(BaseHelper::getAdminMasterLayoutTemplate())
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <a href="{{ url('admin/marketplaces/kyc-vendors') }}">Go Back</a>
    </div>
@endif
<div class="row">
    <div class="col-md-3 right-sidebar">
        <div class="widget meta-boxes">
            <div class="widget-title">
                <h4><label for="status" class="control-label" aria-required="true">Verify KYC</label></h4>
            </div>
            <div class="widget-body">
                <div class="form-group mb-3">
                    <div class="border-bottom py-2">
                        <div class="text-center">
                            <div class="text-center">
                                <img src="{{ RvMedia::getImageUrl($vendor->store->logo, 'thumb', false, RvMedia::getDefaultImage()) }}" width="120" class="mb-2" style="border-radius: 50%" alt="avatar" />
                            </div>
                            @if ($vendor->store->id)
                                <div class="text-center">
                                    <strong>
                                        <a href="{{ route('marketplace.store.edit', $vendor->store->id) }}" target="_blank">{{ $vendor->store->name }} <i class="fas fa-external-link-alt"></i></a>
                                    </strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="py-2">
                        <span>{{ trans('plugins/marketplace::store.store_phone') }}:</span>
                        <strong>{{ $vendor->store->phone ?: 'N/A' }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="note note-warning">
            <p>Do you want to approve KYC? <a href="{{ route('marketplace.kyc-vendors.approve-vendor', $vendor->id) }}">Approve it here.</a>
               
            </p>
        </div>

        <div class="widget meta-boxes">
            <div class="widget-title">
                <h4><label for="status" class="control-label" aria-required="true">{{ trans('plugins/marketplace::store.vendor_information') }}</label></h4>
            </div>
            <div class="widget-body">
                <div class="py-2">
                    <span>KYC Video:</span>
                    <div>
                        @if ($vendor->kyc_video)
                            <video controls width="320" height="240" class="mb-10">
                                <source src="{{ asset('storage/' . $vendor->kyc_video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <!-- Video not uploaded -->
                            <p>No video uploaded.</p>
                        @endif
                    </div>
                </div>
                <div class="py-2">
                    <span>ID proof (Aadhar Card/PAN Card):</span>
                    <div>
                        @if ($vendor->adhaar_photo)
                        <img width="320" src="{{ asset('storage/' . $vendor->adhaar_photo) }}" />
                        @else
                            <p>No Photo Uploaded</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
