{!! apply_filters('ecommerce_product_variation_form_start', null, $product) !!}

<div class="row price-group">

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="text-title-field">Hourly Price</label>
            <div class="next-input--stylized">
                <span class="next-input-add-on next-input__add-on--before">{{ get_application_currency()->symbol }}</span>
                <input name="daily_price"
                       class="daily_price next-input input-mask-number regular-price next-input--invisible"
                       step="any"
                       value="{{ old('daily_price', $product ? $product->daily_price : ($originalProduct->daily_price ?? 0)) }}"
                       type="text" required>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="text-title-field">Daily Price</label>
            <div class="next-input--stylized">
                <span class="next-input-add-on next-input__add-on--before">{{ get_application_currency()->symbol }}</span>
                <input name="weekly_price"
                       class="weekly_price next-input input-mask-number regular-price next-input--invisible"
                       step="any"
                       value="{{ old('weekly_price', $product ? $product->weekly_price : ($originalProduct->weekly_price ?? 0)) }}"
                       type="text">
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="text-title-field">Monthly Price</label>
            <div class="next-input--stylized">
                <span class="next-input-add-on next-input__add-on--before">{{ get_application_currency()->symbol }}</span>
                <input name="monthly_price"
                       class="monthly_price next-input input-mask-number regular-price next-input--invisible"
                       step="any"
                       value="{{ old('monthly_price', $product ? $product->monthly_price : ($originalProduct->monthly_price ?? 0)) }}"
                       type="text">
            </div>
        </div>
    </div>
    
</div>

