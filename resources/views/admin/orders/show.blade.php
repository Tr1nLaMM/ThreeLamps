@extends('admin.app')

@section('content')
<div class="container">
    <h2>Chi tiết đơn hàng</h2>
    <div class="mb-3">
        <h4>ID Đơn hàng: {{ $order->id }}</h4>
        <p>Ngày giờ đặt hàng: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p>Tên khách hàng: {{ $order->user->name }}</p>
        <p>Email: {{ $order->user->email }}</p> <!-- Hiển thị email -->
        <p>Số điện thoại: {{ $order->user->phone }}</p> <!-- Hiển thị số điện thoại -->
        <p>Địa chỉ: {{ $order->user->address }}</p> <!-- Hiển thị địa chỉ -->
        <p>Trạng thái:
            <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p>Total Price: {{ number_format($order->gia, 2) }} VND</p>
    </div>

    <h4>Order Items</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1 @endphp
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{$count++}}</td>
                <td>{{ $item->post->tentruyen }}</td> <!-- Hiển thị tên sản phẩm -->
                <td>{{ $item->quantity }}</td> <!-- Số lượng -->
                <td>{{ number_format($item->gia, 2) }} VND</td> <!-- Giá mỗi sản phẩm -->
                <td>{{ number_format($item->quantity * $item->gia, 2) }} VND</td> <!-- Tổng tiền cho sản phẩm -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại trang đơn hàng</a>
</div>
@endsection