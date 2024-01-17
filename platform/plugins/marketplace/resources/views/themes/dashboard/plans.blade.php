@extends(MarketplaceHelper::viewPath('dashboard.layouts.master'))
@section('content')
    <div class="card">
        <div class="card-body p-lg-5">
            <div class="plans-container">
                <div class="plan basic">
                    <h2>Basic</h2>
                    <p>Access to basic features</p>
                    <p>Price: ₹100/year</p>
                    <p>3 Products</p>
                    <button>Select</button>
                </div>
                <div class="plan standard">
                    <h2>Standard</h2>
                    <p>Access to standard features</p>
                    <p>Price: ₹200/year</p>
                    <p>6 Products</p>
                    <button>Select</button>
                </div>
                <div class="plan platinum">
                    <h2>Platinum</h2>
                    <p>Access to premium features</p>
                    <p>Price: ₹300/year</p>
                    <p>12 Products</p>
                    <button>Select</button>
                </div>
            </div>
        </div>
    </div>
@stop
<style>

/* Style the plans container */
.plans-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-top: 50px;
}

/* Style individual plan cards */
.plan {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    width: 250px;
    text-align: center;
}

/* Style specific plans */
.basic {
    background-color: #f5f5f5;
}

.standard {
    background-color: #e6e6e6;
}

.platinum {
    background-color: #d9d9d9;
}

/* Style plan headings */
h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

/* Style buttons */
button {
    padding: 8px 16px;
    margin-top: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>