@php
    use Illuminate\Support\Carbon;

$startDate = Carbon::now()->startOfMonth()->format('Y-m-d'); // First day of the month
$endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
@endphp

@extends('Layouts.app')
@section('content')

<div class="text-center pt-4">
    <h1 class="text-2xl font-semibold">Payment Report</h1>
</div>
<br>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Payment Report</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="card p-4 shadow-lg">
    <form action="{{ route('userpaymentreport.show') }}" method="POST">
        @csrf
        <div class="row mb-4">
            <!-- Member Selection -->
            <div class="col-12 col-md-4 mb-3">
                <select class="form-select select2" aria-label="Select Member" name="memberid">
                    <option selected>Search Member</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" {{ old('memberid') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                @error('memberid')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- All Users Checkbox -->
            <div class="col-12 col-md-2 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="allusers" id="allusers1" value="1">
                    <label class="form-check-label" for="allusers1">
                        All Users
                    </label>
                    @error('allusers')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Date Range Selection -->
            <div class="col-12 col-md-3 mb-3">
                <div class="input-group">
                    <span class="input-group-text">Start Date</span>
                    <input type="date" class="form-control" id="startdate" name="startdate" value="{{ $startDate }}">
                </div>
                @error('startdate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 col-md-3 mb-3">
                <div class="input-group">
                    <span class="input-group-text">End Date</span>
                    <input type="date" class="form-control" id="enddate" name="enddate" value="{{ $endDate }}">
                </div>
                @error('enddate')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="col-12 col-md-1">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>
</div>

<br>

@if ($testvalue == 0)
    @if (count($payments) > 0)

        <!-- PDF Download Button -->
        @if ($allusers == 1)
            <div class="mb-4 text-end">
                <a href="{{ route('alluserpaymentreportpdf.show', ['startdate' => $startDate1, 'enddate' => $endDate1]) }}" class="btn btn-sm btn-danger" title="Download PDF">
                    <i class="fa-solid fa-file-pdf"></i> Download PDF
                </a>
            </div>
        @else
            <div class="mb-4 text-end">
                @foreach ($payments as $payment)
                @endforeach
                <a href="{{ route('userpaymentreportpdf.show', ['id' => $payment->member_id]) }}" class="btn btn-sm btn-danger" title="Download PDF">
                    <i class="fa-solid fa-file-pdf"></i> Download PDF
                </a>
            </div>
        @endif

        <!-- Payments Table -->
        <div class="table-responsive">
            <table class="table table-striped" id="myTable">
                <thead class="table-light">
                    <tr>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Membership Type</th>
                        @if ($payment->membership_type == 'Monthly')
                            <th>Year</th>
                            <th>Month</th>
                        @else
                            <th>Year</th>
                        @endif
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
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
                                <td>{{ $YearName }}</td>
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
    @else
        <div class="alert alert-danger text-center" role="alert">
            Data Not Available
        </div>
    @endif
@else
    <div class="alert alert-warning text-center" role="alert">
        Please Generate Payment Report
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
