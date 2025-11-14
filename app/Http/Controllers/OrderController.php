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
        // pastikan product ada
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi dasar
        $rules = [
            'username' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:50',
            'payment_method' => 'required|string',
        ];

        // Kalau produk bertipe "pending", maka gamepass_id wajib
        // (sesuaikan nilai 'pending' dengan nilai di DB jika berbeda kapitalisasi)
        if (isset($product->type) && strtolower($product->type) === 'pending') {
            $rules['gamepass_id'] = 'required|string|max:50';
        } else {
            // jika tidak wajib, terima nullable
            $rules['gamepass_id'] = 'nullable|string|max:50';
        }

        $validated = $request->validate($rules);

        // Optional sanitize gamepass_id: ambil hanya digit jika ingin
        $gamepassId = isset($validated['gamepass_id']) ? trim($validated['gamepass_id']) : null;
        // jika kamu ingin menyimpan hanya angka: uncomment baris berikut
        // $gamepassId = $gamepassId ? preg_replace('/\D/', '', $gamepassId) : null;

        $order = Order::create([
            'product_id' => $request->product_id,
            'username' => $validated['username'],
            'whatsapp' => $validated['whatsapp'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'gamepass_id' => $gamepassId,
        ]);

        // === Tanggal & waktu lokal (WIB) ===
        $tanggal = Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y H:i');

        // === Token & Nomor Admin (langsung diisi manual) ===
        $token = 'MibMSxXur9T2yJmhg5FB'; // 🔒 ambil dari dashboard Fonnte
        $adminNumber = '6285117562717';   // nomor admin tanpa tanda +

        // === Format pesan WhatsApp ===
        $message = "*Pesanan Baru Masuk!*\n\n"
            . "🕓 *Waktu:* {$tanggal} WIB\n"
            . "🧍 *Username:* {$order->username}\n"
            . "📱 *No. WhatsApp:* {$order->whatsapp}\n"
            . "🎮 *Produk:* {$product->title}\n"
            . "💰 *Harga:* {$product->price}\n"
            . "💳 *Metode Pembayaran:* {$order->payment_method}\n"
            . "📦 *Status:* {$order->status}\n";

        // Sertakan gamepass ID di pesan bila ada
        if ($order->gamepass_id) {
            $message .= "🔢 *Gamepass ID:* {$order->gamepass_id}\n";
        }

        $message .= "\nSegera proses pesanan ini di sistem ✅";

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

    public function complete($id)
    {
        // Ambil order (sesuaikan model jika perlu)
        $order = Order::findOrFail($id);

        // Set status jadi 'success' (tampilan Blade akan menampilkan "Selesai")
        $order->status = 'success';
        $order->save();

        // Opsional: kirim notifikasi WA ke pembeli atau catat log — bisa ditambahkan nanti.

        return redirect()->route('order.index')->with('success', 'Pesanan berhasil ditandai: Selesai.');
    }
}
