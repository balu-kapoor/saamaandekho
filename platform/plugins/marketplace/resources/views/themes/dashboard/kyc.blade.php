@extends(MarketplaceHelper::viewPath('dashboard.layouts.master'))
@section('content')
    <div class="card">
        <div class="card-body p-lg-5">
            {!! Form::open(['route' => 'marketplace.vendor.kyc', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="display: flex; flex-direction: column">
                            <label for="logo">{{ __('Video') }}</label>
                            @if ($vendor->kyc_video)
                                <video controls width="320" height="240" class="mb-10">
                                    <source src="{{ asset('storage/' . $vendor->kyc_video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <!-- Video not uploaded -->
                                <p>No video uploaded.</p>
                            @endif
                            <input type="file" name="kyc_video" />
                            <div class="summary m-3">
                                <h4>Record a live video holding your ID proof (Aadhar Card/PAN Card) for a max. of 30 seconds. Ensure no one else is in the frame, and your face is clearly visible. Display the document vertically.</h4>
                             </div>
                        </div>

                        <div class="form-group">
                            <label for="logo">{{ __('Aadhar Card/PAN Card Photo') }}</label>
                            {!! Form::customImage('adhaar_photo', old('adhaar_photo', $vendor->adhaar_photo)) !!}
                            {!! Form::error('adhaar_photo', $errors) !!}
                            <div class="summary m-3">
                               <h4> Upload your ID proof (Aadhar Card/PAN Card).</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Secure, quick, and hassle-free KYC process awaits you</h5>
                <div class="row">
                    <input class="ps-btn success" type="submit" name="save" value="Save" />
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
