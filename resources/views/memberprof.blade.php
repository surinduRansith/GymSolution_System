@extends('Layouts.app')
@section('content')

@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>

@endif


@foreach ($members as $member )

@php
        // Get the current date
        $now = new DateTime();

        // Retrieve the date of birth from the member object
        $dob = new DateTime($member->dob);

        // Calculate the difference in years (age)
        $age = $now->diff($dob)->y;

        
    @endphp


    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('members.data')}}">Member List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Member Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-6 mb-3">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{$member->gender == 'male'?'https://bootdey.com/img/Content/avatar/avatar7.png':'https://bootdey.com/img/Content/avatar/avatar3.png'}}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      
                        <h4> {{$member->name}}</h4>  
                    </div>
                    <div class="mt-3 ">
                          @if (count($schedules) > 0)
                          <table class="table  table-striped table-responsive-sm ">
                            <thead>
                            </thead>
                            <tbody>
                          @foreach ($schedules as $schedule )
                          <tr>
                            <td >{{$schedule->scheduleName}}</td>
                           <td> <a href="{{route('memberscheduleedit.show',['id' => $member->id, 'scheduleid' => $schedule->id])}}" class="btn btn-sm btn-primary " ><i class="lni lni-pencil-alt"></i></button> </td>
                          
                           
                            <td> 
                              
                               <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$schedule->id}}">
  <i class="lni lni-trash-can"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{$schedule->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Do You Want to Delete This Exercise  - {{$schedule->scheduleName}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form action="{{route('memberscheduledelete.delete',['id' => $member->id, 'scheduleid' => $schedule->id])}}" method="POST">
          
          @csrf
          @method('Delete')
        <button type="submit" class="btn btn-danger">Yes</button>
      </form>
      </div>
    </div>
  </div>
</div>
                              
                              
                              
                              
                              
                              
                              </td>
                          </tr>
                        
                          @endforeach
                          
                          <tr>
                           <td colspan="6">
                            
                            <a href="{{route('memberschedulelist.data',['id' => $member->id])}}" class="btn btn-sm btn-primary " ><i class="lni lni-download"></i></a>

                                 <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#scheduleall">
  <i class="lni lni-trash-can"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="scheduleall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Do You Want to Delete This Schedule</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">No</button>
        <a href="{{route('memberallscheduledelete.delete',['id' => $member->id])}}" class="btn btn-sm btn-danger "><i class="lni lni-eraser"></i></i></a>
      </form>
      </div>
    </div>
  </div>
</div>
                            
                             </td>
                          </tr>
                          </tbody>
                          </table>
                          @endif
                     
                      
                     
                      
                      
                     
                  </div>
                  </div>
                </div>
              </div>

              
             
    </div>
    
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Member ID</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        
                      {{$member->id}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->name}}
                       
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date Of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->dob}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Age</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$age}}
                    </div>
                    
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->gender}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->mobile}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Height(cm)</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->height}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Weight (kg)</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">

      @if ($formattedUpdateDate)
    <p class="text-warning">Last Update Date: {{ $formattedUpdateDate }}</p>
 

    @if ($dateDifference<30)
      @php
        $activetype = 'disabled'
       
      @endphp
       <p class="text-danger">Weight can only be updated after 30 days from the last update.</p>
      @else
      @php
      $activetype = ''
    @endphp
    @endif
@else
    <p class="text-danger" >No weight records found for this member.</p>
@endif
<form action="{{route('weight.update',$member->id)}}" method="POST">
  @csrf
  @method('PUT')
                      <div class="input-group mb-3 " >
                        <input type="number" class="form-control" id="weightUpdate" name="weightUpdate" value="{{$member->weight}}">
                        <button class="btn  btn-primary " type="submit" {{$activetype}} >Update</button>
                      </div>
                      
                    </form>

                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop" {{$member->status=='inactive'?'disabled':''}}>
                      Weight History
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Weight Progress Chart</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                          </div>
                          <div class="modal-body">
                            <div class="container">
@foreach ($memberWeights as $memberWeight  )

@php
        $weightlist[] = $memberWeight->weight;

        


    @endphp
  
