<!DOCTYPE html>
<html>
   <head>
      <title>Bootstrap Example</title>
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">
      <link rel = "stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	  <style>
	    .validate {
			color: red;
			margin-bottom: 70px;
			font-size: 13px;
		   }
	</style>
   </head>
   <body >
  
	<div class="col-md-12" style="margin-top:50px">
		<div class="card">
			<div class="card-header">
				<strong class="card-title">Card Details Form</strong>
			</div>
			<div class="card-body">
			  <form class = "form-horizontal" action="{{route('card-details-store')}}" method="post" role = "form" >
				@csrf
					<div class = "form-group">
					<label for = "personname" class = "col-sm-2 control-label">Person Name</label>
					<div class = "col-sm-3">
					   <input type = "text" class = "form-control char_validation uppercase_letter" name="PersonName" id = "personname" placeholder = "Enter Person Name">
					</div>
					 <span id="error_personname" class="validate"></span>
				 </div>
				 <div class = "form-group">
					<label for = "emailid" class = "col-sm-2 control-label">Email Id</label>
					<div class = "col-sm-3">
					   <input type = "email" class = "form-control" name="EmailId" id = "emailid" placeholder = "Enter Email Id">
					</div>
					<span id="error_emailid" class="validate"></span>
				 </div>
				 <div class = "form-group">
					<label for = "description" class = "col-sm-2 control-label ">Short Description</label>
					<div class = "col-sm-3">
					   <textarea  class = "form-control char_validation uppercase_letter" name="ShortDescription" id = "description" placeholder = "Enter Short Description"></textarea>
					</div>
					<span id="error_description" class="validate"></span>
				 </div>
				 <div class = "form-group number_validation_parent">
					<label for = "contacts" class = "col-sm-2 control-label">Contacts</label>
					<div class = "col-sm-3">
					   <input type = "text" class = "form-control number_validation_child" name="Contacts" Maxlength="10" id = "contacts" placeholder = "Enter Contacts">
					</div>
						<span id="error_contacts" class="validate"></span>
				 </div>
				 <div class = "form-group">
					<label for = "address" class = "col-sm-2 control-label">Single Address</label>
					<div class = "col-sm-3">
					   <input type = "text" class = "form-control " name="SingleAddress" id = "address" Maxlength="50" placeholder = "Enter Single Address">
					</div>
					<span id="error_address" class="validate"></span>
				 </div> 
				 <div class = "form-group">
					<div class = "col-sm-offset-2 col-sm-10">
					   <button type = "submit" id="form_submit" class = "btn btn-primary">Submit</button>
					</div>
				 </div>
			  </form>
			  </div>
			 </div>
			</div>
			 <div class="col-sm-12" style="margin-top:50Px">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Card Details Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Person Name</th>
											<th>Email Id</th>
											<th>Short description</th>
											<th>Contacts</th>
											<th>Single Address</th>
											<th>Created Date</th>
                                            <th>Edit</th>
											<th>Delete</th>
                                         </tr>
                                    </thead>
                                    <tbody>
									<?php if(isset($FetchRecord)){?>
                                    @foreach ($FetchRecord as $Record)
                                        <tr>
                                           <td>{{$Record->PersonName}}</td>
										   <td>{{$Record->EmailID}}</td>
										   <td>{{$Record->ShortDescription}}</td>
										   <td>{{$Record->Contacts}}</td>
										   <td>{{$Record->SingleAddress}}</td>
										   <td>{{$Record->CreatedDate}}</td>
                                           <td>
											<button class="btn btn-primary btn-sm editbtn" data-toggle="modal" data-target="#carddetails" data-id="{{$Record->CardId}}" data-pname="{{$Record->PersonName}}" data-pemail="{{$Record->EmailID}}" data-pdesc="{{$Record->ShortDescription}}"  data-pcontacts="{{$Record->Contacts}}"  data-paddress="{{$Record->SingleAddress}}">
											  <span class="glyphicon glyphicon-pencil"></span> Edit 
											</button>
											</td>
											<td>
										   <form method="get" onsubmit="return confirm('Are you sure u want to delete this Card Details?')" class="d-inline-block" action="{{route('card-details-destroy',$Record->CardId)}}">
                                           {{method_field('DELETE')}} 
                                           {{method_field('PATCH')}}
                      
                                           @csrf
                                            @method('delete')  
                                             <button type="submit" class="btn btn-danger btn-sm">
											  <span class="glyphicon glyphicon-trash"></span> Delete 
											</button>
											 </form>
                                            </td>
                                         </tr>
                                                                
                                    </tbody>
                                    @endforeach    
									<?php } ?>
                                    </tbody>
                                  
                                </table>
                            </div>
                        </div>
                    </div>
					     <!-- start edit -->
                     <div class="modal fade" id="carddetails" role="dialog">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3 class="" style="margin-left:15%">Update Card Details</h3>
                               </div>
                               <form id="editmodal">
                               <div class="modal-body">
                               {{csrf_field()}}
                               {{ method_field('GET') }} 
                               
                                    <input type="hidden" name="card_id" id="card_id_modal">
                                   
                                      <div class="form-group">
                                        <label for="per_name" class="control-label mb-1">Person Name</label>
                                         <input id="per_name" name="pname" type="text" class="form-control " placeholder="Person Name"  >
                                      </div>
									    <div class="form-group">
                                        <label for="per_email" class="control-label mb-1">Email Id</label>
                                         <input id="per_email" name="pemail" type="text" class="form-control " placeholder="Email Id"  >
                                      </div>
									    <div class="form-group">
                                        <label for="per_desc" class="control-label mb-1">Short Description</label>
                                         <input id="per_desc" name="pdescription" type="text_area" class="form-control " placeholder="Short Description"  >
                                      </div>
									    <div class="form-group">
                                        <label for="per_contacts" class="control-label mb-1">Contacts</label>
                                         <input id="per_contacts" name="pcontacts" type="text" class="form-control " placeholder="Contacts"  >
                                      </div>
									    <div class="form-group">
                                        <label for="per_address" class="control-label mb-1">Single Address</label>
                                         <input id="per_address" name="paddress" type="text" class="form-control"  placeholder="Single Address"  >
                                      </div>
                                      </div>
                                    
                            <div class="modal-footer">
                            <input type="button" id="modal_update" class="btn btn-primary" style="margin-left:45%" value="Update">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                        </div>
                       </div>
                      </div>
                    <!-- end of edit -->
	  
   </body>
