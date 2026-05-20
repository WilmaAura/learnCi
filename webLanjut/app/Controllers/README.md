# Fungsi Class Model

## Digunakan pada controller

Fungsinya adalah untuk mengelola data milik table

```bash
find() //Mengambil satu data tertentu berdasarkan primary key
findAll() //Mengambil semua data
first() //Mengambil data pertama dari hasil
where() //Memberi kondisi pecarian data

insert() //menambah data baru
update()
delete()
save() //Melakukan insert data baru dan update data lama sekaligus

paginate() //Membagi data menjadi beberapa bagian halaman
```

Contoh Penggunaan di controller

```bash
$products = $this->productModel->findaAll();
$product = $this->productModel->find(1);
```
