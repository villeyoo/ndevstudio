<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('beliRobux', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'username' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:50',
            'payment_method' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        $order = Order::create([
            'product_id' => $request->product_id,
            'username' => $request->username,
            'whatsapp' => $request->whatsapp,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // === Tanggal & waktu lokal (WIB) ===
        $tanggal = Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y H:i');
        // Contoh output: Kamis, 06 November 2025 19:45

        // === Token & Nomor Admin (langsung diisi manual) ===
        $token = 'MibMSxXur9T2yJmhg5FB'; // 🔒 ambil dari dashboard Fonnte
        $adminNumber = '6285117562717';   // nomor admin tanpa tanda +

        // === Format pesan WhatsApp ===
        $message = "*Pesanan Baru Masuk!*\n\n"
            . "🕓 *Waktu:* {$tanggal} WIB\n"
            . "🧍 *Username:* {$request->username}\n"
            . "📱 *No. WhatsApp:* {$request->whatsapp}\n"
            . "🎮 *Produk:* {$product->title}\n"
            . "💰 *Harga:* {$product->price}\n"
            . "💳 *Metode Pembayaran:* {$request->payment_method}\n"
            . "📦 *Status:* Pending\n\n"
            . "Segera proses pesanan ini di sistem ✅";

        // === Kirim ke WhatsApp Admin via Fonnte ===
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $adminNumber,
                'message' => $message,
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token",
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

       

        return redirect()->route('success')->with('success', 'Pesanan kamu berhasil dibuat! Admin akan segera menghubungi kamu lewat WhatsApp.');
    }

    // === Kirim pesan ke pembeli ===

    public function index()
    {
        $orders = Order::with('product')->orderBy('created_at', 'desc')->get();
        return view('orderList', compact('orders'));
    }

    public function destroy($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Pesanan telah diselesaikan dan dihapus dari daftar!');
    }
}
