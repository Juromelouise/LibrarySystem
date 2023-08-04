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
            $PendingBooks = Borrow::with(['user','books'])->where('status','=',"pending")->get();
            // dd($PendingBooks);
            return View::make('admin.order_confirmation', compact('PendingBooks'));
    }
    public function confirm($id){
        $borrow = Borrow::find($id);
        $borrow->status = 'on borrow';
        $borrow->save();
        return redirect()->back();
}

public function cancel($id){
        $borrow = Borrow::find($id);
        $borrow->status = 'cancelled';
        $borrow->save();
        return redirect()->back();
}

public function returnbook($id){
        $borrow = Borrow::find($id);
        $borrow->status = 'returned';
        $borrow->save();
        return redirect()->back();
}
}
