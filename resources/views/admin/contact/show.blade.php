@extends('admin_layouts.app')
@section('admin_content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Message Reply</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Message Reply</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="content">
    	<div class="container-fluid">
    		<div class="card  p-2">
        	  <div class="row">	
        		<div class="col-md-9">
        			<div class="row ml-3 mt-3">
                        <div class="col-3">
                            <strong>Name : </strong>
                        </div>
                        <div class="col-8">
                            <p>{{  $contact->name }}</p>
                        </div>
                        <div class="col-3">
                            <strong>Email : </strong>
                        </div>
                        <div class="col-8">
                            <p>{{  $contact->email }}</p>
                        </div>
                        <div class="col-3">
                            <strong>Phone : </strong>
                        </div>
                        <div class="col-8">
                            <p>{{  $contact->phone }}</p>
                        </div>
                        <div class="col-3">
                            <strong>Message : </strong>
                        </div>
                        <div class="col-8">
                            <p> {{  $contact->message }}</p>
                        </div>
                    </div>
        		</div>
        		</div>
        	</div>
    	</div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('admin.contact.reply') }}" method="post">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reply Contact Message</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputEmail1">Customer Email<span class="text-danger">*</span> </label>
                      <input type="email" name="c_email" id="" class="form-control" placeholder="Input your customer email">
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="exampleInputEmail1">Message<span class="text-danger">*</span> </label>
                      <textarea type="text" class="form-control" name="message" required=""> </textarea>
                      <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                    </div>
                  </div>
                  <div>
                  	<button type="submit" class="btn btn-info">Reply Message</button>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
        </form> 

            <!-- /.card -->
          <!-- right column -->
          <div class="col-md-6">
          	@php 
          		$replies = DB::table('replies')->where('contact_id',$contact->id)->orderBy('id','DESC')->get();
          	@endphp

            <!-- Form Element sizes -->
            <div class="card card-primary">
            <div class="card-header">Replies</div>
              	<div class="card-body" style="height: 182px; overflow-y: scroll;">

        		@isset($replies)	
        		   @foreach($replies as $row)
        			<div class="card mt-1">
					  <div class="card-header bg-success">
                        <i class="fa fa-user"></i> @if($row->user_id==0) Admin @else {{ $contact->name }} @endif
					  </div>
					  <div class="card-body">
					    <blockquote class="blockquote mb-0">
					      <p>{{ $row->message }}</p>
					      <footer class="blockquote-footer">{{ date('d F Y'),strtotime($row->reply_date) }}</footer>
					    </blockquote>
					  </div>
					</div>
				  @endforeach	
				@endisset	

        	 </div>
           </div>
         </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



@endsection