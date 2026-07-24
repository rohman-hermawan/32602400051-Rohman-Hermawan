<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Daftar Produk',
            'products' => $this->productModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create', ['title' => 'Tambah Produk Baru']);
    }

    // STORE: Simpan Data & File Gambar
    public function store()
    {
        // Aturan Validasi
        $rules = [
            'nama_produk' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Nama produk wajib diisi.',
                    'min_length' => 'Nama produk minimal 3 karakter.'
                ]
            ],
            'harga' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Harga wajib diisi.',
                    'numeric'  => 'Harga harus berupa angka.'
                ]
            ],
            'stok' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Stok wajib diisi.',
                    'numeric'  => 'Stok harus berupa angka.'
                ]
            ],
            'gambar' => [
                // permit_empty agar gambar tidak wajib diunggah
                'rules'  => 'permit_empty|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]|max_size[gambar,2048]',
                'errors' => [
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'mime_in'  => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
                    'max_size' => 'Ukuran gambar maksimal 2MB.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Mohon periksa inputan Anda! Pastikan format data sudah sesuai.');
        }

        // Proses Upload Gambar
        $fileGambar = $this->request->getFile('gambar');

        // Cek jika ada file yang diunggah dan valid
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/products', $namaGambar);
        } else {
            $namaGambar = 'default.jpg'; // Gambar default jika user tidak pilih file
        }

        $nama = $this->request->getPost('nama_produk');

        $this->productModel->save([
            'nama_produk' => $nama,
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'gambar'      => $namaGambar
        ]);

        return redirect()->to('/products')->with('success', 'Produk "' . esc($nama) . '" berhasil ditambahkan!');
    }

    public function edit($id = null)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/products')->with('error', 'Data produk tidak ditemukan!');
        }

        return view('products/edit', [
            'title'   => 'Edit Produk',
            'product' => $product
        ]);
    }

    // UPDATE: Perbarui Data & Gambar (opsional)
    public function update($id = null)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Data produk tidak ditemukan!');
        }

        $rules = [
            'nama_produk' => 'required|min_length[3]',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'gambar'      => 'permit_empty|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]|max_size[gambar,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Mohon periksa inputan Anda!');
        }

        $fileGambar = $this->request->getFile('gambar');

        // Cek apakah ada gambar baru yang diunggah
        if ($fileGambar->getError() == 4) {
            $namaGambar = $product['gambar']; // Pakai gambar lama
        } else {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/products', $namaGambar);

            // Hapus gambar lama jika ada dan bukan default.jpg
            if ($product['gambar'] && $product['gambar'] !== 'default.jpg' && file_exists('uploads/products/' . $product['gambar'])) {
                unlink('uploads/products/' . $product['gambar']);
            }
        }

        $nama = $this->request->getPost('nama_produk');

        $this->productModel->update($id, [
            'nama_produk' => $nama,
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'gambar'      => $namaGambar
        ]);

        return redirect()->to('/products')->with('success', 'Data produk "' . esc($nama) . '" berhasil diperbarui!');
    }

    // DELETE: Hapus Data & File Gambar Dari Server
    public function delete($id = null)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/products')->with('error', 'Data produk tidak ditemukan!');
        }

        // Hapus file gambar dari direktori jika bukan default.jpg
        if ($product['gambar'] && $product['gambar'] !== 'default.jpg' && file_exists('uploads/products/' . $product['gambar'])) {
            unlink('uploads/products/' . $product['gambar']);
        }

        $this->productModel->delete($id);

        return redirect()->to('/products')->with('success', 'Produk "' . esc($product['nama_produk']) . '" berhasil dihapus!');
    }
}