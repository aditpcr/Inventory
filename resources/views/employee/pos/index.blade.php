@extends('layouts.app')

@section('title', 'Point of Sale')
@section('subtitle', 'Process customer orders efficiently')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <span class="text-secondary font-medium">Point of Sale</span>
</div>
@endsection

@section('content')
<div class="container">
    <div class="grid" style="grid-template-columns: 1fr; gap: var(--space-6);">
        <!-- Menu Items Section -->
        <div style="grid-column: 1 / -1;">
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center" style="gap: var(--space-3);">
                        <div style="width: 40px; height: 40px; background: #28a745; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                            <i class="fas fa-utensils" style="color: white; font-size: var(--text-lg);"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-primary">Menu Items</h2>
                            <p class="text-sm text-secondary">Select items to add to order</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: var(--space-4);">
                        @foreach($menuItems as $menuItem)
                        @php
                            $canBeMade = $menuItem->canBeMade();
                        @endphp
                        <div class="card" style="background: var(--background-light); border-color: var(--border-light); transition: all var(--transition-base);">
                            <div class="card-body">
                                <div class="flex items-start justify-between" style="margin-bottom: var(--space-3);">
                                    <h3 class="font-bold text-primary" style="font-size: var(--text-lg);">
                                        {{ $menuItem->name }}
                                    </h3>
                                    <span class="badge {{ $canBeMade ? 'badge-success' : 'badge-danger' }}">
                                        <i class="fas {{ $canBeMade ? 'fa-check-circle' : 'fa-times-circle' }}" style="margin-right: var(--space-1);"></i>
                                        {{ $canBeMade ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                </div>
                                
                                <p class="text-2xl font-bold text-accent" style="margin-bottom: var(--space-4);">
                                    Rp {{ number_format($menuItem->price, 0, ',', '.') }}
                                </p>
                                
                                <button class="btn btn-primary w-full add-to-order"
                                        data-menu-item-id="{{ $menuItem->id }}"
                                        data-menu-item-name="{{ $menuItem->name }}"
                                        data-menu-item-price="{{ $menuItem->price }}"
                                        {{ !$canBeMade ? 'disabled' : '' }}
                                        style="background: {{ $canBeMade ? '#28a745' : 'var(--background-light)' }}; color: {{ $canBeMade ? 'white' : 'var(--text-light)' }}; border: none; opacity: {{ $canBeMade ? '1' : '0.5' }}; cursor: {{ $canBeMade ? 'pointer' : 'not-allowed' }};">
                                    <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>
                                    Add to Order
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Order Section -->
        <div style="display: flex; flex-direction: column; gap: var(--space-6);">
            <!-- Order Summary -->
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center" style="gap: var(--space-3);">
                        <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                            <i class="fas fa-receipt" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-primary">Current Order</h2>
                            <p class="text-sm text-secondary">Order summary and total</p>
                        </div>
                    </div>
                </div>
                
                <form id="order-form" action="{{ route('employee.pos.store') }}" method="POST" class="card-body">
                    @csrf
                    
                    <!-- Order Items -->
                    <div id="order-items" style="max-height: 384px; overflow-y: auto; margin-bottom: var(--space-6); display: flex; flex-direction: column; gap: var(--space-3);">
                        <!-- Order items will be added here dynamically -->
                        <div id="empty-order" class="text-center" style="padding: var(--space-8);">
                            <div style="width: 64px; height: 64px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                                <i class="fas fa-shopping-cart" style="color: var(--text-light); font-size: var(--text-2xl);"></i>
                            </div>
                            <h4 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">No items added</h4>
                            <p class="text-secondary">Select items from the menu to start an order</p>
                        </div>
                    </div>

                    <!-- Order Total -->
                    <div style="border-top: 1px solid var(--border-light); padding-top: var(--space-4); margin-bottom: var(--space-6);">
                        <div class="flex justify-between items-center" style="margin-bottom: var(--space-2);">
                            <span class="text-lg font-medium text-secondary">Subtotal:</span>
                            <span class="text-lg font-bold text-primary" id="subtotal-amount">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center" style="margin-bottom: var(--space-2);">
                            <span class="text-lg font-medium text-secondary">Tax (10%):</span>
                            <span class="text-lg font-bold text-primary" id="tax-amount">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center" style="border-top: 1px solid var(--border-light); padding-top: var(--space-2);">
                            <span class="text-xl font-bold text-primary">Total:</span>
                            <span class="text-2xl font-bold text-accent" id="total-amount">Rp 0</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; flex-direction: column; gap: var(--space-3);">
                        <button type="submit" 
                                class="btn btn-primary w-full"
                                id="submit-order"
                                disabled
                                style="background: #28a745; color: white; border: none;">
                            <i class="fas fa-check-circle" style="margin-right: var(--space-2);"></i>
                            Place Order
                            <i class="fas fa-arrow-right" style="margin-left: var(--space-2);"></i>
                        </button>
                        
                        <button type="button" 
                                id="clear-order"
                                class="btn btn-outline w-full"
                                disabled>
                            <i class="fas fa-trash" style="margin-right: var(--space-2);"></i>
                            Clear Order
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Stats -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-bold text-primary">Quick Stats</h3>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-4);">
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
                        <span class="text-secondary">Available Items:</span>
                        <span class="font-bold" style="color: #28a745;">{{ $availableItems }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary">Out of Stock:</span>
                        <span class="font-bold" style="color: #dc3545;">{{ $outOfStockItems }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary">Total Items:</span>
                        <span class="font-bold text-primary">{{ $menuItems->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 1024px) {
        .container > .grid {
            grid-template-columns: 2fr 1fr;
        }
    }
</style>

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
            <div id="empty-order" class="text-center" style="padding: var(--space-8);">
                <div style="width: 64px; height: 64px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                    <i class="fas fa-shopping-cart" style="color: var(--text-light); font-size: var(--text-2xl);"></i>
                </div>
                <h4 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">No items added</h4>
                <p class="text-secondary">Select items from the menu to start an order</p>
            </div>
        `;
        submitButton.disabled = true;
        clearButton.disabled = true;
    } else {
        orderItemsContainer.innerHTML = orderItems.map((item, index) => `
            <div class="card" style="background: var(--background-light); border-color: var(--border-light);">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div style="flex: 1;">
                            <h4 class="font-bold text-primary">${item.name}</h4>
                            <p class="text-sm text-secondary">Rp ${item.price.toLocaleString('id-ID')} × ${item.quantity}</p>
                        </div>
                        <div class="flex items-center" style="gap: var(--space-3);">
                            <span class="font-bold text-accent">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                            <div class="flex items-center" style="gap: var(--space-2);">
                                <button type="button" class="quantity-btn decrease-quantity btn" style="width: 32px; height: 32px; padding: 0; background: #dc3545; color: white; border: none;" data-index="${index}">
                                    <i class="fas fa-minus" style="font-size: var(--text-xs);"></i>
                                </button>
                                <span class="quantity-display" style="width: 32px; text-align: center; font-weight: var(--font-weight-bold);">${item.quantity}</span>
                                <button type="button" class="quantity-btn increase-quantity btn" style="width: 32px; height: 32px; padding: 0; background: #28a745; color: white; border: none;" data-index="${index}">
                                    <i class="fas fa-plus" style="font-size: var(--text-xs);"></i>
                                </button>
                                <button type="button" class="remove-item btn" style="width: 32px; height: 32px; padding: 0; background: #dc3545; color: white; border: none;" data-index="${index}">
                                    <i class="fas fa-trash" style="font-size: var(--text-xs);"></i>
                                </button>
                            </div>
                        </div>
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
        const originalBg = this.style.background;
        this.style.background = '#059669';
        setTimeout(() => {
            this.style.background = originalBg;
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
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: var(--space-2);"></i>Processing...';
    submitButton.disabled = true;
});

// Initialize
updateOrderDisplay();
</script>
@endpush
@endsection
