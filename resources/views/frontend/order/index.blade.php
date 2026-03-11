@extends('frontend.home.master')

@section('content')
<section class="chheckout-section">
    <div class="container">
        <div class="row">
            {{-- Left Checkout Form --}}
            <div class="col-sm-5 cus-order-2">
                <div class="checkout-shipping">
                    <form action="{{ route('user.order', $products->id) }}" method="POST" data-parsley-validate novalidate>
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h6>
                                    যে কোনো পণ্য অর্ডার সম্পূর্ণ করতে, ডেলিভারি চার্জ 
                                    <span style="color:#fe5200;">"অর্ডার করুন"</span> এই নম্বরে : 
                                    <a class="order-number" href="tel:01800009911">01800009911</a> 
                                    বিকাশ পেমেন্ট করুন। ঢাকার ভেতর ৭০ টাকা, ঢাকার বাইরে ১৩৫ টাকা
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="name">আপনার নাম লিখুন *</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">আপনার নাম্বার লিখুন *</label>
                                    <input type="text" minlength="11" maxlength="11" pattern="0[0-9]+" title="0 দিয়ে শুরু করুন" class="form-control" name="phone" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">ঠিকানা লিখুন *</label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="delivary_charge">ডেলিভারি এরিয়া *</label>
                                    <select class="form-control" id="delivary_charge" name="delivary_charge" required>
                                        <option value="0">ডেলিভারি চার্জ নির্বাচন করুন</option>
                                        <option value="70">ঢাকার ভিতরে ৭০ টাকা</option>
                                        <option value="135">ঢাকার বাইরে ১৩৫ টাকা</option>
                                    </select>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" value="Cash On Delivery" checked required>
                                    <label class="form-check-label">Cash On Delivery</label>
                                </div>

                                {{-- Hidden input for total price --}}
                                <input type="hidden" name="total_price" id="total_price_input" value="{{ $products->price }}">
                                <input type="hidden" name="quantity" id="quantity_input" value="1">

                                <div class="form-group">
                                    <button class="order_place" type="submit">অর্ডার করুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Right Cart Table --}}
            <div class="col-sm-7 cust-order-1">
                <div class="cart_details table-responsive-sm">
                    <div class="card">
                        <div class="card-header">
                            <h5>অর্ডারের তথ্য</h5>
                        </div>
                        <div class="card-body cartlist">
                            <table class="cart_table table table-bordered table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th>ডিলিট</th>
                                        <th>প্রোডাক্ট</th>
                                        <th>পরিমাণ</th>
                                        <th>মূল্য</th>
                                    </tr>
                                </thead>
                                <tbody id="cartBody">
                                    <tr data-id="1">
                                        <td>
                                            <a class="cart_remove" data-id="{{ $products->id }}">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <img src="{{ asset($products->image) }}" alt=""> {{ $products->name }}
                                        </td>
                                        <td>
                                            <div class="quantity">
                                                <button type="button" class="minus">-</button>
                                                <input type="text" class="qty_input" value="1" readonly>
                                                <button type="button" class="plus">+</button>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="price">{{ $products->price }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">মোট</th>
                                        <td><span id="net_total">{{ $products->price }}</span></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">ডেলিভারি চার্জ</th>
                                        <td><span id="shipping">0</span></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">সর্বমোট</th>
                                        <td><span id="grand_total">{{ $products->price }}</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
const productPrice = {{ $products->price }};

// Update totals function
function updateTotals() {
    const qtyInput = document.querySelector('.qty_input');
    const qty = parseInt(qtyInput.value);
    const delivary = parseFloat($('#delivary_charge').val()) || 0;

    const netTotal = productPrice * qty;
    const grandTotal = netTotal + delivary;

    document.querySelector('.price').textContent = netTotal;
    document.getElementById('net_total').textContent = netTotal;
    document.getElementById('shipping').textContent = delivary;
    document.getElementById('grand_total').textContent = grandTotal;

    // Update hidden inputs
    document.getElementById('quantity_input').value = qty;
    document.getElementById('total_price_input').value = grandTotal;
}

// Increment / Decrement
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('plus')) {
        const qtyInput = e.target.closest('.quantity').querySelector('.qty_input');
        qtyInput.value = parseInt(qtyInput.value) + 1;
        updateTotals();
    }
    if (e.target.classList.contains('minus')) {
        const qtyInput = e.target.closest('.quantity').querySelector('.qty_input');
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            updateTotals();
        }
    }
    if (e.target.closest('.cart_remove')) {
        const row = e.target.closest('tr');
        row.remove();
        updateTotals();
    }
});

// Update on delivery change
$('#delivary_charge').on('change', function() {
    updateTotals();
});

// Initial calculation
updateTotals();
</script>
{{-- delivary_charge --}}
    <script>
  
        $(document).ready(function() {
            let productPrice = {{ $products->price }}; 

            $('#delivary_charge').on('change', function() {
                let delivary_charge = parseFloat($(this).val());

                if (!isNaN(delivary_charge)) {
             
                    $('#shipping').text(delivary_charge);

                    let grandTotal = productPrice + delivary_charge;
                    $('#grand_total').text(grandTotal);
                } else {
              
                    $('#shipping').text(0);
                    $('#grand_total').text(productPrice);
                }
            });
        });
    </script>
@endpush