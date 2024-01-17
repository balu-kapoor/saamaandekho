<div class="prices">
    <div class="product-price-sale">
    <span>
        <span class="price-amount">
            <span>Hourly:</span>
            <bdi>
                <span class="amount">
                    @if($product->daily_price > 0)
                        {{ format_price($product->daily_price) }}
                    @else
                        <span class="n-a">N/A</span>
                    @endif
                </span>
            </bdi>
        </span>
    </span>
</div>
    <div class="product-price-sale">
        <span>
            <span class="price-amount">
                <span>Daily:</span>
                <bdi>
                    <span class="amount">
                        @if($product->weekly_price > 0)
                            {{ format_price($product->weekly_price) }}
                        @else
                            <span class="n-a">N/A</span>
                        @endif
                    </span>
                </bdi>
            </span>
        </span>
    </div>
        <div class="product-price-sale">
            <span>
                <span class="price-amount">
                    <span>Monthly:</span>
                    <bdi>
                        <span class="amount">
                            @if($product->monthly_price > 0)
                                {{ format_price($product->monthly_price) }}
                            @else
                                <span class="n-a">N/A</span>
                            @endif
                        </span>
                    </bdi>
                </span>
            </span>
        </div>
</div>
<div class="prices product-price-sale">
    <span>
        <span class="price-amount">
            <span>Security Deposit:</span>
            <bdi>
                <span class="amount">
                    @if($product->deposit_amount > 0)
                        {{ format_price($product->deposit_amount) }}
                    @else
                        <span class="n-a">N/A</span>
                    @endif
                </span>
            </bdi>
        </span>
    </span>
</div>
<div class="product-price">
    <!-- <span class="product-price-sale d-flex align-items-center @if (!$product->isOnSale()) d-none @endif">
        <del aria-hidden="true">
            <span class="price-amount">
                <bdi>
                    <span class="amount">{{ format_price($product->price_with_taxes) }}</span>
                </bdi>
            </span>
        </del>
        <span>
            <span class="price-amount">
                <bdi>
                    <span class="amount">{{ format_price($product->front_sale_price_with_taxes) }}</span>
                </bdi>
            </span>
        </span>
    </span>
    <span class="product-price-original @if ($product->isOnSale()) d-none @endif">
        <span class="price-amount">
            <bdi>
                <span class="amount">{{ format_price($product->front_sale_price_with_taxes) }}</span>
            </bdi>
        </span>
    </span> -->
              
    <form class="cart-form" action="{{ route('public.cart.add-to-cart') }}" method="POST">
        <input type="hidden" name="id" class="hidden-product-id"
            value="{{ $product->is_variation || !$product->defaultVariation->product_id ? $product->id : $product->defaultVariation->product_id }}" />
            <select id="pricing-options" class="product_price" name="rent_type">
            @if ($product->daily_price > 0)
                <option value="daily" data-price="{{ $product->daily_price }}">Daily</option>
            @endif
            @if ($product->weekly_price > 0)
                <option value="weekly" data-price="{{ $product->weekly_price }}">Weekly</option>
            @endif
            @if ($product->monthly_price > 0)
                <option value="monthly" data-price="{{ $product->monthly_price }}">Monthly</option>
            @endif
            </select>
            @if ($product->daily_price)
                <span class="daily_price">{{ format_price($product->daily_price) }}</span>
            @endif
            @if ($product->weekly_price)
                <span class="weekly_price">{{ format_price($product->weekly_price) }}</span>
            @endif
            @if ($product->monthly_price)
                <span class="monthly_price">{{ format_price($product->monthly_price) }}</span>
            @endif
            {!! Theme::partial('ecommerce.product-quantity', compact('product')) !!}
            <div class="tenure">
                <label class="label-tenure">Tenure:</label>
                <div class="tenure-box">
                    <span class="svg-icon decrease" onclick="decreaseValue()">
                        <svg>
                            <use href="#svg-icon-decrease" xlink:href="#svg-icon-decrease"></use>
                        </svg>
                    </span>
                    <input class="input-text tenure"
                        type="number"
                        step="1"
                        min="1"
                        max="100"
                        name="tenure"
                        value="1"
                        title="Tenure"
                        tabindex="0" required>
                    <span class="svg-icon increase" onclick="increaseValue()">
                        <svg>
                            <use href="#svg-icon-increase" xlink:href="#svg-icon-increase"></use>
                        </svg>
                    </span>
                </div>
            </div>
        <input type="hidden" name="product_price" class="hidden-product-price" value="0.00" />
        <!-- Dropdown for selecting pricing options -->
            <button type="submit" name="add_to_cart" value="1"
                class="btn btn-primary mb-2 add-to-cart-button @if ($product->isOutOfStock()) disabled @endif"
                @if ($product->isOutOfStock()) disabled @endif title="{{ __('Add to cart') }}">
                <span class="svg-icon">
                    <svg>
                        <use href="#svg-icon-cart" xlink:href="#svg-icon-cart"></use>
                    </svg>
                </span>
                <span class="add-to-cart-text ms-2">{{ __('Add to cart') }}</span>
            </button>
    </form>
    <a href="{{ $product->url }}" class="btn-rent btn-primary">Rent Now</a>
