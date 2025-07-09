<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Book;



class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = \App\Models\Loan::with('book')->latest()->get();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all();
        return view('loans.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'borrower_name' => 'required|string',
        'book_id' => 'required|exists:books,id',
        'borrowed_at' => 'required|date',
        'due_date' => 'required|date|after:borrowed_at',

    ]);

        Loan::create($request->only([
            'borrower_name',
            'book_id',
            'borrowed_at',
            'due_date'
        ]));

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }


    public function print()
    {
    $loans = Loan::with('book')->get(); // atau bisa filter tertentu
    $pdf = Pdf::loadView('loans.pdf_history', compact('loans'));

    return $pdf->download('riwayat_peminjam.pdf');
    }

    public function preview(Request $request)
    {
    $validated = $request->validate([
        'borrower_name' => 'required|string|max:255',
        'book_id' => 'required|exists:books,id',
        'borrowed_at' => 'required|date',
        'due_date' => 'required|date|after_or_equal:borrowed_at',
    ]);

    $book = Book::find($validated['book_id']);

    return view('loans.preview', [
        'data' => $validated,
        'book' => $book
    ]);
    }

    public function printPreview(Request $request)
    {
    $data = $request->only(['borrower_name', 'book_id', 'borrowed_at', 'due_date']);
    $book = Book::findOrFail($data['book_id']);

    $pdf = Pdf::loadView('loans.pdf_preview', [
        'data' => $data,
        'book' => $book
    ]);

    return $pdf->download('preview-peminjaman.pdf');
    }

    public function printReceipt($id)
    {
    $loan = Loan::with('book')->findOrFail($id);

    $customPaper = array(0, 0, 320, 200); // dalam points

     $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('loans.receipt', compact('loan'))
        ->setPaper($customPaper, 'landscape');

    return $pdf->stream('struk-peminjaman-' . $loan->id . '.pdf'); // buka di tab
    }

}