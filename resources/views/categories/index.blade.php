@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
</div>
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
          @if ($categories->count()>0)      
            <table class="table">
                <thead>
                    <th>Name</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->title }}
                            </td>
                            <td>
                                {{-- passing categories/{category->id}/edit --}}
                                <a class="btn btn-info btn-sm" href="{{ route('categories.edit',$category->id) }}">Edit</a> 
                            </td>
                            <td>
                              <button class="btn btn-sm btn-danger" onclick="handleDelete({{ $category->id }})">delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          @else
              <h3 class="textcenter">No category added yet</h3>
          @endif
              <!-- Modal -->
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">Delete
                  <form action="" method="POST" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="text-center text-bold">
                          Are you sure you want to delete category?
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
      function handleDelete(id){
        var form = document.getElementById('deleteCategoryForm');
        form.action = '/categories/'+id;
        console.log('deleting..',id);
        $('#deleteModal').modal('show');
      }
    </script>
@endsection