</div>

<!-- cart logic -->
<script>
     function increaseValue() {
        var input = document.querySelector('.input-text.tenure');
        var value = parseInt(input.value, 10);
        if (value < 100) {  // Change the maximum value as needed
            input.value = value + 1;
        }
    }

    function decreaseValue() {
        var input = document.querySelector('.input-text.tenure');
        var value = parseInt(input.value, 10);
        if (value > 1) {  // Change the minimum value as needed
            input.value = value - 1;
        }
    }
    // JavaScript to handle dropdown selection and show/hide spans
document.addEventListener('DOMContentLoaded', function() {


    const pricingDropdown = document.getElementById('pricing-options');
    const dailyPriceSpan = document.querySelector('.daily_price');
    const weeklyPriceSpan = document.querySelector('.weekly_price');
    const monthlyPriceSpan = document.querySelector('.monthly_price');

    // Function to show selected price span and hide others
    function showSelectedSpan(selectedValue) {
        if (selectedValue === 'daily') {
            dailyPriceSpan.style.display = 'inline-block';
            weeklyPriceSpan.style.display = 'none';
            monthlyPriceSpan.style.display = 'none';
        } else if (selectedValue === 'weekly') {
            dailyPriceSpan.style.display = 'none';
            weeklyPriceSpan.style.display = 'inline-block';
            monthlyPriceSpan.style.display = 'none';
        } else if (selectedValue === 'monthly') {
            dailyPriceSpan.style.display = 'none';
            weeklyPriceSpan.style.display = 'none';
            monthlyPriceSpan.style.display = 'inline-block';
        }
    }

    // Set initial display based on default selected option
    showSelectedSpan(pricingDropdown.value);

    const selectedOption = pricingDropdown.options[pricingDropdown.selectedIndex];
    const selectedPrice = selectedOption.getAttribute('data-price');
    document.querySelector('.hidden-product-price').value = selectedPrice;
    // Handle dropdown change event
    pricingDropdown.addEventListener('change', function() {
        const selectedValue = this.value;
        showSelectedSpan(selectedValue);

        // Display the respective price based on the selected option type
        const selectedOption = pricingDropdown.options[pricingDropdown.selectedIndex];
        const selectedPrice = selectedOption.getAttribute('data-price');
        const hiddenPriceInput = document.querySelector('.hidden-product-price');
        hiddenPriceInput.value = selectedPrice;
        
        // if (selectedValue === 'daily') {
        //     dailyPriceSpan.textContent = selectedPrice;
        // } else if (selectedValue === 'weekly') {
        //     weeklyPriceSpan.textContent = selectedPrice;
        // } else if (selectedValue === 'monthly') {
        //     monthlyPriceSpan.textContent = selectedPrice;
        // }
    });
})

</script>