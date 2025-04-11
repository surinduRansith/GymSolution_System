<div class="table-responsive mt-4">
  <table class="table table-sm table-hover align-middle" id="myTable">
      <thead class="table-secondary">
          <tr>
              <th>Member ID</th>
              <th>Member Name</th>
              <th>Date of Birth</th>
              <th>Gender</th>
              <th>Mobile Number</th>
              <th>Weight (kg)</th>
              <th>Height (cm)</th>
              <th>Start Date</th>
              <th>Expire Date</th>
              <th>Status</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($members as $member)
              <tr>
                  <td>{{ $member->id }}</td>
                  <td>
                      <a href="{{ route('members.profile', $member->id) }}" class="text-decoration-none">
                          {{ $member->name }}
                      </a>
                  </td>
                  <td>{{ $member->dob }}</td>
                  <td>{{ $member->gender }}</td>
                  <td>{{ $member->mobile }}</td>
                  <td>{{ $member->weight }}</td>
                  <td>{{ $member->height }}</td>
                  <td>{{ $member->startDate }}</td>
                  <td>{{ $member->ExpireDate }}</td>
                  <td>
                      @if ($member->status === 'active')
                          <span class="badge bg-success">Active</span>
                      @else
                          <span class="badge bg-danger">Inactive</span>
                      @endif
                  </td>
                  <td>
                      <a href="{{ route('members.edit', $member->id) }}" 
                         class="btn btn-sm btn-primary {{ $member->status == 'inactive' ? 'disabled' : '' }}">
                          <i class="lni lni-pencil-alt"></i>
                      </a>
                  </td>
                  <td>
                      <!-- Delete Button -->
                      <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $member->id }}">
                          <i class="lni lni-trash-can"></i>
                      </button>

                      <!-- Inline Modal -->
                      <div class="modal fade" id="modal{{ $member->id }}" tabindex="-1" aria-labelledby="label{{ $member->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                  <div class="modal-header bg-danger text-white">
                                      <h5 class="modal-title" id="label{{ $member->id }}">
                                          Confirm Delete
                                      </h5>
                                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      Are you sure you want to delete user ID <strong>{{ $member->id }}</strong>?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
                                      <form action="{{ route('membersdelete.delete', $member->id) }}" method="POST" class="d-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- End Modal -->
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
