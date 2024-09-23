<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>


    

    <div class="row">

        <div class="table-responsive">
            <table  border="1" >
                <thead>
                  <td>Member ID</td>
                  <td>Member Name</td>
                  <td>Membership Type</td>
                  @foreach ($payments as $payment )
                  @endforeach
                  @if ($payment->membership_type=='Monthly')
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
            
            <tr  >
                <td>{{$payment->member_id}}</td>
                <td> {{$payment->name}}</td>
                <td>{{$payment->membership_type}}</td>
                @if ($payment->membership_type=='Monthly')
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

  
    
</body>
</html>