<div class="row price-group">
     <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="text-title-field">Deposit Amount</label>
            <div class="next-input--stylized">
                <span class="next-input-add-on next-input__add-on--before">{{ get_application_currency()->symbol }}</span>
                <input name="deposit_amount"
                       class="deposit_amount next-input input-mask-number regular-price next-input--invisible"
                       data-thousands-separator="{{ EcommerceHelper::getThousandSeparatorForInputMask() }}" data-decimal-separator="{{ EcommerceHelper::getDecimalSeparatorForInputMask() }}"
                       step="any"
                       value="{{ old('deposit_amount', $product ? $product->deposit_amount : ($originalProduct->deposit_amount ?? 0)) }}"
                       type="text">
            </div>
        </div>
    </div>
    <input type="hidden"
           value="{{ old('sale_type', $product ? $product->sale_type : 0) }}"
           class="detect-schedule hidden"
           name="sale_type">

    <div class="col-md-4">
        <div class="form-group mb-3 @if ($errors->has('sku')) has-error @endif">
            <label class="text-title-field">{{ trans('plugins/ecommerce::products.sku') }}</label>
            {!! Form::text('sku', old('sku', $product ? $product->sku : null), ['class' => 'next-input', 'id' => 'sku']) !!}
        </div>
        @if (($isVariation && !$product) || ($product && $product->is_variation && !$product->sku))
            <div class="form-group mb-3">
                <label class="text-title-field">
                    <input type="hidden" name="auto_generate_sku" value="0">
                    <input type="checkbox" name="auto_generate_sku" value="1">
                    &nbsp;{{ trans('plugins/ecommerce::products.form.auto_generate_sku') }}
                </label>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.price') }}</label>
            <div class="next-input--stylized">
                <span class="next-input-add-on next-input__add-on--before">{{ get_application_currency()->symbol }}</span>
                <input name="price"
                       class="next-input input-mask-number regular-price next-input--invisible"
                       data-thousands-separator="{{ EcommerceHelper::getThousandSeparatorForInputMask() }}" data-decimal-separator="{{ EcommerceHelper::getDecimalSeparatorForInputMask() }}"
                       step="any"
                       value="{{ old('price', $product ? $product->price : ($originalProduct->price ?? 0)) }}"
                       type="text">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label class="text-title-field">
                <span class="d-inline-block me-1">{{ trans('plugins/ecommerce::products.form.price_sale') }}</span>
                <a href="javascript:;"
                   class="turn-on-schedule @if (old('sale_type', $product ? $product->sale_type : ($originalProduct->sale_type ?? 0)) == 1) hidden @endif">{{ trans('plugins/ecommerce::products.form.choose_discount_period') }}</a>
                <a href="javascript:;"
                   class="turn-off-schedule @if (old('sale_type', $product ? $product->sale_type : ($originalProduct->sale_type ?? 0)) == 0) hidden @endif">{{ trans('plugins/ecommerce::products.form.cancel') }}</a>
            </label>
            <div class="next-input--stylized">
                <span class="next-input-add-on next-input__add-on--before">{{ get_application_currency()->symbol }}</span>
                <input name="sale_price"
                       class="next-input input-mask-number sale-price next-input--invisible"
                       data-thousands-separator="{{ EcommerceHelper::getThousandSeparatorForInputMask() }}" data-decimal-separator="{{ EcommerceHelper::getDecimalSeparatorForInputMask() }}"
                       value="{{ old('sale_price', $product ? $product->sale_price : ($originalProduct->sale_price ?? null)) }}"
                       type="text">
            </div>
        </div>
    </div>
    <div class="row">
       <div class="col-md-6">
           <div class="form-group mb-3">
               <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.cost_per_item') }}</label>
               <div class="next-input--stylized">
                   <span class="next-input-add-on next-input__add-on--before">{{ get_application_currency()->symbol }}</span>
                   <input name="cost_per_item"
                          class="next-input input-mask-number regular-price next-input--invisible"
                          step="any"
                          value="{{ old('cost_per_item', $product ? $product->cost_per_item : ($originalProduct->cost_per_item ?? 0)) }}"
                          type="text"
                          placeholder="{{ trans('plugins/ecommerce::products.form.cost_per_item_placeholder') }}">
               </div>
               {!! Form::helper(trans('plugins/ecommerce::products.form.cost_per_item_helper')) !!}
           </div>
       </div>
        <input type="hidden" value="{{ $product->id ?? null }}" name="product_id">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.barcode') }}</label>
                <div class="next-input--stylized">
                    <input name="barcode"
                           class="next-input next-input--invisible"
                           step="any"
                           value="{{ old('barcode', $product ? $product->barcode : ($originalProduct->barcode ?? null)) }}"
                           type="text"
                           placeholder="{{ trans('plugins/ecommerce::products.form.barcode_placeholder') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 scheduled-time @if (old('sale_type', $product ? $product->sale_type : ($originalProduct->sale_type ?? 0)) == 0) hidden @endif">
        <div class="form-group mb-3">
            <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.date.start') }}</label>
            <input name="start_date"
                   class="next-input form-date-time"
                   value="{{ old('start_date', $product ? $product->start_date : ($originalProduct->start_date ?? null)) }}"
                   type="text">
        </div>
    </div>
    <div class="col-md-6 scheduled-time @if (old('sale_type', $product ? $product->sale_type : ($originalProduct->sale_type ?? 0)) == 0) hidden @endif">
        <div class="form-group mb-3">
            <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.date.end') }}</label>
            <input name="end_date"
                   class="next-input form-date-time"
                   value="{{ old('end_date', $product ? $product->end_date : ($originalProduct->end_date ?? null)) }}"
                   type="text">
        </div>
    </div>
</div>

<hr/>

{!! apply_filters('ecommerce_product_variation_form_middle', null, $product) !!}

<div class="form-group mb-3">
    <div class="storehouse-management">
        <div class="mt5">
            <input type="hidden" name="with_storehouse_management" value="0">
            <label><input type="checkbox" class="storehouse-management-status" value="1" name="with_storehouse_management" @if (old('with_storehouse_management', $product ? $product->with_storehouse_management : ($originalProduct->with_storehouse_management ?? 0)) == 1) checked @endif> {{ trans('plugins/ecommerce::products.form.storehouse.storehouse') }}</label>
        </div>
    </div>
