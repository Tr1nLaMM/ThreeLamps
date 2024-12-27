<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Middleware kiểm tra quyền admin
    }

    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        // Lấy đơn hàng cùng với các order_items
        $order = Order::with('orderItems.post')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Kiểm tra nếu trạng thái hiện tại là 'thất bại'
        if ($order->status === 'thất bại') {
            return redirect()->route('admin.orders.index')->withErrors('Không thể thay đổi trạng thái của đơn hàng đã thất bại.');
        }

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'status' => 'required|string|in:đang xử lý,xử lý,chờ giao,đang giao,đã đến,hoàn thành,thất bại',
        ]);

        // Cập nhật trạng thái từ request
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
    public function placeOrder(Request $request)
    {
        // Validate thông tin người dùng
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Lấy thông tin giỏ hàng
        $cartItems = CartItem::where('user_id', auth()->id())->with('post')->get();

        // Kiểm tra nếu giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Lấy thông tin người dùng (phone, address từ bảng users)
        $user = auth()->user();

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => auth()->id(),
            'gia' => $cartItems->sum(function ($item) {
                return $item->quantity * $item->post->gia;
            }),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $user->phone,  // Lấy số điện thoại từ bảng users
            'address' => $user->address,  // Lấy địa chỉ từ bảng users
        ]);

        // Thêm các sản phẩm vào đơn hàng
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'post_id' => $item->post_id,
                'quantity' => $item->quantity,
                'gia' => $item->post->gia,
            ]);
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đã đặt hàng
        CartItem::where('user_id', auth()->id())->delete();

        // Chuyển hướng đến trang thanh toán thành công
        return redirect()->route('admin.orders.success')->with('success', 'Đặt hàng thành công!');
    }
    public function success()
    {
        return view('order.success');
    }
}
