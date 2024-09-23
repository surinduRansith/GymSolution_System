<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function ShowPaymentPage($id){

        $members = Members::all()->where('id',$id);


        $paymentsDetails = Payments::all()->where('member_id',$id);


        

 return view('paymentadd', compact('members','paymentsDetails'));

    }


    public function addPayment(Request $request, $id){

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        if($request->membershiptype=='Monthly'){

            $validated=$request->validate([
                "paymentmonth"=> [
                    'required',
                    'string',
                    Rule::in($months)
                ],
                "payment"=>'required',
                "membershiptype"=>'required'
                
            ]);

            Payments::create([

                'member_id'=>$id,
                'membership_type'=>$validated['membershiptype'],
                'month'=> $validated['paymentmonth'],
                'amount'=>$validated['payment']
        
               ]
               );

        }elseif($request->membershiptype=='Annual'){

            $validated=$request->validate([
                "payment"=>'required',
                "membershiptype"=>'required'
                
            ]);

            Payments::create([

                'member_id'=>$id,
                'membership_type'=>$request->membershiptype,
                'month'=>"",
                'amount'=>$request->payment
        
               ]
               );

        }

       

       

   



        return redirect()->route('paymentpage.insert',$id)->with('success', 'User Payment Update Success');
    }

    public function deletePaymentPage(Request $request,$id,$month){

        DB::table('payments')
        ->where('member_id', $id)
        ->where('month',$month)
        ->delete();
    

    return redirect()->route('paymentpage.data', ['id' => $id])->with('success', 'User Schedule Delete Success');
    }

    public function deletePaymentPageAnnual(Request $request,$id,$payment){

    
// dd($id,$paymentid);
        DB::table('payments')
        ->where('member_id', $id)
        ->where('id',$payment)
       
        ->delete();

  return redirect()->route('paymentpage.data', ['id' => $id])->with('success', 'User Schedule Delete Success');
    }

    
}
