<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Preview Peminjaman</title>
    <style>
        body { font-family: sans-serif; }
        h2 { margin-bottom: 20px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h2>Preview Peminjaman</h2>
    <p><strong>Nama Peminjam:</strong> {{ $data['borrower_name'] }}</p>
    <p><strong>Judul Buku:</strong> {{ $book->title }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $data['borrowed_at'] }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $data['due_date'] }}</p>
</body>
</html>
