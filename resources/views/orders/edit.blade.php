<x-layouts::app :title="__('Edit Pesanan')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">
            Edit Status Pesanan
        </h1>
        <form action="{{ route('orders.update', $order) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label class="block mb-2">
                    Nama Customer
                </label>
                <input
                    type="text"
                    value="{{ $order->customer_name }}"
                    class="w-full border rounded p-2"
                    readonly>
            </div>
            <div class="mb-5">
                <label class="block mb-2">
                    Produk
                </label>
                <input
                    type="text"
                    value="{{ $order->product->name }}"
                    class="w-full border rounded p-2"
                    readonly>
            </div>
            <div class="mb-5">
                <label class="block mb-2">
                    Status Pesanan
                </label>
                <select
                    name="status"
                    class="w-full border rounded p-2">
                    <option value="pending"
                        {{ $order->status=='pending'?'selected':'' }}>
                        Pending
                    </option>
                    <option value="paid"
                        {{ $order->status=='paid'?'selected':'' }}>
                        Paid
                    </option>
                    <option value="shipped"
                        {{ $order->status=='shipped'?'selected':'' }}>
                        Shipped
                    </option>
                    <option value="done"
                        {{ $order->status=='done'?'selected':'' }}>
                        Done
                    </option>
                    <option value="cancelled"
                        {{ $order->status=='cancelled'?'selected':'' }}>
                        Cancelled
                    </option>
                </select>
            </div>
            <button
                class="bg-yellow-500 text-white px-5 py-2 rounded">
                Update Status
            </button>
        </form>
    </div>
</x-layouts::app>