@endforeach





                              <div>
                                <canvas id="myChart"></canvas>
                            </div>
                            
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const ctx = document.getElementById('myChart').getContext('2d');
                            
                                    new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: [
                                                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                            ],
                                            datasets: [{
                                                label: 'Member Weights',
                                                data: @json($weightlist), // Make sure this is a valid array
                                                borderWidth: 1,
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                            </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Start Date</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->startDate}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Expire Date</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->ExpireDate}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">BMI</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                
                       <?php
                       $heigtM = $member->height/100;


                    
                      ?>
                    
                        @if ($member->weight/($heigtM*$heigtM)<16)
                          {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color:#bc2020">Severe Thinness</p>
                        @elseif($member->weight/($heigtM*$heigtM)<17)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #d38888">Moderate Thinness</p>
                        @elseif($member->weight/($heigtM*$heigtM)<17)
                        @elseif($member->weight/($heigtM*$heigtM)<18.5)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #ffe400">Mild  Thinness</p>
                        @elseif($member->weight/($heigtM*$heigtM)<25)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #008137">Normal</p>
                        @elseif($member->weight/($heigtM*$heigtM)<30)
                        {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #ffe400" >Overweight</p>
                        @elseif($member->weight/($heigtM*$heigtM)<35)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #d38888">Obese Class I</p>
                        @elseif($member->weight/($heigtM*$heigtM)<40)
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #bc2020"> Obese Class II</p>
                        @else
                         {{number_format($member->weight/($heigtM*$heigtM),1)}}<p style="color: #8a0101">Obese Class III</p>
                          
                        @endif

                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <form action="{{route('updateshedule.insert',$member->id)}}" method="post">
                        @csrf
                      <h6 class="mb-0">Schedule</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                        <select class="form-select select2  " aria-label="Default" name="exerciselist" {{$member->status=='inactive'?'disabled':''}}>
                            <option selected>Select Schedule</option>
                            @foreach ($scheduleTypes as $exercise )
                            <option value="{{$exercise->id}}" >{{$exercise->scheduleName}}</option>
                            @endforeach
                          </select>
                    
                          
                    </div>
                   
                <div class="col-sm-1 text-secondary">
                  <button type="submit" class="btn btn-warm" {{$member->status=='inactive'?'disabled':''}}>add</button>

                  
              </div>
            </form>
                  </div>
                  @error('exerciselist')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <hr>
                 
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Membership</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$member->membershiptype}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      @if ($member->status == 'active')
                      <form action="{{route('memberstatus.update',$member->id)}}" method="POST">
                        @csrf
                      @method('PUT')

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" checked value="active">
                        <label class="form-check-label" for="status1">
                          Active
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="inactive">
                        <label class="form-check-label" for="status2">
                          Inactive
                        </label>
                      </div>
                        <button type="submit" class="btn btn-info ">Update</button>
                      </div>
                      </form>
                      @else
                      <form action="{{route('memberstatus.update',$member->id)}}" method="POST">
                        @csrf
                      @method('PUT')
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1"  value="active">
                        <label class="form-check-label" for="status1">
                          Active
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" checked value="inactive">
                        <label class="form-check-label" for="status2">
                          Inactive
                        </label>
                      </div>
                        <button type="submit" class="btn btn-info ">Update</button>
                      </div>
                      </form>
                      @endif
                    </div>
                    
                  
               
                  @endforeach
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info {{$member->status=='inactive'?'disabled':''}}" href="{{route('members.edit',$member->id)}}" >Edit</a>
                      <a class="btn btn-success {{$member->status=='inactive'?'disabled':''}}" href="{{route('paymentpage.data',$member->id)}}" >Add Payment</a>
                      <a class="btn btn-warning {{$member->status=='inactive'?'disabled':''}}" href="{{route('attendance.show',$member->id)}}" >Attendance</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          

          <script>

            var select_box_element = document.querySelector('#exerciselist');
        
            dselect(select_box_element, {
                search: true
            });
        
        </script>
<script>
  $('.select2').select2();
</script>

    

    
@endsection