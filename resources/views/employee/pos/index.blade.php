@extends('layouts.app')

@section('title', 'Point of Sale')
@section('subtitle', 'Process customer orders efficiently')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <span class="text-gray-500 font-medium">Point of Sale</span>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Menu Items Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-utensils text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Menu Items</h2>
                        <p class="text-sm text-gray-600">Select items to add to order</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach($menuItems as $menuItem)
                    @php
                        $canBeMade = $menuItem->canBeMade();
                    @endphp
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200/60 hover:shadow-lg transition-all duration-300 hover:scale-105 group">
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="font-bold text-gray-900 text-lg group-hover:text-green-600 transition-colors">
                                    {{ $menuItem->name }}
                                </h3>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold {{ $canBeMade ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas {{ $canBeMade ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                    {{ $canBeMade ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                            
                            <p class="text-2xl font-black text-green-600 mb-4">
                                Rp {{ number_format($menuItem->price, 0, ',', '.') }}
                            </p>
                            
                            <button class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed group/add-btn add-to-order"
                                    data-menu-item-id="{{ $menuItem->id }}"
                                    data-menu-item-name="{{ $menuItem->name }}"
                                    data-menu-item-price="{{ $menuItem->price }}"
                                    {{ !$canBeMade ? 'disabled' : '' }}>
                                <i class="fas fa-plus mr-2"></i>
                                Add to Order
                                <i class="fas fa-arrow-right ml-2 transform group-hover/add-btn:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Current Order Section -->
    <div class="space-y-6">
        <!-- Order Summary -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-receipt text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Current Order</h2>
                        <p class="text-sm text-gray-600">Order summary and total</p>
                    </div>
                </div>
            </div>
            
            <form id="order-form" action="{{ route('employee.pos.store') }}" method="POST" class="p-6">
                @csrf
                
                <!-- Order Items -->
                <div id="order-items" class="space-y-3 max-h-96 overflow-y-auto mb-6">
                    <!-- Order items will be added here dynamically -->
                    <div id="empty-order" class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shopping-cart text-gray-400 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">No items added</h4>
                        <p class="text-gray-600">Select items from the menu to start an order</p>
                    </div>
                </div>

                <!-- Order Total -->
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-lg font-semibold text-gray-700">Subtotal:</span>
                        <span class="text-lg font-bold text-gray-900" id="subtotal-amount">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-lg font-semibold text-gray-700">Tax (10%):</span>
                        <span class="text-lg font-bold text-gray-900" id="tax-amount">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-200 pt-2">
                        <span class="text-xl font-bold text-gray-900">Total:</span>
                        <span class="text-2xl font-black text-green-600" id="total-amount">Rp 0</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <button type="submit" 
                            class="w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submit-order"
                            disabled>
                        <i class="fas fa-check-circle mr-2"></i>
                        Place Order
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                    
                    <button type="button" 
                            id="clear-order"
                            class="w-full flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <i class="fas fa-trash mr-2"></i>
                        Clear Order
                    </button>
                </div>
            </form>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h3 class="text-lg font-bold text-gray-900">Quick Stats</h3>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $availableItems = 0;
                    $outOfStockItems = 0;
                    foreach($menuItems as $menuItem) {
                        if ($menuItem->canBeMade()) {
                            $availableItems++;
                        } else {
                            $outOfStockItems++;
                        }
                    }
                @endphp
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Available Items:</span>
                    <span class="font-bold text-green-600">{{ $availableItems }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Out of Stock:</span>
                    <span class="font-bold text-red-600">{{ $outOfStockItems }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Items:</span>
                    <span class="font-bold text-gray-900">{{ $menuItems->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let orderItems = [];
let subtotal = 0;
let taxRate = 0.10; // 10% tax

function updateOrderDisplay() {
    const orderItemsContainer = document.getElementById('order-items');
    const emptyOrder = document.getElementById('empty-order');
    const subtotalElement = document.getElementById('subtotal-amount');
    const taxElement = document.getElementById('tax-amount');
    const totalElement = document.getElementById('total-amount');
    const submitButton = document.getElementById('submit-order');
    const clearButton = document.getElementById('clear-order');

    // Calculate totals
    subtotal = orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = subtotal * taxRate;
    const total = subtotal + tax;

    // Update display
    subtotalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
    taxElement.textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;

    // Update order items display
    if (orderItems.length === 0) {
        orderItemsContainer.innerHTML = `
            <div id="empty-order" class="text-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-gray-400 text-2xl"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">No items added</h4>
                <p class="text-gray-600">Select items from the menu to start an order</p>
            </div>
        `;
        submitButton.disabled = true;
        clearButton.disabled = true;
    } else {
        orderItemsContainer.innerHTML = orderItems.map((item, index) => `
            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900">${item.name}</h4>
                    <p class="text-sm text-gray-600">Rp ${item.price.toLocaleString('id-ID')} × ${item.quantity}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="font-bold text-green-600">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="quantity-btn decrease-quantity w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center hover:bg-red-600 transition-colors" data-index="${index}">
                            <i class="fas fa-minus text-xs"></i>
                        </button>
                        <span class="quantity-display w-8 text-center font-bold">${item.quantity}</span>
                        <button type="button" class="quantity-btn increase-quantity w-8 h-8 bg-green-500 text-white rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors" data-index="${index}">
                            <i class="fas fa-plus text-xs"></i>
                        </button>
                        <button type="button" class="remove-item w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center hover:bg-red-600 transition-colors" data-index="${index}">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
        
        submitButton.disabled = false;
        clearButton.disabled = false;

        // Add event listeners to dynamic buttons
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                if (this.classList.contains('increase-quantity')) {
                    orderItems[index].quantity++;
                } else if (this.classList.contains('decrease-quantity')) {
                    if (orderItems[index].quantity > 1) {
                        orderItems[index].quantity--;
                    } else {
                        orderItems.splice(index, 1);
                    }
                }
                updateOrderDisplay();
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                orderItems.splice(index, 1);
                updateOrderDisplay();
            });
        });
    }

    // Add hidden inputs for form submission
    const form = document.getElementById('order-form');
    // Remove existing hidden inputs
    document.querySelectorAll('input[name^="items"]').forEach(input => input.remove());
    
    // Add new hidden inputs
    orderItems.forEach((item, index) => {
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = `items[${index}][menu_item_id]`;
        idInput.value = item.menu_item_id;
        form.appendChild(idInput);

        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = `items[${index}][quantity]`;
        quantityInput.value = item.quantity;
        form.appendChild(quantityInput);
    });
}

// Add to order functionality
document.querySelectorAll('.add-to-order').forEach(button => {
    button.addEventListener('click', function() {
        const menuItemId = this.dataset.menuItemId;
        const menuItemName = this.dataset.menuItemName;
        const menuItemPrice = parseFloat(this.dataset.menuItemPrice);

        // Check if item already in order
        const existingItemIndex = orderItems.findIndex(item => item.menu_item_id === menuItemId);
        
        if (existingItemIndex !== -1) {
            // Increase quantity if item exists
            orderItems[existingItemIndex].quantity++;
        } else {
            // Add new item
            orderItems.push({
                menu_item_id: menuItemId,
                name: menuItemName,
                price: menuItemPrice,
                quantity: 1
            });
        }

        updateOrderDisplay();

        // Add visual feedback
        const originalBg = this.style.backgroundImage;
        this.style.backgroundImage = 'linear-gradient(to right, #059669, #065f46)';
        setTimeout(() => {
            this.style.backgroundImage = originalBg;
        }, 300);
    });
});

// Clear order functionality
document.getElementById('clear-order').addEventListener('click', function() {
    if (confirm('Are you sure you want to clear the current order?')) {
        orderItems = [];
        updateOrderDisplay();
    }
});

// Form submission
document.getElementById('order-form').addEventListener('submit', function(e) {
    if (orderItems.length === 0) {
        e.preventDefault();
        alert('Please add items to the order before submitting.');
        return;
    }
    
    // Add loading state
    const submitButton = document.getElementById('submit-order');
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
    submitButton.disabled = true;
});

// Initialize
updateOrderDisplay();
</script>
@endpush