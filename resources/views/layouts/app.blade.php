<!DOCTYPE html>
<html lang="en">
<head>
  <title>CodeKlass Laravel 6 AJAX CRUD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css")}}">
  
</head>
<body>
<!-- Edit Student Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Create Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="alertMsg p-2"></div>
        <form action="{{route('students.store')}}" method="post" id="studentCreateForm">
        
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="create-name" name="name" placeholder='Enter Student Name'>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="create-email" name="email" placeholder='Enter Student Email'>
              </div>
              <div class="form-group">
                <label for="name">Location:</label>
                <input type="text" class="form-control" id="create-location" name="location" placeholder='Enter Student Location'>
              </div>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Edit Student Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="alertEditMsg"></div>
        <form action="" method="post" id="studentEditForm">
        <input type="hidden" name="_method" value="PUT">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="edit-name" name="name" placeholder='Enter Student Name'>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="edit-email" name="email" placeholder='Enter Student Email'>
              </div>
              <div class="form-group">
                <label for="name">Location:</label>
                <input type="text" class="form-control" id="edit-location" name="location" placeholder='Enter Student Location'>
              </div>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
      </div>
      
    </div>
  </div>
</div>
@include('layouts.header')


@yield('content')

@include('layouts.footer')
</body>
<script src="{{ asset("assets/js/jquery.min.js")}}"></script>
  <script src="{{ asset("assets/js/popper.min.js")}}"></script>
  <script src="{{ asset("assets/js/bootstrap.min.js")}}"></script>
<script type="text/javascript">
$( document ).ready(function() {
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
});
	
</script>
@yield('scripts')
</html>
