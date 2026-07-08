<x-layouts::app :title="__('Data Pesanan')">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Data Pesanan
            </h1>
        </div>
        @if(session('success'))
        <div class="mb-4 rounded bg-green-100 p-3 text-green-700">
            {{ session('success') }}
        </div>
        @endif
        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Produk</th>
                        <th class="border p-2">Customer</th>
                        <th class="border p-2">Qty</th>
                        <th class="border p-2">Total</th>
                        <th class="border p-2">Pembayaran</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="border p-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border p-2">
                            {{ $order->product->name }}
                        </td>
                        <td class="border p-2">
                            {{ $order->customer_name }}
                        </td>
                        <td class="border p-2 text-center">
                            {{ $order->quantity }}
                        </td>
                        <td class="border p-2">
                            Rp {{ number_format($order->total_price,0,',','.') }}
                        </td>
                        <td class="border p-2">
                            {{ $order->payment_method }}
                        </td>
                        <td class="border p-2">
                            @switch($order->status)
                            @case('pending')
                            <span class="text-yellow-500 font-semibold">Pending</span>
                            @break
                            @case('paid')
                            <span class="text-blue-500 font-semibold">Paid</span>
                            @break
                            @case('shipped')
                            <span class="text-purple-500 font-semibold">Shipped</span>
                            @break
                            @case('done')
                            <span class="text-green-500 font-semibold">Done</span>
                            @break
                            @case('cancelled')
                            <span class="text-red-500 font-semibold">Cancelled</span>
                            @break
                            @endswitch
                        </td>
                        <td class="border p-2">
                            {{ date('d-m-Y', strtotime($order->order_date)) }}
                        </td>
                        <td class="border p-2">
                            <a
                                href="{{ route('orders.edit',$order) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center p-5">
                            Belum ada pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts::app>