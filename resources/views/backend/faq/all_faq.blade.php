@extends('admin.admin_dashboard')
@section('admin') 

<div class="page-content"> 
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
         
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Faq</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group"> 

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add FAQ</button>
                
            </div>
        </div>
    </div>
    <!--end breadcrumb-->


    
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Faq Title </th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($faq as $key=> $item ) 
                        <tr>
                            <td>{{ $key+1 }}</td> 
                            <td>{{ $item->topic }}</td>
                            <td>{{ Str::limit($item->message, 40) }}</td>
                            
                            <td>
    
    <button type="button" class="btn btn-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#faq" id="{{ $item->id }}" onclick="faq(this.id)" >Edit</button>


   
    <a href="{{ route('delete.all.faq',$item->id) }}" class="btn btn-danger px-3 radius-30" id="delete"> Delete</a>
  

                            </td>
                        </tr>
                        @endforeach 
                      
                    </tbody>
                 
                </table>
            </div>
        </div>
    </div>
     
    <hr/>
     
</div>


	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                
            <form action="{{ route('store.all.faq') }}" method="post">
                @csrf

                <div class="form-group mb-3">
                    <label for="" class="form-label">Faq Tile</label>
                    <input type="text" name="topic" class="form-control">
                </div>


            

                <div class="card">
					<div class="card-body">
						
						<div id="editor">
                        <label for="" class="form-label">Faq Message</label>
                        <textarea rows="4" cols="50" type="text" name="message" class="form-control" ></textarea>
							<p><br></p>
						  </div>
					</div>
				</div>
            

                </div>
                <div class="modal-footer">
                   
        <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="faq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                
            <form action="{{ route('update.all.faq') }}" method="post">
                @csrf

                <input  type="hidden" name="topic_id" id="topic_id" >
                <input  type="hidden" name="message_id" id="message_id" >

                <div class="form-group mb-3">
                    <label for="" class="form-label">Title</label>
       <input type="text" name="topic" class="form-control" id="topic" >
                </div>


                <div class="form-group mb-3">
                    <label for="" class="form-label">Message</label>
                    <textarea rows="4" cols="50"  type="text" name="message" class="form-control" id="message" ></textarea>
                </div>

               
            

                </div>
                <div class="modal-footer">
                   
        <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

            </div>
        </div>
    </div>

    <script>
		var quill = new Quill('#editor', {
		  theme: 'snow'
		});
	  </script>

    <script>
        function faq(id){
            $.ajax({
                type: 'GET',
                url: '/edit/all/faq/'+id,
                dataType: 'json',

                success:function(data){
                    // console.log(data)  
                    $('#topic').val(data.topic);
                    $('#message').val(data.message);
                    $('#topic_id').val(data.id);
                  
                }

            })

        }
    </script>

@endsection