<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Peminjaman</title>
    <style>
        * {
            font-family: sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .card {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            border: 1px solid #999;
            padding: 10px 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 6px;
        }

        .info {
            font-size: 12px;
            line-height: 1.4;
        }

        .info span {
            font-weight: bold;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 10px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">📚 Struk Peminjaman Buku</div>
        <div class="info">
            <p><span>Nama:</span> {{ $loan->borrower_name }}</p>
            <p><span>Buku:</span> {{ $loan->book->title }}</p>
            <p><span>Pinjam:</span> {{ \Carbon\Carbon::parse($loan->borrowed_at)->format('d M Y') }}</p>
            <p><span>Kembali:</span> {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</p>
        </div>
        <div class="footer">
            Harap jaga buku dengan baik. Terima kasih. 🙏
        </div>
    </div>
</body>
</html>
