<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk Toko</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .navbar {
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .container {
            padding: 20px;
            margin-top: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px 5px;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .edit-form, .add-form {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h2>Pemesanan Produk Toko</h2>
    <a href="#">Dashboard</a>
    <a href="#">Data Produk</a>
</div>

<div class="container">
    <h1>Data Produk</h1>
    <button class="btn" onclick="showAddForm()">Tambah Pesanan</button>
    <button class="btn" onclick="exportPDF()">Export PDF</button>
    
    <table>
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="product-table">
            <tr>
                <td>1</td>
                <td>Tepung Serbaguna</td>
                <td>Tepung</td>
                <td>3500</td>
                <td>12 pcs</td>
                <td>
                    <button class="btn" onclick="editProduct(this)">Edit</button>
                    <button class="btn btn-danger" onclick="deleteProduct(this)">Hapus</button>
                </td>
            </tr>
            <!-- Tambahkan baris lain sesuai kebutuhan -->
        </tbody>
    </table>

    <div class="edit-form">
        <h2>Edit Produk</h2>
        <label for="edit-id">ID Produk</label>
        <input type="text" id="edit-id" disabled>
        
        <label for="edit-name">Nama Produk</label>
        <input type="text" id="edit-name">
        
        <label for="edit-category">Kategori</label>
        <input type="text" id="edit-category">
        
        <label for="edit-price">Harga</label>
        <input type="number" id="edit-price">
        
        <label for="edit-stock">Stok</label>
        <input type="text" id="edit-stock">
        
        <button class="btn" onclick="saveProduct()">Simpan</button>
        <button class="btn" onclick="cancelEdit()">Batal</button>
    </div>

    <div class="add-form">
        <h2>Tambah Produk</h2>
        <label for="add-id">ID Produk</label>
        <input type="text" id="add-id" disabled>
        
        <label for="add-name">Nama Produk</label>
        <input type="text" id="add-name">
        
        <label for="add-category">Kategori</label>
        <input type="text" id="add-category">
        
        <label for="add-price">Harga</label>
        <input type="number" id="add-price">
        
        <label for="add-stock">Stok</label>
        <input type="text" id="add-stock">
        
        <button class="btn" onclick="addProduct()">Simpan Produk</button>
        <button class="btn" onclick="cancelAdd()">Batal</button>
    </div>
</div>

<script>
    let currentRow;
    let productIdCounter = 2; // Mulai dari 2 karena 1 sudah digunakan

    function editProduct(button) {
        currentRow = button.closest('tr');
        
        // Ambil data dari baris dan masukkan ke dalam form
        document.getElementById('edit-id').value = currentRow.cells[0].innerText;
        document.getElementById('edit-name').value = currentRow.cells[1].innerText;
        document.getElementById('edit-category').value = currentRow.cells[2].innerText;
        document.getElementById('edit-price').value = currentRow.cells[3].innerText;
        document.getElementById('edit-stock').value = currentRow.cells[4].innerText;

        // Tampilkan form edit
        document.querySelector('.edit-form').style.display = 'block';
    }

    function saveProduct() {
        // Simpan data dari form kembali ke baris
        currentRow.cells[0].innerText = document.getElementById('edit-id').value;
        currentRow.cells[1].innerText = document.getElementById('edit-name').value;
        currentRow.cells[2].innerText = document.getElementById('edit-category').value;
        currentRow.cells[3].innerText = document.getElementById('edit-price').value;
        currentRow.cells[4].innerText = document.getElementById('edit-stock').value;

        // Sembunyikan form edit
        document.querySelector('.edit-form').style.display = 'none';
    }

    function cancelEdit() {
        // Sembunyikan form edit tanpa menyimpan
        document.querySelector('.edit-form').style.display = 'none';
    }

    function deleteProduct(button) {
        const row = button.closest('tr');
        row.remove(); // Hapus baris dari tabel
    }

    function showAddForm() {
        document.querySelector('.add-form').style.display = 'block';
    }

    function addProduct() {
        const name = document.getElementById('add-name').value;
        const category = document.getElementById('add-category').value;
        const price = document.getElementById('add-price').value;
        const stock = document.getElementById('add-stock').value;

        const table = document.getElementById('product-table');
        const newRow = table.insertRow();

        newRow.insertCell(0).innerText = productIdCounter++; // Increment ID produk
        newRow.insertCell(1).innerText = name;
        newRow.insertCell(2).innerText = category;
        newRow.insertCell(3).innerText = price;
        newRow.insertCell(4).innerText = stock;

        const actionsCell = newRow.insertCell(5);
        actionsCell.innerHTML = `
            <button class="btn" onclick="editProduct(this)">Edit</button>
            <button class="btn btn-danger" onclick="deleteProduct(this)">Hapus</button>
        `;

        // Reset form dan sembunyikan
        document.getElementById('add-name').value = '';
        document.getElementById('add-category').value = '';
        document.getElementById('add-price').value = '';
        document.getElementById('add-stock').value = '';
        document.querySelector('.add-form').style.display = 'none';
    }

    function cancelAdd() {
        // Sembunyikan form tambah tanpa menyimpan
        document.querySelector('.add-form').style.display = 'none';
    }

    function exportPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        doc.text("Data Produk Toko", 14, 10);
        
        const table = document.getElementById('product-table');
        const rows = table.getElementsByTagName('tr');
        const colNames = ["ID Produk", "Nama Produk", "Kategori", "Harga", "Stok"];
        
        let pdfRows = [];
        
        // Tambahkan nama kolom
        pdfRows.push(colNames);
        
        // Tambahkan data baris
        for (let i = 0; i < rows.length; i++) {
            const cols = rows[i].getElementsByTagName('td');
            const rowData = [];
            for (let j = 0; j < cols.length; j++) {
                rowData.push(cols[j].innerText);
            }
            pdfRows.push(rowData);
        }
        
        // Buat tabel dalam PDF
        doc.autoTable({
            head: pdfRows.slice(0, 1),
            body: pdfRows.slice(1),
        });
        
        doc.save('data_produk.pdf');
    }
</script>

</body>
</html>
