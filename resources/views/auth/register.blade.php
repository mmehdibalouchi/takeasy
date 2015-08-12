@extends('app')

@section('header')

  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
  @endsection

@section('content')
    <div class="container">

    <!--   <button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button> -->

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              <h4><span class="glyphicon glyphicon-lock"></span> Register</h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
            

              <form method="POST" action="/register" enctype="multipart/form-data"> 
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name"  value="{!! old('name') !!}">
                </div>

                <div class="form-group">
                    <label for="family">Family</label>
                    <input class="form-control" type="text" name="family"  value="{!! old('family') !!}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  value="{!! old('email') !!}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>

                  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Sign up</button>
                  @include('errors.list')
              </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
          
        </div>
      </div> 
    </div>
@endsection


@section('footer') 
    <script>
            $('#myModal').modal({
    backdrop: 'static',
    keyboard: false
})  
    </script>
@endsection
