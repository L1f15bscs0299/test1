@extends('includes.base')
@section('content')
<style type="text/css">
	#interfaces {
		width: 105%;
  		/*padding: 10px;*/
  		border: 0.5px solid #80808073;
  		margin: 0;
	}



	h3 {
		padding-top: 8px;
    	padding-left: 12px;
    	height: 42px;
	}

	#esisting_interface {
		border: 1px solid gray;
    	background: aliceblue;
    	display: flex;
    	justify-content: center;
	}

	#interface_div {
		padding-left: 32px;
    	padding-top: 19px;
	}

	#heading {
		margin-right: 82rem !important
	}

	#add_row {
		margin-top: 2rem !important
	}

	
</style>
<div id="interfaces">
	<div id="esisting_interface">
		<h3 id="heading">Select From exsisting Templates</h3>
	</div>

	<div id='interface_div'>
		<label for="interface">Select Template</label>
	  <br>
	  <select name="cars" id="interface">
	    <option value="volvo">Volvo</option>
	    <option value="saab">Saab</option>
	    <option value="opel">Opel</option>
	    <option value="audi">Audi</option>
	  </select>
	</div>

		
</div>
	<br><br>
<div id="interfaces">
	<div id='esisting_interface'>
		<div id="custome_container">
			<h3 id="heading">Selected Template</h3>

		</div>
		<div id='button_container'>
			<a id="add_row" class="btn btn-default pull-left">Add Row</a>
		</div>
	</div>
	

		

	<div class="container">
	    <div class="row clearfix">
			<div class="col-md-12 column">
				<form method="POST" action="/add_rules" enctype="multipart/form-data" id="rules_form">
					@csrf
					<div id="main">
						<div>
							<label>Template Name</label>
							<input type="text" name="template_name" class="form-control">
						</div>
						<div>
											<table class="table table-bordered table-hover" id="tab_logic">
					<thead>
						<tr >
							<th class="text-center">
								#
							</th>
							<th class="text-center">
								Chain
							</th>
							<th class="text-center">
								Comments
							</th>
							<th class="text-center">
								Source IP
							</th>
							<th class="text-center">
								Destination IP
							</th>
							<th class="text-center">
								Source Port
							</th>
							<th class="text-center">
								Destination Port
							</th>
							<th class="text-center">
								Protocol
							</th>
							<th class="text-center">
								Flags
							</th>
							<th class="text-center">
								Actions
							</th>
							<th class="text-center">
								Delete
							</th>
						</tr>
					</thead>
					<!-- test comment -->
					<tbody>
						<tr id='addr0'>
							<td>
							<?php $i = 1 ?>
							{{$i}}
							</td>
							<td>
					      		<select>
					      			<option>INPUT</option>
					      			<option>OUTPUT</option>
					      			<option>FORWARD</option>
					      		</select>
	      					</td>

							<td>
							<input type="text" name='comments[]' class="form-control"/>
							</td>
							<td>
							<input type="text" name='source_ip[]' id='source_ip1' placeholder="test" class="form-control" onkeyup="ip_validate('source_ip1');" />
							</td>
							<td>
							<input type="text" name='destination_ip[]' onkeyup="ip_validate('destination_ip1')" id='destination_ip1' class="form-control"/>
							</td>
							<td>
							<input type="text" name='source_port[]' id='source_port1' onkeyup="port_validate('source_port1')" class="form-control"/>
							</td>
							<td>
							<input type="text" name='destination_port[]' id='destination_port1' onkeyup="port_validate('destination_port1')" class="form-control"/>
							</td> 
							<td>
								<select>
					      			<option>tcp</option>
					      			<option>udp</option>
					      		</select>
							</td>
							<td>
							<input type="text" name='flag[]' placeholder='Name' class="form-control"/>
							</td>
							<td>
								<select>
					      			<option>ACCEPT</option>
					      			<option>DROP</option>
					      		</select>
							</td>
							
						</tr>
						
	                    <tr id='addr1'></tr>
	                
					</tbody>
					   <button type="submit" class="btn btn-primary" id="submit-button">Save changes</button>

				</table>
						</div>
					</div>
					

			</form>

			</div>
		</div>
		<a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
	</div>

</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
     $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html(`<td>`+ (i+1) +`</td>
      	<td>
      		<select>
      			<option>INPUT</option>
      			<option>OUTPUT</option>
      			<option>FORWARD</option>
      		</select>
      	</td>
      	<td><input name='comments[]' type='text' class='form-control input-md' /> </td>
      	<td><input name='source_ip[]' type='text' class='form-control input-md' id='source_ip`+(i+1)+`' placeholder='test' onkeyup="ip_validate('source_ip`+(i+1)+`')"></td>
      	<td><input name='destination_ip[]' type='text' class='form-control input-md' id='destination_ip`+(i+1)+`' placeholder='test' onkeyup="ip_validate('destination_ip`+(i+1)+`')"></td>
      	<td><input name='source_port[]' type='text' class='form-control input-md' id='source_port`+(i+1)+`' onkeyup="port_validate('source_port`+(i+1)+`')" ></td>
      	<td><input name='destination_port[]' type='text' class='form-control input-md' id='destination_port`+(i+1)+`' onkeyup="port_validate('destination_port`+(i+1)+`')"></td>
      	<td>
      		<select>
      			<option>tcp</option>
      			<option>udp</option>
      		</select>
      	</td>
      	<td><input type="text" name='flag[]' placeholder='Name' class="form-control"/></td>
      	<td>
      		<select>
      			<option>ACCEPT</option>
      			<option>DROP</option>
      		</select>
      	</td>
    		`);

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});



     function ip_validate(source_ip) {
     	     	console.log(source_ip);
     	let ip = document.getElementById(source_ip);
     	let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;

     	let check_ip = pattern.test(ip.value);
     	console.log(check_ip)
        if(check_ip == false){
            console.log("In false")
            
        }
     }


     function port_validate(source_port) {
     	     	console.log(source_port);
     	let port = document.getElementById(source_port);
     	console.log(port.value);
     	if(port.value > 0 && port.value < 65536){
     		console.log("true");
     	}
        
        console.log("In false");
     }




</script>
@stop