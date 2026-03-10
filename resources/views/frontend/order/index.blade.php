@extends('frontend.home.master')
@section('content')
    <section class="chheckout-section">
        <div class="container">
            <div class="row">
                {{-- Left Checkout Form --}}
                <div class="col-sm-5 cus-order-2">
                    <div class="checkout-shipping">
                        <form action="" method="POST" data-parsley-validate novalidate>
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h6>
                                        যে কোনো পণ্য অর্ডার সম্পূর্ণ করতে, ডেলিভারি চার্জ <span
                                            style="color:#fe5200;">"অর্ডার করুন"</span> এই নম্বরে :
                                        <a class="order-number" href="tel:01800009911">01800009911</a> বিকাশ পেমেন্ট করুন।
                                        ঢাকার ভেতর ৭০ টাকা,
                                        ঢাকার বাহিরে ১৩৫ টাকা
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name">আপনার নাম লিখুন *</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone">আপনার নাম্বার লিখুন *</label>
                                        <input type="text" minlength="11" maxlength="11" pattern="0[0-9]+"
                                            title="0 দিয়ে শুরু করুন" class="form-control" name="phone" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">ঠিকানা লিখুন *</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="area">ডেলিভারি এরিয়া *</label>
                                        <select class="form-control" name="area" required>
                                            <option value="1">ঢাকার ভিতরে ৭০ টাকা</option>
                                            <option value="2">ঢাকার বাইরে ১৩৫ টাকা</option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            value="Cash On Delivery" checked required>
                                        <label class="form-check-label">Cash On Delivery</label>
                                    </div>
                                    <div class="form-group">
                                        <button class="order_place" type="submit">অর্ডার করুন</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Right Cart Table --}}
                {{-- Cart Table --}}
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
                                                <a class="cart_remove" data-id="2ac0b8a7e5bba381f99efb8742b817d4"><i
                                                        class="fas fa-trash text-danger"></i></a>
                                            </td>
                                            <td class="text-left">
                                                <img src="{{ asset($products->image) }}" alt="">
                                                {{ $products->name }}
                                            </td>
                                            <td>
                                                <div class="quantity">
                                                    <button class="minus">-</button>
                                                    <input type="text" class="qty_input" value="1" readonly>
                                                    <button class="plus">+</button>
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
                                            <td><span id="shipping">70</span></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-end">সর্বমোট</th>
                                            <td><span id="grand_total">{{ $products->price + 70 }}</span></td>
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
    <script>
        const pricePerUnit = {{ $products->price }};
        const shippingCost = 70;

        function updateTotals() {
            let totalQty = 0;
            let netTotal = 0;

            document.querySelectorAll('#cartBody tr').forEach(row => {
                const qty = parseInt(row.querySelector('.qty_input').value);
                const priceCell = row.querySelector('.price');
                const rowTotal = pricePerUnit * qty;
                priceCell.textContent = rowTotal;
                netTotal += rowTotal;
                totalQty += qty;
            });

            document.getElementById('net_total').textContent = netTotal;
            document.getElementById('grand_total').textContent = netTotal + shippingCost;
            document.getElementById('cartCount').textContent = totalQty;
        }

        // Increment
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('plus')) {
                const qtyInput = e.target.closest('.quantity').querySelector('.qty_input');
                qtyInput.value = parseInt(qtyInput.value) + 1;
                updateTotals();
            }
        });

        // Decrement
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('minus')) {
                const qtyInput = e.target.closest('.quantity').querySelector('.qty_input');
                if (parseInt(qtyInput.value) > 1) {
                    qtyInput.value = parseInt(qtyInput.value) - 1;
                    updateTotals();
                }
            }
        });

        // Delete
        document.addEventListener('click', function(e) {
            if (e.target.closest('.cart_remove')) {
                const row = e.target.closest('tr');
                row.remove();
                updateTotals();
            }
        });

        // Initial update
        updateTotals();
    </script>
@endpush
