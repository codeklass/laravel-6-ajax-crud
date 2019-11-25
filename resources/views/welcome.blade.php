@extends('layouts.app')

@section('content')
<div class="container mt-3">
  <h2>Laravel 6 AJAX Students CRUD Tutorial</h2>
             
             <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal">
  Add New Student
</button>
             <div class="clearfix"></div>
  <table class="table table-striped mt-5">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Location</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="studData">
    @forelse($students as $student)
      <tr id="stud{{$student->id}}">

        <td>{{$student->id}}</td>
        <td>{{$student->name}}</td>
        <td>{{$student->email}}</td>
        <td>{{$student->location}}</td>
        <td><a href="{{route('students.show',['student'=>$student->id])}}" data-toggle="modal" data-name='{{$student->name}}' data-email='{{$student->email}}' data-location='{{$student->location}}' data-target="#editModal" data-id='{{$student->id}}' class="btn btn-warning editBtn">Edit</a> <a href="{{route('students.destroy',['student'=>$student->id])}}" data-id='{{$student->id}}' class="btn btn-danger delBtn">Delete</a></td>
      </tr>
      @empty
      <tr id='noStudData'><td colspan="5" class="text-center">Sorry No Students</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $( document ).on('submit','#studentCreateForm',function(e) {
    e.preventDefault();

    var name = $.trim($('#create-name').val());
    var email = $.trim($('#create-email').val());
    var location = $.trim($('#create-location').val());

    if (name=='' || email=='' || location=='') {
      $('.alertMsg').empty();
      $('.alertMsg').append('Please fill all field');
      setTimeout(function(){ $('.alertMsg').empty(); }, 3000);
    }else{

    var url=$('#studentCreateForm').attr('action');
      $.post( url, $( "#studentCreateForm" ).serialize())
            .done(function( data ) {
              
              var sdata=data['response']['data'];
              $("#noStudData").remove();
              var editBtn='<a href="/students/'+sdata['id']+'" data-toggle="modal" data-name="'+sdata['name']+'" data-email="'+sdata['email']+'" data-location="'+sdata['location']+'" data-target="#editModal" data-id="'+sdata['id']+'" class="btn btn-warning editBtn">Edit</a>';

              var delBtn='<a href="/students/'+sdata['id']+'" data-id="'+sdata['id']+'" class="btn btn-danger delBtn">Delete</a>';
              $("#studData").append("<tr id='stud"+sdata['id']+"'><td>"+sdata['id']+"</td><td>"+sdata['name']+"</td><td>"+sdata['email']+"</td><td>"+sdata['location']+"</td><td>"+editBtn+" "+delBtn+"</td></tr>");
              $('#createModal').modal('hide');
              $('#studentCreateForm').trigger("reset");
            })
            .fail(function() {
                alert( "error" );
              })
              
    };
   
});

  $( document ).on('click','.editBtn',function(e) {
    
    $('#edit-name').val($(this).attr('data-name'))
    $('#edit-email').val($(this).attr('data-email'))
    $('#edit-location').val($(this).attr('data-location'))
    $("#studentEditForm").attr('action',$(this).attr('href'))
    
   
  });

  $( document ).on('submit','#studentEditForm',function(e) {
    e.preventDefault();

    var name = $.trim($('#edit-name').val());
    var email = $.trim($('#edit-email').val());
    var location = $.trim($('#edit-location').val());


    if (name=='' || email=='' || location=='') {
      $('.alertEditMsg').empty();
      $('.alertEditMsg').append('Please fill all field');
      setTimeout(function(){ $('.alertEditMsg').empty(); }, 3000);
    }else{

    var url=$('#studentEditForm').attr('action');
      $.post( url, $( "#studentEditForm" ).serialize())
            .done(function( data ) {
              
              
              var sdata=data['response']['data'];
              $("#stud"+sdata['id']).empty();
              var editBtn='<a href="/students/'+sdata['id']+'" data-toggle="modal" data-name="'+sdata['name']+'" data-email="'+sdata['email']+'" data-location="'+sdata['location']+'" data-target="#editModal" data-id="'+sdata['id']+'" class="btn btn-warning editBtn">Edit</a>';

              var delBtn='<a href="/students/'+sdata['id']+'" data-id="'+sdata['id']+'" class="btn btn-danger delBtn">Delete</a>';
              $("#stud"+sdata['id']).append("<td>"+sdata['id']+"</td><td>"+sdata['name']+"</td><td>"+sdata['email']+"</td><td>"+sdata['location']+"</td><td>"+editBtn+" "+delBtn+"</td>");
              $('#editModal').modal('hide');
              $('#studentEditForm').trigger("reset");
            })
            .fail(function() {
                alert( "error" );
              })
              
    };
   
});

  $( document ).on('click','.delBtn',function(e) {
    e.preventDefault();

var id=$(this).attr('data-id');


    var url=$(this).attr('href');
      $.post( url, {_method:"DELETE"})
            .done(function( data ) {
              
              //var sdata=data['response']['data'];
              $("#stud"+id).remove();
            })
            .fail(function() {
                alert( "error" );
              })
              
    
   
});
</script>
@endsection