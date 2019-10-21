@extends('home')
   
@section('content')
<!DOCTYPE html>
 
<html lang="en">
<head>
<title>Blog User</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
      <body>
         <div class="container">
               <h2>Article with Yajra Table</h2>
                  <table class="table table-bordered" id="laravel_datatable">
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th>Title</th>
                           <th>Description</th>
                           <th>Status</th>
                           <th>Author</th>
                           <th>Created at</th>
                        </tr>
                     </thead>
                  </table>
         </div>
   <script>
   $(document).ready( function () {
    $('#laravel_datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ url('article-list') }}",
            columns: [
                     { data: 'id', name: 'id' },
                     { data: 'title', name: 'title' },
                     { data: 'description', name: 'description' },
                     { data: 'status', name: 'status' },
                     { data: 'user_id', name: 'user_id'},
                     { data: 'created_at', name: 'created_at' },
                     {data: 'action', name: 'action', orderable: true, searchable: true},
                  ]
        });
     });
  </script>
   </body>
</html>
@endsection