</div>
<div class="storehouse-info @if (old('with_storehouse_management', $product ? $product->with_storehouse_management : ($originalProduct->with_storehouse_management ?? 0)) == 0) hidden @endif">
    <div class="form-group mb-3">
        <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.storehouse.quantity') }}</label>
        <input type="text"
               class="next-input input-mask-number input-medium"
               value="{{ old('quantity', $product ? $product->quantity : ($originalProduct->quantity ?? 0)) }}"
               name="quantity">
    </div>
    <div class="form-group mb-3">
        <label class="text-title-field">
            <input type="hidden" name="allow_checkout_when_out_of_stock" value="0">
            <input type="checkbox" name="allow_checkout_when_out_of_stock" value="1"
                   @if (old('allow_checkout_when_out_of_stock', $product ? $product->allow_checkout_when_out_of_stock : ($originalProduct->allow_checkout_when_out_of_stock ?? 0)) == 1) checked @endif>
            &nbsp;{{ trans('plugins/ecommerce::products.form.stock.allow_order_when_out') }}
        </label>
    </div>
</div>

<div class="form-group stock-status-wrapper @if (old('with_storehouse_management', $product ? $product->with_storehouse_management : ($originalProduct->with_storehouse_management ?? 0)) == 1) hidden @endif">
    <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.stock_status') }}</label>
    @foreach(\Botble\Ecommerce\Enums\StockStatusEnum::labels() as $status => $label)
        <label class="me-3">
            <input type="radio" name="stock_status" value="{{ $status }}" @checked(old('stock_status', ($product ? $product->stock_status : null)) == $status) />
            {{ $label }}
        </label>

    @endforeach
</div>

<hr/>

@if (! EcommerceHelper::isEnabledSupportDigitalProducts() ||
    (! $product && ! $originalProduct && request()->input('product_type') != Botble\Ecommerce\Enums\ProductTypeEnum::DIGITAL) ||
    ($originalProduct && $originalProduct->isTypePhysical()) || ($product && $product->isTypePhysical()))
    <div class="shipping-management">
        <label class="text-title-field">{{ trans('plugins/ecommerce::products.form.shipping.title') }}</label>
        <div class="row">
            <div class="col-md-3 col-md-6">
                <div class="form-group mb-3">
                    <label>{{ trans('plugins/ecommerce::products.form.shipping.weight') }} ({{ ecommerce_weight_unit() }})</label>
                    <div class="next-input--stylized">
                        <span class="next-input-add-on next-input__add-on--before">{{ ecommerce_weight_unit() }}</span>
                        <input type="text" class="next-input input-mask-number next-input--invisible" name="weight" value="{{ old('weight', $product ? $product->weight : ($originalProduct->weight ?? 0)) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-6">
                <div class="form-group mb-3">
                    <label>{{ trans('plugins/ecommerce::products.form.shipping.length') }} ({{ ecommerce_width_height_unit() }})</label>
                    <div class="next-input--stylized">
                        <span class="next-input-add-on next-input__add-on--before">{{ ecommerce_width_height_unit() }}</span>
                        <input type="text" class="next-input input-mask-number next-input--invisible" name="length" value="{{ old('length', $product ? $product->length : ($originalProduct->length ?? 0)) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-6">
                <div class="form-group mb-3">
                    <label>{{ trans('plugins/ecommerce::products.form.shipping.wide') }} ({{ ecommerce_width_height_unit() }})</label>
                    <div class="next-input--stylized">
                        <span class="next-input-add-on next-input__add-on--before">{{ ecommerce_width_height_unit() }}</span>
                        <input type="text" class="next-input input-mask-number next-input--invisible" name="wide" value="{{ old('wide', $product ? $product->wide : ($originalProduct->wide ?? 0)) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-6">
                <div class="form-group mb-3">
                    <label>{{ trans('plugins/ecommerce::products.form.shipping.height') }} ({{ ecommerce_width_height_unit() }})</label>
                    <div class="next-input--stylized">
                        <span class="next-input-add-on next-input__add-on--before">{{ ecommerce_width_height_unit() }}</span>
                        <input type="text" class="next-input input-mask-number next-input--invisible" name="height" value="{{ old('height', $product ? $product->height : ($originalProduct->height ?? 0)) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (EcommerceHelper::isEnabledSupportDigitalProducts() &&
    ((! $product && ! $originalProduct && request()->input('product_type') == Botble\Ecommerce\Enums\ProductTypeEnum::DIGITAL) ||
        ($originalProduct && $originalProduct->isTypeDigital()) ||
        ($product && $product->isTypeDigital())))

    <div class="form-check mb-3">
        <input type="hidden" name="generate_license_code" value="0">
        <input class="form-check-input" type="checkbox" value="1" name="generate_license_code" id="generate_license_code"
            @checked(old('generate_license_code', $product ? $product->generate_license_code : ($originalProduct->generate_license_code ?? 0)))>
        <label class="form-check-label" for="generate_license_code">
            {{ trans('plugins/ecommerce::products.digital_attachments.generate_license_code_after_purchasing_product') }}
        </label>
    </div>

    <div class="mb-3 product-type-digital-management">
        <label for="product_file" class="mb-2">{{ trans('plugins/ecommerce::products.digital_attachments.title') }}</label>
        <table class="table border">
            <thead>
                <tr>
                    <th width="40"></th>
                    <th>{{ trans('plugins/ecommerce::products.digital_attachments.file_name') }}</th>
                    <th width="100">{{ trans('plugins/ecommerce::products.digital_attachments.file_size') }}</th>
                    <th width="100">{{ trans('core/base::tables.created_at') }}</th>
                    <th class="text-end" width="100"></th>
                </tr>
            </thead>
            <tbody>
                @if ($product)
                    @foreach ($product->productFiles as $file)
                        <tr>
                            <td>
                                {!! Form::checkbox('product_files[' . $file->id . ']', 0, true, ['class' => 'd-none']) !!}
                                {!! Form::checkbox('product_files[' . $file->id . ']', $file->id, true, ['class' => 'digital-attachment-checkbox']) !!}
                            </td>
                            <td>
                                <div>
                                    @if ($file->is_external_link)
                                        <a href="{{ $file->url }}" target="_blank">
                                            <i class="fas fa-link"></i>
                                            <span class="ms-1">{{ $file->basename ? Str::limit($file->basename, 50) : $file->url }}</span>
                                        </a>
                                    @else
                                        <i class="fas fa-paperclip"></i>
                                        <span class="ms-1">{{ Str::limit($file->basename, 50) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $file->file_size ? BaseHelper::humanFileSize($file->file_size) : '-' }}</td>
                            <td>{{ BaseHelper::formatDate($file->created_at) }}</td>
                            <td class="text-end"></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="digital_attachments_input">
            <input type="file" name="product_files_input[]" data-id="{{ Str::random(10) }}">
        </div>
        <div class="mt-2">
            <a href="#" class="digital_attachments_btn">{{ trans('plugins/ecommerce::products.digital_attachments.add') }}</a>
            <span class="px-1">|</span>
            <a href="#" class="digital_attachments_external_btn text-warning">{{ trans('plugins/ecommerce::products.digital_attachments.add_external_link') }}</a>
        </div>
    </div>
    @if (request()->ajax())
        @include('plugins/ecommerce::products.partials.digital-product-file-template')
    @else
        @pushOnce('footer')
            @include('plugins/ecommerce::products.partials.digital-product-file-template')
        @endpushOnce
    @endif
