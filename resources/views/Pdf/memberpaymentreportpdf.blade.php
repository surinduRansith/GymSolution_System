<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Payment</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  
    <style>
        body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
        
        }
    
     
    
        .table-responsive {
          overflow-x: auto;
          background-color: #fff;
          border-radius: 10px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          padding: 15px;
        }
    
        table {
         
          border-collapse: collapse;
          
        }
    
        table th, table td {
          border: 1px solid #ddd;
          padding: 10px;
          text-align: center;
        }
    
        table th {
          background-color: #4CAF50;
          color: white;
          font-weight: bold;
          font-size: 16px;
        }
    
        table td {
          font-size: 14px;
          color: #333;
        }
    
        table tr:nth-child(even) {
          background-color: #f2f2f2;
        }
    
        table tr:hover {
          background-color: #e8f4e5;
        }
    
        table td:first-child, table th:first-child {
          text-align: left;
        }
      </style>
    </head>
    <body>
      <h1 style="text-align: center">Payment Report</h1>
      <div class="row">
        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Membership Type</th>
                @foreach ($payments as $payment )
                @endforeach
                @if ($payment->membership_type == 'Monthly')
                  <th>Month</th>
                @else
                  <th>Year</th>
                @endif
                <th>Amount(Rs.)</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($payments as $payment )
                @php
                  $date = $payment->created_at;
                  $dateTime = new DateTime($date);
                  $YearName = $dateTime->format('Y');
                @endphp
                <tr>
                  <td>{{ $payment->member_id }}</td>
                  <td>{{ $payment->name }}</td>
                  <td>{{ $payment->membership_type }}</td>
                  @if ($payment->membership_type == 'Monthly')
                    <td>{{ $payment->month }}</td>
                  @else
                    <td>{{ $YearName }}</td>
                  @endif
                  <td>{{ $payment->amount }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </body>
    </html>