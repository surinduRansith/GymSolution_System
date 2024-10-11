<div class="col-sm-9 text-secondary">
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>

    @endif
 

  <form wire:submit.prevent="submit"> 
      <div class="row align-items-center"> 

          <div class="col-md-8">
              <select class="form-select" aria-label="Default" name="exerciselist" wire:model="exerciselist">
                  <option selected>Select Schedule</option>
                  @foreach ($scheduleTypes as $exercise)
                      <option value="{{ $exercise->id }}">{{ $exercise->scheduleName }}</option>
                  @endforeach
              </select>
          </div>

          <div class="col-md-4"> 
              <button type="submit" class="btn btn-primary"> 
                  Add  
                  <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
              </button>
          </div>

      </div>
  </form>

  @error('exerciselist')
      <p class="text-danger">{{ $message }}</p>
  @enderror
</div>


