@php
    $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
@endphp


@extends('Layouts.app')
@section('content')



   <!-- Breadcrumb -->
   <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('members.data')}}">Member List</a></li>
    @foreach ($members as $member )
    <li class="breadcrumb-item"><a href="{{route('members.profile',$member->id)}}">Member Profile</a></li>
    @endforeach
    <li class="breadcrumb-item active" aria-current="page">Payment</li>
  </ol>
</nav>
<!-- /Breadcrumb -->

<div class="container text-center">
    <div class="row justify-content-start">
    <div class="col-6">
        @foreach ($members as $member )

        <form action="{{route('paymentpage.insert',$member->id)}}" method="POST">
        @csrf
        
        @if ($member->membershiptype=='Monthly')
        
        <div class="card " style="width: 18rem;">
            <img src="{{asset('images/monthly.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
        
                
              <h5 class="card-title">{{$member->membershiptype}}</h5>
                <input type="text" hidden value="{{$member->membershiptype}}" name="membershiptype">
              <select class="form-select" aria-label="Default select example" name="paymentmonth">
        
                <option selected>Open this select menu</option>
                @foreach ($months as $month )
            
            
                    <option value="{{$month}}">{{$month}}</option>
                    
                    
                    @endforeach
                </select>
                @error('paymentmonth')
                <p style="color: red">{{ $message }}</p>
            @enderror
                <br>
                <input type="number" class="form-control" name="payment"  placeholder="Please Enter Amount">
                @error('payment')
                <p style="color: red">{{ $message }}</p>
            @enderror
           <br>
                <button type="submit" class="btn btn-warning">add</button>

            </div>
          </div>
        @elseif ($member->membershiptype=='Annual')
        
        <div class="card" style="width: 18rem;">
            <img src="{{asset('images/paymentannual.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
        
                
              <h5 class="card-title">{{$member->membershiptype}}</h5>
              <input type="text" hidden value="{{$member->membershiptype}}" name="membershiptype">
              <br>
              <input type="number" class="form-control" name="payment" placeholder="Please Enter Amount">
              @error('payment')
                <p style="color: red">{{ $message }}</p>
            @enderror
           <br>
              <button type="submit" class="btn btn-warning">add</button> 
             
            </div>
          </div>
        @endif
        
        
        </form>
        
        
        @endforeach
    </div>

    <div class="col-6">
      @if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>

@endif
      @php
      $membership_type = '';
      @endphp
        @foreach ($paymentsDetails as $paymentsDetail )

        @if ($paymentsDetail->membership_type=='Monthly')

        @php
            $membership_type = 'Monthly';
        @endphp
            @else
            @php
            $membership_type = 'Annual';
        @endphp
        @endif

        @endforeach

        @if ($membership_type=='Monthly')
            
        
        <table class="table  table-striped table-responsive-sm   " id="myTable">
            <thead>
                <th></th>
              <th>Month</th>
              <th>Amount(RS.)</th>
              <th>Payment Date</th>
              <th></th>
            </thead>
            <tbody>
        @php
            $count = 0
        @endphp
     @foreach ($paymentsDetails as $paymentsDetail )

         <tr>
            <td>
                @php
                    $count++
                @endphp
                {{$count}}
            </td>
            <td>{{$paymentsDetail->month}}</td>
            <td>{{$paymentsDetail->amount}}</td>
            <td>{{$paymentsDetail->updated_at}}</td>
            <form action="{{route('paymentpage.delete',['id'=> $paymentsDetail->member_id,'month'=>$paymentsDetail->month])}}" >
                @csrf
                @method('DELETE')
            <td><button type="submit" class="btn btn-danger"><i class="lni lni-trash-can"></i> </button> </td>
        </form>
          </tr>   
            @endforeach
          </tbody>
          </table>

          @elseif($membership_type=='Annual')

          <table class="table  table-striped table-responsive-sm   " id="myTable">
            <thead>
              <th></th>
              <th>Amount(RS.)</th>
              <th>Payment Date</th>
              <th></th>
            </thead>
            <tbody>
        @php
            $count = 0
        @endphp

        
     @foreach ($paymentsDetails as $paymentsDetail )

         <tr>
            <td>
                @php
                    $count++
                @endphp
                {{$count}}
            </td>
            <td>{{$paymentsDetail->amount}}</td>
            <td>{{$paymentsDetail->updated_at}}</td>
            <form action="{{route('paymentpageAnnual.delete',['id'=>$paymentsDetail->member_id ,'payment'=>$paymentsDetail->id])}}" method="POST" >
                @csrf
                @method('DELETE')
            <td><button type="submit" class="btn btn-danger"><i class="lni lni-trash-can"></i> </button> </td>
        </form>
          </tr>   
            @endforeach
          </tbody>
          </table>

          @endif
    </div>
</div>
 






@endsection