@endif

{!! apply_filters('ecommerce_product_variation_form_end', null, $product) !!}

<script>
    $(document).ready(function() {
    // Click event for the "Save & Exit" button
    $('#botble-marketplace-forms-product-form button').click(function(event) {
        var name = $('#name').val().trim();
        var details = $('#description').val().trim();
        var daily = $('.daily_price').val().trim();
        var weekly = $('.weekly_price').val().trim();
        var monthly = $('.monthly_price').val().trim();
        var deposit = $('.deposit_amount').val().trim();

        if (name === '') {
            alert('Please enter proudct name.');
            return false; // Prevent form submission if validation fails
        }

        if (details === '') {
            alert('Please enter your product description.');
            return false; // Prevent form submission if validation fails
        }

        
        if (daily <= 0 && weekly <= 0 && monthly <= 0) {
            alert('Please enter your at least price for daily, weekly or monthly.');
            return false; // Prevent form submission if validation fails
        }

        if(deposit <= 0) {
            alert('Please enter a deposit amount.');
            return false; // Prevent form submission if validation fails
        }

        var checkboxes = $('input[name="categories[]"]:checked');
        if (checkboxes.length === 0) {
            alert('Please select at least one category.');
            return false; // Prevent form submission if no checkbox is checked
        }


    });
});
</script>