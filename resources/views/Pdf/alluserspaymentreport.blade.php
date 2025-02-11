<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Users Payment</title>

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
          border-radius: 8px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          padding: 15px;
        }
    
        table {
         
          border-collapse: collapse;
          
        }
    
        table thead td {
          background-color: #4CAF50;
          color: white;
          font-weight: bold;
          padding: 10px;
          text-align: center;
          border: 1px solid #ddd;
        }
    
        table tbody td {
          padding: 10px;
          text-align: center;
          border: 1px solid #ddd;
          color: #333;
        }
    
        table tr:nth-child(even) {
          background-color: #f2f2f2;
        }
    
        table tr:hover {
          background-color: #e8f4e5;
        }
    
        table td:first-child,
        table thead td:first-child {
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
                <td>Member ID</td>
                <td>Member Name</td>
                <td>Membership Type</td>
                <td>Month</td>
                <td>Year</td>
                <td>Amount(Rs.)</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($payments1 as $payment)
                @php
                  $date = $payment->created_at;
                  $dateTime = new DateTime($date);
                  $YearName = $dateTime->format('Y');
                @endphp
                <tr>
                  <td>{{ $payment->member_id }}</td>
                  <td>{{ $payment->name }}</td>
                  <td>{{ $payment->membership_type }}</td>
                  <td>{{ $payment->month }}</td>
                  <td>{{ $YearName }}</td>
                  <td>{{ $payment->amount }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </body>
    </html>