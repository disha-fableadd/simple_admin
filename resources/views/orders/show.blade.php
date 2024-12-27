@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent px-0 mini-nav">
      <li class="breadcrumb-item text-white">Order</li>
      <li class="breadcrumb-item text-white active" aria-current="page">Order Items Details</li>
    </ol>
  </nav>
</div>

<!-- Main Content -->
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card bg-default shadow">
        <div class="card-header bg-transparent border-0">
          <h3 class="mb-0 text-white">Order Details</h3>
          <p class="text-white mt-4"> Order Date: {{ $order->created_at }}</p>
          <p class="text-white">Customer: {{ $order->customer->fname }} {{ $order->customer->lname }}</p>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->orderItems as $item)
          <tr id="order-item-{{ $item->oitemid }}">
          <td>{{ $item->product->name }}</td>
          <td><img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" width="100" height="100"></td>
          <td>${{ number_format($item->price, 2) }}</td>
          <td>
            <button class="decreaseQtyBtn btn btn-sm " data-item-id="{{ $item->oitemid }}">-</button>
            <span id="qty-{{ $item->oitemid }}" class="text-center">{{ $item->qty }}</span>
            <button class="increaseQtyBtn btn btn-sm " data-item-id="{{ $item->oitemid }}">+</button>
          </td>
          <td id="totalprice-{{ $item->oitemid }}">${{ number_format($item->totalprice, 2) }}</td>
          <td>
            <button class="btn btn-danger deleteItemBtn" data-item-id="{{ $item->oitemid }}">Delete</button>
          </td>
          </tr>
        @endforeach
            </tbody>
          </table>
        </div>

        <!-- Footer Section with Total Price -->
        <div class="card-footer bg-transparent">
          <div class="d-flex justify-content-between">
            <span class="text-white ml-auto">Total Price: $<span
                id="overall-total">{{ number_format($order->orderItems->sum('totalprice'), 2) }}</span></span>
          </div>

          <!-- Only show the 'Complete Order' button if the order is not completed -->
          @if ($order->status != 'completed')
            <form action="{{ route('completed') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" id="completeOrderBtn" class="btn btn-success">Complete Order</button>
            </form>
            <a href="{{ route('orders.display') }}" class="btn btn-primary">Back to All Orders</a>
          @else
          <a href="{{ route('completed') }}" class="btn btn-primary">Back to Completed Orders</a>
        @endif
        </div>
        <div id="message" class="alert" style="display: none;"></div>
      </div>
    </div>
  </div>


  <!-- JavaScript for Dynamic Updates -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const updateOverallTotal = () => {
        let overallTotal = 0;
        document.querySelectorAll('td[id^="totalprice-"]').forEach(cell => {
          overallTotal += parseFloat(cell.textContent.replace('$', ''));
        });
        document.getElementById('overall-total').textContent = overallTotal.toFixed(2);
      };

      const updateItemRow = async (itemId, action) => {
        const qtySpan = document.getElementById(`qty-${itemId}`);
        const totalPriceCell = document.getElementById(`totalprice-${itemId}`);
        const currentQty = parseInt(qtySpan.textContent);
        const newQty = action === 'increase' ? currentQty + 1 : Math.max(currentQty - 1, 1);

        console.log(`Updating item ${itemId}, action: ${action}, currentQty: ${currentQty}, newQty: ${newQty}`);

        try {
          const response = await fetch(`/orders/${itemId}`, {
            method: 'PATCH',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ qty: newQty })
          });

          console.log('Response status:', response.status);

          if (!response.ok) {
            const errorResponse = await response.json();
            console.error('Response error:', errorResponse);
            throw new Error('Failed to update quantity.');
          }

          const data = await response.json();
          console.log('Updated data:', data);

          // Update DOM
          qtySpan.textContent = newQty;
          totalPriceCell.textContent = `$${(data.totalPrice).toFixed(2)}`;
          updateOverallTotal();
        } catch (error) {
          console.error('Error updating item:', error.message);
          alert('Error updating quantity. Please try again.');
        }
      };


      document.querySelectorAll('.increaseQtyBtn').forEach(button => {
        button.addEventListener('click', () => updateItemRow(button.dataset.itemId, 'increase'));
      });

      document.querySelectorAll('.decreaseQtyBtn').forEach(button => {
        button.addEventListener('click', () => updateItemRow(button.dataset.itemId, 'decrease'));
      });




      const deleteOrderItem = async (itemId) => {
        try {
          const response = await fetch(`/orders/${itemId}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
          });

          if (!response.ok) {
            throw new Error('Failed to delete the item.');
          }

          document.getElementById(`order-item-${itemId}`).remove();

          const remainingItems = document.querySelectorAll('tr[id^="order-item-"]').length;
          if (remainingItems === 0) {
            window.location.href = '/orders';
          } else {
            updateOverallTotal1();
          }
        } catch (error) {
          console.error(error.message);
          alert('Error deleting the item. Please try again.');
        }
      };

      // Attach event listeners to all delete buttons
      document.querySelectorAll('.deleteItemBtn').forEach((button) => {
        button.addEventListener('click', function () {
          const itemId = this.dataset.itemId;
          if (confirm('Are you sure you want to delete this item?')) {
            deleteOrderItem(itemId);
          }
        });
      });

      // Function to update the overall total after deletion
      const updateOverallTotal1 = () => {
        let overallTotal = 0;
        document.querySelectorAll('td[id^="totalprice-"]').forEach((cell) => {
          overallTotal += parseFloat(cell.textContent.replace('$', ''));
        });
        if (overallTotal === 0) {
          document.getElementById('overall-total').textContent = '0.00'; // Set to 0 if no items
        } else {
          document.getElementById('overall-total').textContent = overallTotal.toFixed(2);
        }
      };

    });
  </script>
  @endsection