<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\book;
use App\Models\user;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Events\UserEmailEvent;

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
        UserEmailEvent::dispatch($borrow);
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

        $returndate = Carbon::now();
        $datedue = $borrow->due_date;
        if($returndate <= $datedue) {
                $status = "returned";
        }
        else{
                $status = "returned late";
        }
        // dd($status);
        $borrow->status = $status;
        $borrow->save();
        return redirect()->back();
}
}
