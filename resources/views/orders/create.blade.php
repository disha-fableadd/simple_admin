@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 mini-nav">
            <li class="breadcrumb-item text-white">Order</li>
            <li class="breadcrumb-item text-white active" aria-current="page">Add Order</li>
        </ol>
    </nav>
</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Create Order</h3>
                </div>
                <div class="card-body">
                    <form id="orderForm" method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <!-- Select Customer -->
                        <div class="form-group">
                            <label for="customer">Select Customer</label>
                            <select class="form-control " id="customer" name="customer" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->custid }}">{{ $customer->fname }} {{ $customer->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product Selection -->
                        <div class="form-group" id="product-container">
                            <label for="product">Select Product</label>
                            <select class="form-control productSelect" name="product[]" id="product" required>
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->pid }}" data-price="{{ $product->price }}"
                                        data-image="{{ asset('storage/' . $product->img) }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Add More Button -->
                        <div class="form-group">
                            <button type="button" id="add-more" class="btn btn-primary">Add Product</button>
                        </div>

                        <!-- Order Table -->
                        <table class="table table-bordered" id="orderTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="orderTableBody">
                                <!-- Dynamic rows added here -->
                            </tbody>
                        </table>

                        <!-- Grand Total -->
                        <div class="text-right mt-3">
                            <strong>Grand Total: $<span id="grandTotal">0.00</span></strong>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="button" id="submitOrder" class="btn btn-primary">Submit Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection

    @section('scripts')
    <script>
        $(document).ready(function () {

            function updateTotalPrice() {
                let grandTotal = 0;
                $('#orderTableBody tr').each(function () {
                    grandTotal += parseFloat($(this).find('.totalPrice').text());
                });
                $('#grandTotal').text(grandTotal.toFixed(2));
            }

            function showMessage(message, type = 'danger') {
                const messageContainer = $('#messageContainer');
                if (messageContainer.length === 0) {
                    // Create message container if it doesn't exist
                    $('body').prepend(`<div id="messageContainer" class="alert alert-${type}">${message}</div>`);
                } else {
                    messageContainer.removeClass('alert-danger alert-success').addClass(`alert alert-${type}`);
                    messageContainer.text(message);
                    messageContainer.show();
                }
                setTimeout(() => {
                    messageContainer.hide();
                }, 6000);
            }

            $('#add-more').click(function () {

                const selectedDropdown = $('#product-container select').last();
                const selectedProduct = selectedDropdown.val();
                const selectedProductPrice = selectedDropdown.find('option:selected').data('price');
                const selectedProductName = selectedDropdown.find('option:selected').text();
                const selectedProductImage = selectedDropdown.find('option:selected').data('image');

                if (!selectedProduct) {
                    showMessage('Please select a product before clicking Add More.');
                    return;
                }

                const existingRow = $('#orderTableBody').find(`tr[data-product-id="${selectedProduct}"]`);

                if (existingRow.length > 0) {
                    // Increase quantity if the product already exists
                    const quantityInput = existingRow.find('.quantity');
                    const currentQuantity = parseInt(quantityInput.val());
                    const newQuantity = currentQuantity + 1;
                    quantityInput.val(newQuantity);

                    const newTotalPrice = (newQuantity * selectedProductPrice).toFixed(2);
                    existingRow.find('.totalPrice').text(newTotalPrice);
                } else {
                    // Add new row if product does not exist
                    const row = `
            <tr data-product-id="${selectedProduct}">
                <td>${selectedProductName}</td>
                <td><img src="${selectedProductImage}" alt="${selectedProductName}"    width="100" height="100"></td>
                <td>${selectedProductPrice}</td>
                <td class="quantity-container">
                    <button type="button" class="btn btn-secondary btn-sm decreaseQty">-</button>
                    <input type="number" class="form-control quantity" value="1" min="1" readonly>
                    <button type="button" class="btn btn-secondary btn-sm increaseQty">+</button>
                </td>
                <td class="totalPrice">${selectedProductPrice}</td>
                <td><button type="button" class="btn btn-danger removeProduct">Remove</button></td>
            </tr>
        `;
                    $('#orderTableBody').append(row);
                }

                updateTotalPrice();
                selectedDropdown.val('');
            });

            // Remove or decrease product quantity
            $(document).on('click', '.removeProduct', function () {
                const row = $(this).closest('tr');
                const quantityInput = row.find('.quantity');
                const quantity = parseInt(quantityInput.val(), 10);

                if (quantity > 1) {
                    // Decrease the quantity by 1 if greater than 1
                    quantityInput.val(quantity - 1);
                    const price = parseFloat(row.find('td:nth-child(3)').text());
                    row.find('.totalPrice').text(((quantity - 1) * price).toFixed(2));
                } else {
                    // If quantity is 1, remove the row entirely
                    row.remove();
                }

                updateTotalPrice();
            });

            // Increase product quantity
            $(document).on('click', '.increaseQty', function () {
                const row = $(this).closest('tr');
                const quantityInput = row.find('.quantity');
                const quantity = parseInt(quantityInput.val(), 10);
                const price = parseFloat(row.find('td:nth-child(3)').text());

                quantityInput.val(quantity + 1);
                row.find('.totalPrice').text(((quantity + 1) * price).toFixed(2));

                updateTotalPrice();
            });

            // Decrease product quantity
            $(document).on('click', '.decreaseQty', function () {
                const row = $(this).closest('tr');
                const quantityInput = row.find('.quantity');
                const quantity = parseInt(quantityInput.val(), 10);
                const price = parseFloat(row.find('td:nth-child(3)').text());

                if (quantity > 1) {
                    quantityInput.val(quantity - 1);
                    row.find('.totalPrice').text(((quantity - 1) * price).toFixed(2));
                    updateTotalPrice();
                }
            });

            // Final order submit
            $('#submitOrder').click(function () {
                const customerId = $('#customer').val();
                const orderItems = [];
                $('#orderTableBody tr').each(function () {
                    const productId = $(this).data('product-id'); // Corrected key
                    const quantity = parseInt($(this).find('.quantity').val());
                    const price = parseFloat($(this).find('td:nth-child(3)').text());
                    const totalPrice = parseFloat($(this).find('.totalPrice').text());
                    const image = $(this).find('img').attr('src');

                    orderItems.push({
                        productId: productId, // Now correctly set
                        quantity: quantity,
                        price: price,
                        totalPrice: totalPrice,
                        image: image
                    });
                });

                console.log('Order Items:', orderItems); // Debugging

                if (orderItems.length === 0) {
                    showMessage('Please add items to the order before submitting.', 'danger');
                    return;
                }

                if (!customerId) {
                    showMessage('Please select a customer before submitting the order.', 'danger');
                    return;
                }

                $.ajax({
                    url: '{{ route('orders.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        customerId: customerId,
                        orderItems: orderItems,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status === 'success') {
                            showMessage('Order submitted successfully!', 'success');
                            setTimeout(function () {
                                window.location.href = '{{ route('orders.display') }}';
                            }, 500);
                        } else {
                            showMessage('Failed to submit order. Please try again.', 'danger');
                        }
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            showMessage(xhr.responseJSON.message, 'danger');
                        } else {
                            showMessage('An error occurred while submitting the order.', 'danger');
                        }
                    }
                });
            });

        });
    </script>
    @endsection