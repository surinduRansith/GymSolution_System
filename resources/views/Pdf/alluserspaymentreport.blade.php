<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>All Users Payment</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      padding: 30px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #343a40;
      font-weight: 600;
    }

    .table-responsive {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #007bff;
      color: white;
    }

    thead td {
      padding: 12px;
      font-weight: 600;
      text-align: center;
      border: 1px solid #dee2e6;
    }

    tbody td {
      padding: 12px;
      border: 1px solid #dee2e6;
      text-align: center;
      color: #495057;
    }

    tbody tr:nth-child(even) {
      background-color: #f1f3f5;
    }

    tbody tr:hover {
      background-color: #e2f0fb;
      transition: background 0.3s ease;
    }

    td:first-child, thead td:first-child {
      text-align: left;
    }

    @media print {
      body {
        background-color: white;
        padding: 0;
      }

      .table-responsive {
        box-shadow: none;
        padding: 0;
      }

      h1 {
        margin-top: 0;
      }
    }
  </style>
</head>
<body>

  <h1>Payment Report</h1>

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
            <td>Amount (Rs.)</td>
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
