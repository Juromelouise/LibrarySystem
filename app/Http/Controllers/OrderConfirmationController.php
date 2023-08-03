<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\book;
use App\Models\user;
use View;

class OrderConfirmationController extends Controller
{
    public function orderconfirmation(){
            $PendingBooks = Borrow::with(['user','books'])->get();
            dd($PendingBooks);
            return View::make('admin.order_confirmation', compact('PendingBooks'));
    }
}
