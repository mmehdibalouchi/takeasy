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
	          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
	        </div>
	        <div class="modal-body" style="padding:40px 50px;">
	        

	          <form method="POST" action="/login">
	          	{!! csrf_field() !!}
	            <div class="form-group">
	              <label for="email"><span class="glyphicon glyphicon-user"></span> Email</label>
	              <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email">
	            </div>
	            <div class="form-group">
	              <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
		              <input type="password" class="form-control" name="password" id="psw" placeholder="Enter password">
	            </div>
	            <div class="checkbox">
	              <label><input type="checkbox" value="" checked>Remember me</label>
	            </div>
	              <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
	              @include('errors.list')
	          </form>
	        </div>
	        <div class="modal-footer">
	          <!-- {-- <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button> --} -->
	          <p>Not a member? <a href="/register">Sign Up</a></p>
	          <p>Forgot <a href="#">Password?</a></p>
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
