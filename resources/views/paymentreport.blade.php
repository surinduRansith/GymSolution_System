@php
    use Illuminate\Support\Carbon;

$startDate = Carbon::now()->startOfMonth()->format('Y-m-d'); // First day of the month
$endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
@endphp

@extends('Layouts.app')
@section('content')
    
<div class="text-center pt-2">
    <h1>Payment Report</h1>
</div>
<br>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Payment Report</li>
  </ol>
  </nav>
  <!-- /Breadcrumb -->

<div class="row ">
    <form action="{{route('userpaymentreport.show')}}" method="POST">
        @csrf
    <div class="row">
        <div class="col-2">
            
                <select class="form-select select2  " aria-label="Default" name="memberid" >
                    <option selected>Search Member</option>
                    @foreach ($members as $member )
                    <option value="{{$member->id}}" {{old('memberid')==$member->id?'selected':''}}>{{$member->name}}</option>
               
    @endforeach 
                  </select>  
                  @error('memberid')
                  <p style="color: red">{{ $message }}</p>
              @enderror
        </div>
       
    <input name="testvalue" type="number" value="0" hidden>

    <div class="col-1">

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="allusers" id="allusers1" value="1">
            <label class="form-check-label" for="allusers1">
              All Users
            </label>

            @error('allusers')
            <p style="color: red">{{ $message }}</p>
        @enderror
          </div>
    </div>

    <div class="col-3">
        <div class="input-group mb-3 " >
         <span class="input-group-text" id="basic-addon1">Start Date</span>
         <input type="date" class="form-control" id="startdate" name="startdate" value="{{$startDate}}">
       </div>
       @error('startdate')
       <p style="color: red">{{ $message }}</p>
   @enderror
     </div>
     <div class="col-3">
       <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">End Date</span>
        <input type="date" class="form-control" id="enddate" name="enddate" value="{{$endDate}}">
       </div>
       @error('enddate')
       <p style="color: red">{{ $message }}</p>
   @enderror
   </div> 
      <div class="col-1">
        <button type="submit" class="btn btn-primary">Search</button>
    </div> 
      </div>
    
    </form>
    </div>
<br>



@if ($testvalue==0)
    

    @if(count($payments) >0)

    @if ($allusers==1)
    <div class="row">
        <div class="col-10">
            
        </div>
        <div class="col-2">
      
       
            <a href="{{route('alluserpaymentreportpdf.show',['startdate'=>$startDate1,'enddate'=>$endDate1])}}" class="btn btn-sm btn-danger"  title="Download PDF">
               <i class="fa-solid fa-file-pdf"></i>
            </a>
    </div>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table " id="myTable" >
            <thead class="table-secondary">
                <td>Member ID</td>
                <td>Member Name</td>
                <td>Membership Type</td>
                <td>Year</td>
                <td>Month</td>
                
                
                  
                  <td>Amount </td>
                </thead>
                <tbody>
                    @foreach ($payments as $payment )
                    
                    @php
                $date = $payment->created_at;
                $dateTime = new DateTime($date);
                $YearName = $dateTime->format('Y'); // Full month name (e.g., August)
                @endphp
            
            <tr >
                <td>{{$payment->member_id}}</td>
                <td> {{$payment->name}}</td>
                <td>{{$payment->membership_type}}</td>
                <td>{{$YearName}}</td>
                <td>{{$payment->month}}</td>
                <td>{{$payment->amount}}</td>
            </tr>
            
            
            @endforeach
            
        </tbody>
    </table>
</div>

</div>

@else


<div class="row">
    <div class="col-10">
        
    </div>
    <div class="col-2">
        
        @foreach ($payments as $payment )
        @endforeach
        
        <a href="{{route('userpaymentreportpdf.show',
        ['id'=>$payment->member_id])}}" class="btn btn-sm btn-danger"  title="Download PDF">
           <i class="fa-solid fa-file-pdf"></i>
        </a>
        
        @if($payment->membership_type=='Monthly')
       
        @else

 @endif
 
</div>
</div>
<br>
<div class="row">
<div class="table-responsive">
    <table class="table " id="myTable" >
        <thead class="table-secondary">
            <td>Member ID</td>
            <td>Member Name</td>
            <td>Membership Type</td>
            @foreach ($payments as $payment )
            @endforeach
            
            @if ($payment->membership_type=='Monthly')
            <td>Year</td>
            <td>Month</td>
            
            @else
            <td>Year</td>
              @endif
              
              <td>Amount </td>
            </thead>
            <tbody>
                @foreach ($payments as $payment )
                
                @php
            $date = $payment->created_at;
            $dateTime = new DateTime($date);
            $YearName = $dateTime->format('Y'); // Full month name (e.g., August)
            @endphp
        
        <tr >
            <td>{{$payment->member_id}}</td>
            <td> {{$payment->name}}</td>
            <td>{{$payment->membership_type}}</td>
            @if ($payment->membership_type=='Monthly')
            <td>{{$YearName}}</td>
            <td>{{$payment->month}}</td>

            @else
            <td>{{$YearName}}</td>
            @endif
            <td>{{$payment->amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

</div>

@endif

@else
<div class="row">
    
    <div class="alert alert-danger text-center" role="alert">
        Data Not Available
    </div>
    
</div>
@endif



    @else
    <div class="row">
    
        <div class="alert alert-warning text-center" role="alert">
            Please Generate Payment Report
          </div>
    
    </div>

    @endif





















    <script>

        var select_box_element = document.querySelector('#memberid');
    
        dselect(select_box_element, {
            search: true
        });
    
    </script>
    <script>
    $('.select2').select2();
    </script>
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
    
            "lengthMenu": [10, 100, 200],
            
    
        });
    });
    </script>
@endsection