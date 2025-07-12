<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Basic Table</h2>
  <p>The .table class adds basic styling (light padding and horizontal dividers) to a table:</p>            
  <a href="{{ route('add')}}" class="btn btn-success mr-3">Add New</a> 
  <a href="/importposts" class="btn btn-warning">Fetch From API</a>
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Slug</th>
        <th>Status</th>
        <th>type</th>
        <th>category</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($data as $d)
      <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->title}}</td>
        <td>{{$d->slug}}</td>
        <td>{{$d->status}}</td>
        <td>{{$d->type}}</td>
        <td>{{$d->category}}</td>
        <td>  
            <a href="welcome/edit/{{$d->id}}" class="btn btn-info">Edit</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$d->id}}">Delete</button>

  <!-- The Modal -->
  <div class="modal" id="myModal{{$d->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Are youy Sure Want To delete ?
          <form action="{{ route('delete') }}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{$d->id}}">
              <input type="submit" name="submit" value="delete">
          </form>
        </div>
        
        <!-- Modal footer -->

        
      </div>
    </div>
  </div></td>
    </tr>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>

</body>
</html>