</html>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<!-- Edit Script -->

<script>
$(document).ready(function() 
{
    $("#form_submit").on('click',function()
    {  
     var error_msg = "";
   
    if($("#personname").val()=="")
	{	
	    $("#error_personname").text("Please enter Person Name");
	    error_msg = "Error";
	}
	else
	{
	    $("#error_personname").text("");
    }
	
	 if($("#emailid").val()!="")
	 {	
		$("#error_emailid").text("");
		var regexname="^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@" + "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
		if($("#emailid").val().match(regexname))
		{
				$("#error_emailid").text("");
		}
		else
		{
			$("#error_emailid").text("Please enter valid email id");
			error_msg = "Error"; 
		}
	 }
	 else
	 {
		$("#error_emailid").text("Please enter email id");
		error_msg = "Error"; 
	 }
	
   	if($("#description").val()=="")
	{	
	    $("#error_description").text("Please enter Description");
	    error_msg = "Error";
	}
	else
	{
	    $("#error_description").text("");
    }
	if($("#contacts").val()=="")
	{	
	    $("#error_contacts").text("Please enter Contacts");
	    error_msg = "Error";
	}
	else
	{
	    $("#error_contacts").text("");
    }
	if($("#address").val()=="")
	{	
	    $("#error_address").text("Please enter Single Address");
	    error_msg = "Error";
	}
	else
	{
	    $("#error_address").text("");
    }
    if(error_msg=="Error")
	{
		return false;	
    }
  });
});
var APP_URL = {!! json_encode(url('/')) !!};
 var $ = jQuery;
 jQuery(document).ready(function($)
  {
      $('.editbtn').on('click',function(){
        $('#carddetails').modal('show');

        $tr=$(this).closest('tr');

        var data=$tr.children("td").map(function()
        {
            return $(this).text();
        }).get();
   
       
        
        var name=$(this).data('pname');
		$("#per_name").val(name);
		
		var email=$(this).data('pemail');
		$("#per_email").val(email);
		
		var desc=$(this).data('pdesc');
		$("#per_desc").val(desc);
		
		var contact=$(this).data('pcontacts');
		$("#per_contacts").val(contact);
		
		var name=$(this).data('paddress');
		$("#per_address").val(name);
		

        var CardId=$(this).data('id');
		
		console.log(name);
		console.log(email);
       $('#card_id_modal').html(CardId);
      
		$('#modal_update').on('click',function(e){
            e.preventDefault();
            
            $.ajax({
                type:'GET',
                url:APP_URL+"/cardDetailsEdit/update/"+CardId,
                data:$("#editmodal").serialize(),
                success:function(data){
                 console.log(data);
                      $('#carddetails').modal('hide');
                      alert("Data Updated");
                      window.location = "";
                },

                error:function(error){
                 console.log(error);
                }

                });
            });
      });
  });
 </script> 
 <script>
var msg='{{Session::get('alert')}}';
var exist='{{Session::has('alert')}}';
	if(exist)
	{
		alert(msg);
	}

//validation for characters only
    $(function() {
      $('.char_validation').bind('keyup blur', function() { 
          $(this).val(function(i, val) {
              return val.replace(/[^a-z\s]/gi,''); 
          });
      });
    });

//Validation for Upper case
   $(function(){
        $('.number_validation_parent').on('keydown', '.number_validation_child', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
      });
      
</script>