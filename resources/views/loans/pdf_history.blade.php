<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Riwayat Peminjaman</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Riwayat Peminjaman Buku</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->borrower_name }}</td>
                    <td>{{ $loan->book->title ?? '-' }}</td>
                    <td>{{ $loan->borrowed_at }}</td>
                    <td>{{ $loan->due_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
