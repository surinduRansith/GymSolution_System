<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
   
  }

  h1, h3 {
    text-align: center;
    margin: 10px 0;
    color: #333;
  }

  h1 {
    font-size: 28px;
  }

  h3 {
    font-size: 20px;
    color: #555;
  }

  table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    font-size: 16px;
  }

  th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
  }

  td {
    color: #333;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #e8f4e5;
  }
</style>
</head>
<body>
@foreach ($schedules as $schedule )
  @php
    $schedulename = $schedule->scheduleName;
  @endphp
@endforeach

@foreach ($Memberdetails as $memberdetail)
  <h1>{{ $memberdetail->name }}</h1>
@endforeach

<h3>{{ $schedulename }}</h3>

<table>
  <thead>
    <tr>
      <th>Exercise Name</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($schedules as $schedule )
      @php
        $schedulename = $schedule->scheduleName;
      @endphp
      <tr>
        <td>{{ $schedule->exercise_name }}</td>
        <td>{{ $schedule->noofsets }} X {{ $schedule->nooftime }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>