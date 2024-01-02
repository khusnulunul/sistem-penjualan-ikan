<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Pesanan;
use PDF;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function pesanlangsung(Request $request, $id){
        $data = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebihi stok
        if($request->jumlah_pesan > $data->stok)
        {
            return redirect()->route('belanja');
        }

        //cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //simpan ke database pesanan
        if(empty($cek_pesanan))
        {
            $pesanan = new Pesanan();
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }

        //simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('barang_id', $data->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new PesananDetail();
            $pesanan_detail->barang_id = $data->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = '1';
            $pesanan_detail->jumlah_harga = $data->harga*1;
            $pesanan_detail->save();
        } else{
            $pesanan_detail = PesananDetail::where('barang_id', $data->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah+1;

            //harga sekarang
            $harga_pesanan_detail_baru = $data->harga*1;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$data->harga*1;
        $pesanan->update();
        return redirect()->route('belanja');
    }

    public function pesan(Request $request, $id){
        $data = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebihi stok
        if($request->jumlah_pesan > $data->stok)
        {
            return redirect()->route('belanja');
        }

        //cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //simpan ke database pesanan
        if(empty($cek_pesanan))
        {
            $pesanan = new Pesanan();
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }

        //simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('produk_id', $data->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new PesananDetail();
            $pesanan_detail->barang_id = $data->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $data->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        } else{
            $pesanan_detail = PesananDetail::where('barang_id', $data->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $data->harga*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$data->harga*$request->jumlah_pesan;
        $pesanan->update();
        
        return redirect()->route('belanja');
    }

    public function checkout()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('pembeli.belanja.checkout', compact('pesanan', 'pesanan_details'));
        }

        if(empty($pesanan))
        {
            return view('pembeli.belanja.checkout');
        }
    }

    public function deleteco($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan_cek = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan_cek->jumlah_harga = $pesanan_cek->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan_cek->update();

        $pesanan_detail->delete();

        return redirect()->route('checkout');
    }

    public function transfer()
    {
        // $user = User::where('id', Auth::user()->id)->where('status', 0)->first();

        // if(!empty($user->alamat))
        // {
        //     Alert::error('Identitas Harap Dilengkapi', 'Error');
        //     return redirect('profile');
        // }

        // if(!empty($user->nohp))
        // {
        //     Alert::error('Identitas Harap Dilengkapi', 'Hapus');
        //     return redirect('profile');
        // }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->pembayaran = 0;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach($pesanan_details as $pesanan_detail) {
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok-$pesanan_detail->jumlah;
            $barang->update();
        }
        return redirect()->route('riwayatdetail', [$pesanan_id]);
    }

    public function langsung(){
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->pembayaran = 1;
        $pesanan->status = 2;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach($pesanan_details as $pesanan_detail) {
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok-$pesanan_detail->jumlah;
            $barang->update();
        }
        return redirect()->route('riwayat');
    }

    public function riwayat(){
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=',0)->get();
        return view('pembeli.belanja.riwayat', compact('pesanan'));
    }
    public function riwayatdetail($id){
        $pesanan = Pesanan::where('id' , $id)->first();
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
    return view('pembeli..transfer.riwayatdetail', compact('pesanan', 'pesanan_detail'));
    }

    public function buktitf(Request $request, $id){
        $data = Pesanan::where('id', $id)->first();
        $request->file('buktitf')->move('gambar/buktitf/', $request->file('buktitf')->getClientOriginalName());
        $data->buktitf = $request->file('buktitf')->getClientOriginalName();
        $data->save();
        return redirect()->route('riwayat');
    }

    //  admin
    public function transaksi(Request $request){
        $data = Pesanan::orderBy('id', 'ASC')->simplePaginate(5);
        return view('admin.transaksi.index', compact('data'));
    }


    public function exportpdf(){
        $data = Pesanan::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('admin.transaksi.exportpdf', ['data' => $data])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('transaksi.pdf');
    }

    public function cekbuktitf($id){
        $pesanan = Pesanan::where('id' , $id)->first();
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        return view('admin.transaksi.pesanan', compact('pesanan', 'pesanan_detail'));
    }

    public function downloadbuktitf($id){
        $data = Pesanan::find($id);
        $files = $data->buktitf;
        return response()->download(public_path('gambar/buktitf/'.$files));
    }

    public function konfirmasitf($id){
        $data = Pesanan::where('id', $id)->first();
        $data->status = 2;
        $data->update();
        return redirect()->route('transaksi');
    }

    public function selesai($id){
        $data = Pesanan::where('id', $id)->first();
        $data->status = 3;
        $data->update();
        return redirect()->route('transaksi');
    }

}
