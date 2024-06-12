<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('updated_at', 'desc')->get();
        return view('backend.v_produk.index', [
            'judul' => 'Data Produk',
            'index' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_produk.create', [
            'judul' => 'Tambah Produk',
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'detail' => 'required',
            'harga' => 'required',
            'foto' => 'required',
        ], $messages = [
            // 'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            // 'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);
        $validatedData['status'] = 0;
        // menggunkan ImageHelper
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $directory = 'storage/img-produk/'; // Atur direktori yang diinginkan
            $width = 400; // Atur lebar gambar
            $height = 400; // $height = null (jika tinggi otomatis)
            $fileName = ImageHelper::uploadAndResize($file, $directory, $width, $height); // Menggunakan ImageHelper untuk upload dan resize gambar
            $validatedData['foto'] = $fileName;
            }
            // dd($validatedData);
            Produk::create($validatedData, $messages);
            return redirect('/produk')->with('success', 'Data berhasil tersimpan');

        //password
        // $password = $request->input('password');
        // $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        // huruf kecil ([a-z]), huruf besar ([A-Z]), dan angka (\d) (?=.*[\W_]) simbol karakter (non-alphanumeric)
        // if (preg_match($pattern, $password)) {
            // $validatedData['password'] = Hash::make($validatedData['password']);
        //     Produk::create($validatedData, $messages);
        //     return redirect('/produk')->with('success', 'Data berhasil tersimpan');
        // } else {
        //     return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.']);
        // }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('backend.v_produk.edit', [
            'judul' => 'Ubah Produk',
            'edit' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //ddd($request);
        $produk = Produk::findOrFail($id);
        $rules = [
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'detail' => 'required',
            'harga' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];
        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];

        // if ($request->email != $produk->email) {
        //     $rules['email'] = 'required|max:255|unique:produk';
        // }

        $validatedData = $request->validate($rules, $messages);

        // menggunkan ImageHelper
        if ($request->file('foto')) {
            //hapus gambar lama
            if ($produk->foto) {
                $oldImagePath = public_path('storage/img-produk/') . $produk->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('foto');
            $directory = 'storage/img-produk/'; // Atur direktori yang diinginkan
            $width = 400; // Atur lebar gambar
            $height = null; // $height = null (jika tinggi otomatis)
            $fileName = ImageHelper::uploadAndResize($file, $directory, $width, $height); // Menggunakan ImageHelper untuk upload dan resize gambar
            $validatedData['foto'] = $fileName;
        }

        $produk->update($validatedData);
        return redirect('/produk')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->foto) {
            $oldImagePath = public_path('storage/img-produk/') . $produk->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $produk->delete();
        return redirect('/produk')->with('msgSuccess', 'Data berhasil dihapus');
    }
}
