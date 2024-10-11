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
                          
                         
                          </tbody>
                          </table>
                          @else

                          <div class="alert alert-warning text-center" role="alert">
                            No Schedules Found
                        </div>
                          
                          @endif



</div>

                     