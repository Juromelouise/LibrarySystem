<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use PDF;

class DashboardController extends Controller
{
    public function index()
    {
        $mostBorrowed = Book::select('title', DB::raw('SUM(nums) as total_borrow'))
                        ->groupBy('title')
                        ->orderByDesc('total_borrow')
                        ->limit(10)
                        ->get();
        
        return view('dashboard.report', ['mostBorrowed' => $mostBorrowed]);
    }

    public function history()
    {
        if(Auth::check() && Auth::user()->role === '1'){
            $transactions = Borrow::with(['user','books'])->get();
        }
        else{
        $user = Auth::user();
        $transactions = Borrow::with(['user','books'])->where('user_id',$user->id)->get();
        }
        return view::make('history.studenthistory', compact('transactions'));
    }

    public function download()
    {
        $user = Auth::user();
        $transactions = Borrow::where('user_id', $user->id)->get();
    
        $pdf = PDF::loadView('history.studenthistory', ['transactions' => $transactions]);
    
        return $pdf->download('transaction_history.pdf');
    }
    

}
