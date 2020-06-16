@extends('layouts.main')
@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 -->

<style type="text/css">

  #heading {
    margin-right: 59%;
      padding-top: 12px;
      color: #17a2b8;
  }

  #heading1 {
    margin-right: 81%;
      padding-top: 12px;
      color: #17a2b8;
  }

  #add_row, #delete_row {
/*    padding-top: 22%;
*/  }

  #interfaces {
    border: 1px solid;
    margin-top: 1rem;
      margin-left: 1rem;
      margin-right: 1rem;
/*      height: 4rem;
*/  }

  h3 {
/*    padding-top: 8px;
      padding-left: 12px;
      height: 42px;*/
  }

  #esisting_interface {
      border: 1px solid gray;
        background: aliceblue;
        display: flex;
        justify-content: center;
        height: 4rem;
  }

  #interface_div {
    margin-left: 3%;
/*      padding-top: 19px;
      display: inline-block;
      overflow: hidden;
      width: 39%;*/

  }

  #select_template_label {
    padding-top: 2%;
      font-size: large;
  }

  #custome_container {
    display: flex;
      justify-content: center;
      margin-right: 54%;
      padding-top: 1%;
  }

  #button_container {
    display: flex;
      justify-content: center;
  }

  #heading {
/*    margin-right: 82rem !important
*/  }

  #add_row {
/*    margin-top: 2rem !important
*/  }

  #template_name_div {
    padding-top: 2rem;
  }

  #template_name {
    width: 28rem !important;
    color: green;
  }

  #table_footer {
/*    border: 1px solid gray;
      background: aliceblue;
      display: flex;
      justify-content: right;*/
  }

  #submit-button {
/*    margin-top: 1rem;
      margin-bottom: 1rem;
      margin-left: auto;
      margin-right: 2rem;*/

  }

  .custome_dropdown {
    /*display: flex;
      justify-content: center;*/

    border: white;
      background-color: white;
      margin-top: 11%;
  }

  #interface {
      width: 35%;
      height: 40px;
      border: 0px;
      outline: none;
/*      border-radius: 29rem;
*/      background-color: #e9ecef;
      color: green;
  }

  .button_align {
/*    margin-left: 3%;
      width: 14%;
      margin-top: 3%;
      margin-bottom: 2%;*/
  }

  .delete_button_align {
/*    margin-left: 6%;
      width: 14%;
      margin-top: 3%;
      margin-bottom: 2%;*/
  }

  .modal-content {
/*    margin-top: 10%;
*/  }



  #error_template_name, #error_template_re_name {
    color: red !important;
  }

  #valid_template_name, #valid_template_re_name {
    color: green !important;
  }

  #custome_submit_div {
    margin-left: 80%;
  }

  #add_customerow {
    margin-left: 2%;
  }

  #th1, #th2, #th3, #th4,#th5, #th6, #th7, #th8, #th9 {
    width: 8.3rem;
    text-align: center;

  }

  #custome_table_headers {
    box-sizing: content-box !important;
  }

  #custome_table_2, #templateViewTable {
    background-color: white;
  }
  
  #repo_block {
    background-color: slategrey;
  }



  #table {
    margin-left: 2%;
    margin-right: 2%;
  }

  .table td {
    width: 8.3rem;
  }

  #custome_table_2 td {
    /*width: 8.3rem;*/
  }

  #template_view_main_div {
    /*width: 86.4%;*/
  }

  #message_update_success {
    margin-left: 38%;
    color: green;
    padding-top: 1%
  }

  .source-error {
    color: red !important;
  }

  #data_validate {
    margin-left: 44%;
      font-size: larger;
  }

  #save_rules {
/*    padding-top: 22%;
*/    margin-right: 13%;
    color: green;
  }

  #add_row {
    color: blue;
  }

  #add_row:hover {
    color: white;
  }

  #save_rules:hover {
    color: white;
  }

  #delete_row {
    color: red;
  }

  #delete_row:hover {
    color: white
  }

  .btn-custome-class {
      font-weight: 500;
      margin-right: 2%;
  }

  .view-size-custome {
    height: 36px;
    width: 73px;
    padding-right: 10px
  }

  #template_view_button_div {
    margin-top: 0.5%; 
    margin-right: 2%;
    width: 20%;
  }

#footer_table {
    margin-left: 82%;
    margin-bottom: 1%;
    margin-top: 2%;
  }



  @media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

  /* Force table to not be like tables anymore */
  table, thead, tbody, th, td, tr { 
    display: block; 
  }
  
  /* Hide table headers (but not display: none;, for accessibility) */
  thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  
  tr { border: 1px solid #ccc; }
  
  td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
  }

  #template_name {
    width: auto !important;
  }

  #custome_container {
    display: flex;
    justify-content: center;
    margin-right: 0% !important;
  }

  #esisting_interface {
    border: 1px solid gray;
    background: aliceblue;
    justify-content: center;
    display: block;
    height: 12rem
  }


  

  @media only screen and (max-width: 1400px) {
    #template_view_button_div {
      width: 100% !important;
    }
  }

  @media only screen and (max-width: 648px) {
    #esisting_interface {
      border: 1px solid gray;
      background: aliceblue;
      justify-content: center;
      display: block;
      height: 9rem;
    }
  }

  @media only screen (min-width: 1024px) and (max-width: 1396px){
    #template_view_button_div {
      margin-top: 0.5%;
      margin-right: 3%;
      width: 100%;
  }

  #esisting_interface {
      border: 1px solid gray;
      background: aliceblue;
      display: flex;
      justify-content: center;
      height: 5rem;
  }
  }



}




</style>
<div id="interfaces">
  <div id="esisting_interface">
    <h3 id="heading">Available Templates</h3>
    <div id="template_view_button_div">
      <button type="submit" class="btn btn-outline-success fa fa-pencil button_align btn-custome-class" onclick="rename();" data-toggle="modal"  data-target="#templateModal" style="box-shadow: 0px 0px 6px #212529; border-radius: 12px; margin-top: 5px;">Rename</button>
      <button type="submit" class="btn btn-outline-danger delete_button_align btn-custome-class" onclick="delete_template();" data-toggle="modal" data-target="#deleteModal" style="border-radius: 12%; box-shadow: 0px 0px 6px #212529; margin-top: 5px;"><span class="fa fa-trash"></span>Delete</button>
      <button type="submit" class="btn btn-outline-primary delete_button_align btn-custome-class view-size-custome" onclick="view();" style="box-shadow: 0px 2px 6px #212529; border-radius: 12%; margin-top: 5px;"><span class="fa fa-eye"></span>View</button>

<!--          <a id='rename_template' class="btn"><span class="fa fa-pencil" style="color: green  " onclick="rename();" data-toggle="modal"  data-target="#templateModal">Rename</span>
      <a id="delete_template" class="btn"><span class="fa fa-trash" style="color: red" data-toggle="modal" data-target="#deleteModal" onclick="delete_template();">Delete</span></a>
      <a id='view_template' class="btn"><span class="fa fa-eye" style="color: blue" onclick="view();">View</span></a>
 -->  </div>

  </div>

@include('sweet::alert')
  <div id='interface_div'>
    <label id="select_template_label" for="interface">Select Template</label>
    <br>
    <select name="templates" id="interface" onchange="view();">
      @foreach($final_template as $temp)
    
      <option>{{ $temp }}</option>
      <?php $temp_id = $temp ?>
      @endforeach


    </select>
          
  </div>

  
  
<!--  <div>
    <button type="submit" class="btn btn-success fa fa-pencil button_align" onclick="rename();" data-toggle="modal" data-target="#templateModal" >Rename</button>
    <button type="submit" class="btn btn-danger delete_button_align" onclick="delete_template();" data-toggle="modal" data-target="#deleteModal"><span class="fa fa-trash"></span>Delete</button>
    
    <button type="submit" class="btn btn-primary delete_button_align" onclick="view();">View</button>
  </div> -->



  <!-- Editable table -->

<!-- <div class="card">
 -->
 <div>  
 <div id="message_update_success"></div>
  <!-- <div class="card-body"> -->
    <div id="table" class="table-editable">
  <form id="rule_update_form" method="POST" action="rules_update">
    <div class="card mb-3" id="template_view_main_div">
      <div class="card-header" id="card_header_div">
<!--         <h5 class="m-0 text-info font-weight-bold">Hide Rules</h5>
 -->     

    <div style="display: flex;">   
        <div id="add_customerow"></div>
        
        <div id="custome_submit_div"></div>
    </div>
      </div>
<!--       <div class="card-body" id="repo_block">
 -->    <div id="custome_table_headers">
      <table id='custome_table_2' class="table table-striped table-bordered table-hover" style="width:100%">
        <tr>
          <th id="th1">Chain</th>
          <th id="th2">Comments</th>
          <th id="th3">Source Ip</th>
          <th id="th4">Destination Ip</th>
          <th id="th5">Source Port</th>
          <th id="th6">Destination Port</th>
          <th id="th7">Protocol</th>
          <th id="th8">Flags</th>
          <th id="th9">Action</th>
          <th>Remove Row</th>
        </tr>
        <tbody>
           <tr id="custome_addr1"></tr>
        </tbody>
      </table>
      <div id="templateViewTable"></div>
    </div>
  <!-- </div> -->
</div>
<!--         <div id="templateViewTable"></div>
 -->        <!-- <div id="custome_submit_div"></div> -->
        <input type="hidden" id="info"/>
      </form>      

    </div>
  <!-- </div> -->
</div>
<!-- Editable table -->
   


    
</div>
  <br><br>
<div id="interfaces">
  <div id='esisting_interface'>
<!--    <div id="custome_container">
      <h3 id="heading1">Add New Template</h3>

    </div>
    <div id='button_container'> -->



      <!-- <button type="button" onclick="validate_rules_form();" class="btn btn-primary" id="submit_button">Save changes</button> -->
<!--      <a id='save_rules' class="btn"><span class="fa fa-save" onclick="validate_rules_form();" data-toggle="tooltip" data-original-title="Save Template"></span>
      <a id="add_row" class="btn"><span class="fa fa-plus" data-toggle="tooltip" data-original-title="Add Row"></span></a>
      <a id='delete_row' class="btn"><span class="fa fa-minus" data-toggle="tooltip" data-original-title="Remove Row"></span></a> -->
<!--      -------------------------------------------------------------------------------------------
 -->
<!--  <button type="submit" id='save_rules' class="btn btn-outline-success button_align" onclick="validate_rules_form();" style="box-shadow: 0px 0px 6px #212529; border-radius: 12px; width: 132px;     height: 41px; margin-right: 2%; margin-top: 9px; padding-left: 5px;"><span class="fa fa-save" style="margin-right: 3px"></span>Save Template</button>
 
    <button type="submit" id="add_row" class="btn btn-outline-primary" style="border-radius: 12%; box-shadow: 0px 0px 6px #212529; width: 132px; height: 41px; margin-right: 2%; margin-top: 9px; padding-left: 5px;"><span class="fa fa-plus" style="margin-right: 3px"></span>Add Row</button>
    
    <button type="submit" id='delete_row' class="btn btn-outline-dangert" style="box-shadow: 0px 2px 6px #212529; border-radius: 12%; width: 132px; height: 41px; margin-right: 2%; margin-top: 9px; padding-left: 5px;"><span class="fa fa-trash" style="margin-right: 3px"></span>Remove Row</button> -->

  <!--  </div> -->

<h3 id="heading1">Add New Template</h3>
<!-- <div id="template_view_button_div">

      <button type="submit" class="btn btn-outline-success fa fa-pencil button_align btn-custome-class"  id='save_rules' onclick="validate_rules_form();" style="box-shadow: 0px 0px 6px #212529; border-radius: 12px; margin-top: 5px;">Save</button>
      <button type="submit" id="add_row" class="btn btn-outline-primary delete_button_align btn-custome-class fa fa-plus" style="border-radius: 12%; box-shadow: 0px 0px 6px #212529; margin-top: 5px;">Row</button>
      <button type="submit" class="btn btn-outline-danger fa fa-minus delete_button_align btn-custome-class" id='delete_row' style="box-shadow: 0px 2px 6px #212529; border-radius: 12%; margin-top: 5px;"> Row</button>

  </div> -->


  </div>
  

    

<!--  <div class="container">
 --><!--      <div class="row clearfix">
 -->      
        <div class="col-md-12 column">
        <form method="POST" action="/add_templates" enctype="multipart/form-data" id="rules_form">
          @csrf
          <div id="main">
              <div class="form-group row" id="template_name_div">
                <label class="col-sm-2 col-form-label">Template Name:</label>
                  <div class="col-sm-10">
                    <input type="text" id='template_name' name="template_name" class="form-control" onkeyup="temp_name_check();">
                    <div id="error_template_name"></div>
                    <div id="valid_template_name"></div>
                  </div>
              </div>
              <div id="data_validate"></div>

            <div>
        <table class="table table-bordered table-hover" id="tab_logic">
                
          <thead style="background-color: #dee2e6;">
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
              <th class="text-center" id="remove_row">Remove Row
              </th>
            </tr>
          </thead>
          
          <tbody>
            <tr id='addr0'>
              <td>
              <?php $i = 1 ?>
              {{$i}}
              </td>
              <td>
                    <select name="chain[]" class="custome_dropdown">
                      <option value="INPUT">INPUT</option>
                      <option value="OUTPUT">OUTPUT</option>
                      <option value="FORWARD">FORWARD</option>
                    </select>
                  </td>

              <td>
              <input type="text" name='comments[]' class="form-control" placeholder="comments" />
              </td>
              <td>
              <input type="text" name='source_ip[]' id='source_ip1' class="form-control" placeholder="0.0.0.0" onkeydown="table_input_ip_validate(source_ip1, error_source_ip)" onkeydown="source_ip_validation_1(source_ip1)" onkeyup="source_ip_validate('source_ip1', 'error_source_ip', 'valid_source_ip');" />
              <div id="error_source_ip">
              </div>
              <div id="valid_source_ip"></div>

              </td>
              <td>
              <input type="text" name='destination_ip[]' id='destination_ip1' placeholder="0.0.0.0" onkeydown="table_input_ip_validate(destination_ip1, error_destination_ip)" onkeydown="destination_ip_validation_1('destination_ip1', 'error_destination_ip')" onkeyup="destination_ip_validate('destination_ip1', 'error_destination_ip', 'valid_destination_ip')" class="form-control"/>
              <div id="error_destination_ip"></div>
              <div id="valid_destination_ip"></div>
              </td>
              <td>
              <input type="text" name='source_port[]' id='source_port1' placeholder="0-65535" onkeydown="table_input_port_validate(source_port1, error_source_port)" onkeyup="source_port_validate('source_port1', 'error_source_port', 'valid_source_port');" class="form-control" value="" />
              <div id="error_source_port"></div>
              <div id="valid_source_port"></div>
              </td>
              <td>
              <input type="text" name='destination_port[]' id='destination_port1' placeholder="0-65535" onkeydown="table_input_port_validate(destination_port1, error_destination_port)" onkeyup="destination_port_validate('destination_port1', 'error_destination_port', 'valid_destination_port')" class="form-control" />
              <div id="error_destination_port"></div>
              <div id="valid_destination_port"></div>
              </td> 
              <td>
                <select name="protocol[]" class="custome_dropdown" onchange="restrict_flag(this, 'flag1');">
                      <option value="tcp">tcp</option>
                      <option value="udp">udp</option>
                      <option value="icmp">icmp</option>
                      <option value="*">*</option>
                    </select>
              </td>
              <td>
              <input type="text" name='flag[]' id='flag1' onkeyup="flag_validation('flag1', 'flag_success_message', 'flag_error_message');" placeholder="ACK, SYN, FIN, URG, PSH, RST" class="form-control"/>
              <div id="flag_success_message"></div>
              <div id="flag_error_message"></div>
              </td>
              <td>
                <select name="actions[]" id="actions1" class="custome_dropdown">
                      <option>ACCEPT</option>
                      <option>DROP</option>
                    </select>
              </td>
              <td><button type="button" style="background-color: red; border: none;" class="btn btn-secondary fa fa-trash" disabled></button></td>
              
            </tr>
            <tr id='addr1'></tr>
          </tbody>
        </table>

        <div id="footer_table">
          <button type="button" class="btn btn-outline-success fa fa-pencil button_align btn-custome-class"  id='save_rules' onclick="validate_rules_form();" style="box-shadow: 0px 0px 6px #212529; border-radius: 12px; margin-top: 5px;">Save</button>

          <button type="button" id="add_row" class="btn btn-outline-primary delete_button_align btn-custome-class fa fa-plus" style="border-radius: 12%; box-shadow: 0px 0px 6px #212529; margin-top: 5px;">Row</button>
        </div>
            </div>
          </div>

      </div>
<!--    </div>
 -->  </div>


    </form>

<!-- </div>
 -->

  <!-- Modal -->
<div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Rename Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div class="modal-body">
          <form method="POST" action="/update_template" id="rename_form">
        @csrf
            <label>Old Name</label>
            <input type="text" class="form-control" id="dropdown_name" value="" name="old_name" readonly />
            <br><br>
            <label>New Name</label>
            <input type="text" name="new_name" id="template_re_name" class="form-control" value="" />
            <div id="error_template_re_name"></div>
            <div id="valid_template_re_name"></div>
            <input type="hidden" name="id" id="dropdown_id" value="">
            
          </form>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>

          <button type="button" onclick="submitform();" class="btn btn-success" data-dismiss="modal" >Rename</button>
        </div>

    </div>
  </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Are You Sure ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div>
          <form method="POST" action="/delete_template" id="delete_form">
        @csrf
            
            <input type="hidden" name="id" id="dropdown_delete_id" value="">
            
          </form>
          <div class="modal-footer">
            <button type="button" onclick="submit_delete_form();" class="btn btn-danger fa fa-trash delete_modal_button1" data-dismiss="modal" >Yes</button>
            <button type="button" class="btn btn-secondary fa fa-cross " id='delete_modal_button2' data-dismiss="modal" >Cancel</button>
          </div>
        </div>
    </div>
  </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
    document.getElementById('custome_table_2').style.visibility = "hidden";
    document.getElementById('template_view_main_div').style.display = "none";

    function temp_name_check () {
      document.getElementById('error_template_name').innerHTML = "";
    }
    

    var port_index = 0;

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip({
          placement : 'top'
      });
  });

     $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html(`<td>`+ (i+1) +`</td>
        <td>
          <select name="chain[]" class="custome_dropdown">
            <option>INPUT</option>
            <option>OUTPUT</option>
            <option>FORWARD</option>
          </select>
        </td>
        <td><input name='comments[]' type='text' class='form-control input-md' placeholder="comments" /> </td>
        <td><input name='source_ip[]' type='text' class='form-control input-md' placeholder="0.0.0.0" id='source_ip`+(i+1)+`' onkeydown="table_input_ip_validate(source_ip`+(i+1)+`, error_source_ip`+(i+1)+`)" onkeyup="source_ip_validate('source_ip`+(i+1)+`', 'valid_source_ip`+(i+1)+`', 'error_source_ip`+(i+1)+`')">
          <div id="error_source_ip`+(i+1)+`"></div>
          <div id="valid_source_ip`+(i+1)+`"></div>
        </td>
        <td><input name='destination_ip[]' type='text' class='form-control input-md' placeholder="0.0.0.0" id='destination_ip`+(i+1)+`' onkeydown="table_input_ip_validate(destination_ip`+(i+1)+`, error_destination_ip`+(i+1)+`)" onkeyup="destination_ip_validate('destination_ip`+(i+1)+`', 'valid_destination_ip`+(i+1)+`', 'error_destination_ip`+(i+1)+`')">
          <div id="error_destination_ip`+(i+1)+`"></div>
          <div id="valid_destination_ip`+(i+1)+`"></div>
        </td>
        <td><input name='source_port[]' type='text' placeholder="0-65535" class='form-control input-md' id='source_port`+(i+1)+`' onkeydown="table_input_port_validate(source_port`+(i+1)+`, error_source_port`+(i+1)+`)" onkeyup="source_port_validate('source_port`+(i+1)+`', 'valid_source_port`+(i+1)+`', 'error_source_port`+(i+1)+`')" >
          <div id="error_source_port`+(i+1)+`"></div>
          <div id="valid_source_port`+(i+1)+`"></div>
        </td>
        <td><input name='destination_port[]' type='text' placeholder="0-65535" class='form-control input-md' id='destination_port`+(i+1)+`' onkeydown="table_input_port_validate(destination_port`+(i+1)+`, error_destination_port`+(i+1)+`)" onkeyup="destination_port_validate('destination_port`+(i+1)+`', 'valid_destination_port`+(i+1)+`', 'valid_destination_port`+(i+1)+`')">
          <div id="error_destination_port`+(i+1)+`"></div>
      <div id="valid_destination_port`+(i+1)+`"></div
        </td>
        <td>
          <select name="protocol[]" onchange="restrict_flag(this, 'flag`+(i+1)+`');" class="custome_dropdown">
            <option>tcp</option>
            <option>udp</option>
            <option>icmp</option>
            <option>*</option>
          </select>
        </td>
        <td><input type="text" name='flag[]' id='flag`+(i+1)+`' onkeyup="flag_validation('flag`+(i+1)+`', 'flag_success_message`+(i+1)+`', 'flag_error_message`+(i+1)+`');" placeholder="ACK, SYN, FIN, URG, PSH, RST" class="form-control"/>
          <div id="flag_success_message`+(i+1)+`"></div>
          <div id="flag_error_message`+(i+1)+`"></div>
        </td>
        <td>
          <select name="actions[]" id="actions`+(i+1)+`" class="custome_dropdown">
            <option>ACCEPT</option>
            <option>DROP</option>
          </select>
        </td>
        <td><button type="button" style="background-color: red; border: none;" class="btn btn-secondary fa fa-trash" onclick="del_row(this);""></button></td>
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



     function del_row(btn) {
  
      var row = btn.parentNode.parentNode;
      row.parentNode.removeChild(row);
     }

     // function drop_color_change(action_id, row_number){
     //   console.log(action_id)
     //   let action_value = document.getElementById(action_id).value;
     //   let table = document.getElementById('tab_logic');
     //    let row = table.getElementsByTagName("tr");
     //   // console.log(table)
     //   // console.log(row[3])
     //   // let row = document.getElementsById(row_number);
     //   // return false;

     //   for (i =1; i <= row.length; i++){
     //     console.log(row)
     //     if(action_value == 'DROP'){
     //       row[i].style.backgroundColor = "green";
     //       return false;
     //     }
     //     row[i].style.backgroundColor = "white";
     //   }
      
     //   // if(check_value == 'DROP'){

     //   // }
     //   // console.log(action_value)
     // }

     function source_ip_validate(source_ip, success_id, error_id) {
 
      let ip = document.getElementById(source_ip);
      let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;

      let check_ip = pattern.test(ip.value);
      console.log(check_ip)
        if(check_ip == false){
           document.getElementById(success_id).innerHTML = " "
           document.getElementById(error_id).innerHTML = "<span style='color: red !important;' id='error_sub_source_ip'>Enter Valid Ip</span>"
           // document.getElementById('error_sub').value = 1;
           // e.preventDefault()
           return false;
        }
           document.getElementById(error_id).innerHTML = " "
           document.getElementById(success_id).innerHTML = "<span style='color: green !important;'>Great</span>"
           document.getElementById(error_id).innerHTML = "<span id='error_sub_source_ip'></span>"
           // document.getElementById('error_sub').value = 0;


     }

     function destination_ip_validate(source_ip, success_id, error_id) {
            console.log(source_ip);
      let ip = document.getElementById(source_ip);
      let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;

      let check_ip = pattern.test(ip.value);
      console.log(check_ip)
        if(check_ip == false){
          document.getElementById(success_id).innerHTML = " "
           document.getElementById(error_id).innerHTML = "<span style='color: red !important;' id='error_sub_destination_ip'>Enter Valid Ip</span>"
           // e.preventDefault()
           return false;
        }
           document.getElementById(error_id).innerHTML = " "
           document.getElementById(success_id).innerHTML = "<span style='color: green !important;'>Great</span>"
           document.getElementById(error_id).innerHTML = "<span id='error_sub_destination_ip'></span>"

     }


     // function source_port_validate(source_port) {
     //         console.log(source_port);
     //   let port = document.getElementById(source_port);
     //   console.log(port.value);
     //   if(port.value > 0 && port.value < 65536){
     //     console.log("true");
     //     document.getElementById('error_source_port').innerHTML = " "
     //     ev.preventDefault()
     //   }
     //    document.getElementById('error_source_port').innerHTML = "Enter valid Port number"
     //    console.log("In false");
     // }


     function source_port_validate(source_port, success_id, error_id) {
            // console.log(source_port);
            // console.log(port_index)
      let port = document.getElementById(source_port).value;
      // if(!port.match(/^\d+$/)){
      //  console.log("enter only numbers");
      // }
      
      let pattern = /^[0-9,.*]+$/g;
      let check = pattern.test(port);
      console.log(check);

      if( check == false){
        document.getElementById(success_id).innerHTML = ' ';
        document.getElementById(error_id).innerHTML = "<span style='color: red !important;' id='error_sub_source_port'>"+ port + "Not allowed</span>";
        let ch = document.getElementById('error_source_ip').innerHTML;
      console.log(ch)

        return false;
      }
      document.getElementById(error_id).innerHTML = ' ';
      document.getElementById(success_id).innerHTML = "<span style='color: green !important;'>Great</span>";
      document.getElementById(error_id).innerHTML = "<span style='color: red !important;' id='error_sub_source_port'></span>";

      

     }



     // function destination_port_validate(source_port) {
     //         console.log(source_port);
     //   let port = document.getElementById(source_port);
     //   console.log(port.value);
     //   if(port.value > 0 && port.value < 65536){
     //     console.log("true");
     //     document.getElementById('error_destination_port').innerHTML = " "
     //     ev.preventDefault()
     //   }
     //    document.getElementById('error_destination_port').innerHTML = "Enter valid Port number"
     //    console.log("In false");
     // }


     function destination_port_validate(source_port, success_id, error_id) {
      let port = document.getElementById(source_port).value;
      let pattern = /^[0-9,.*]+$/g;
      let check = pattern.test(port);
      console.log(check);

      if( check == false){
        document.getElementById(success_id).innerHTML = ' ';
        document.getElementById(error_id).innerHTML = "<span style='color: red !important;' id='error_sub_destination_port'>"+ port + "Not allowed</span>";
        return false;
      }
      document.getElementById(error_id).innerHTML = ' ';
      document.getElementById(success_id).innerHTML = "<span style='color: green !important;'>Great</span>";
      document.getElementById(error_id).innerHTML = "<span style='color: red !important;' id='error_sub_destination_port'></span>";

     }

     function flag_validation(flag_id, success_id, error_id) {
      let error = document.getElementById(error_id);
      let success = document.getElementById(success_id)
      let flag_value = document.getElementById(flag_id).value;
      if(flag_value == 'ACK' || flag_value == 'SYN' || flag_value == 'FIN' || flag_value == 'PSH' || flag_value == 'RST' || flag_value == 'URG'){
        error.innerHTML = "";
        success.innerHTML = "<span style='color: green !important;'>Great</span>";
        error.innerHTML = "<span style='color: red !important;' id='error_sub_flag'></span>";
      }else{
         error.innerHTML = "<span style='color: red !important;' id='error_sub_flag'>Enter Valid Flag</span>";
        success.innerHTML = "";
      }
     }


  function rename(){
    let dropdown = document.getElementById('interface');
    let id = dropdown.options[dropdown.selectedIndex].value;
    let old_name = dropdown.options[dropdown.selectedIndex].text;
    document.getElementById('dropdown_name').value = old_name;
    document.getElementById('dropdown_id').value = id;

  }

  function submitform(){
    $('#rename_form').submit()
  }

  function delete_template(){
    let dropdown = document.getElementById('interface');
    let id = dropdown.options[dropdown.selectedIndex].value;
    document.getElementById('dropdown_delete_id').value = id;

  }

  function submit_delete_form(){
    $('#delete_form').submit()
  }

  function validate_rules_form(){
    let template_name = document.getElementById('template_name').value;

    if(template_name == '' || template_name == null){
      document.getElementById("error_template_name").innerHTML = "<span style='color: red !important;'>Name is Mendatory !!!</span>";
      return false;
    }
    $('#rules_form').submit()

  }

  function view(){
    document.getElementById("templateViewTable").innerHTML = "";
    document.getElementById("custome_submit_div").innerHTML = "";
    document.getElementById("add_customerow").innerHTML = "";
    document.getElementById('custome_table_2').style.visibility = "visible";
    document.getElementById('template_view_main_div').style.display = "block";
    let dropdown = document.getElementById('interface');
    // let id = dropdown.options[dropdown.selectedIndex].value;
    let name = dropdown.options[dropdown.selectedIndex].text;
    // document.getElementById('view_input').value = name;

    console.log(name)
    // document.getElementById('dropdown_id').value = id;
    let response_data = "";
        $.ajax({
                url: '/template_view',
                type: 'POST',
                data: { 
                  "_token": "{{ csrf_token() }}", 
                  "name": name 
                }


            }).done(function(response){
              
            

        let lines = response.split("\n");
        // response_data = lines;
         console.log(lines)


        let result = [];
        for(let j = 0; j<lines.length; j++){
           result[j] = lines[j].split('|');
          
        }

        response_data = result;



          var myTableDiv = document.getElementById("templateViewTable");

          var table = document.createElement('TABLE');
          // table.border = '1';
          table.id = 'custome_table';
          table.style = 'text-align: center';
          table.setAttribute('class', 'table table-bordered table-hover');



          

        // var btn = document.createElement("BUTTON");


          var tableBody = document.createElement('TBODY');
          table.appendChild(tableBody);

          var td_id = 0;

          for (var k = 0; k < lines.length; k++) {

            var btn_remove = document.createElement('input');
            // var btn_add = document.createElement('input');
          btn_remove.type = "button";
          btn_remove.className = "btn";
          btn_remove.value = "Remove";
          // btn_remove.style = "background-color: red; color: white";
          btn_remove.id = 'customebtn' + k;
          // btn_remove.setAttribute('style', 'margin-top: 14px');
          btn_remove.setAttribute('class', 'btn btn-secondary');
          btn_remove.setAttribute('style', 'background-color: red; border: none; margin-top: 4px;');

          // btn_remove.setAttribute('style', 'box-shadow: 0px 3px 6px #212529; margin-top: 14px; border-radius: 6%');
          // btn_remove.class = "btn-danger";
          // btn_remove.onclick = "remove_row("+ k +")";
          btn_remove.addEventListener ("click", function() {
            this.closest('tr').remove()
            // console.log(k);
          });

          // btn_add.type = "button";
          // btn_add.className = "btn";
          // btn_add.value = "Add Row";

          // btn_add.id = 'custome_add_btn' + k;

          // btn_add.addEventListener ("click", function() {
          //  addRow();
          // });

            var tr = document.createElement('TR');
            tableBody.appendChild(tr);

            var option = document.createElement('option');
            
            // tableBody.appendChild(row);

            for (var m = 0; m < 9; m++) {
              var td = document.createElement('TD');
              // td.addEventListener ("dblclick", function(event) {
              //  // prompt(event.listner)
              //  console.log(event.listner)
              // })

              td.width = '100';
              td.setAttribute('contenteditable', true);
              td.setAttribute('id', td_id)

              // if (m == 0) {
              //  var z = document.createElement('select');
              //  // z.createElement('option');
              //  td.appendChild(z)
              // }

              
              td.appendChild(document.createTextNode(result[k][m]));
              tr.appendChild(td);
              // td.appendChild(btn);
              td_id++;


            }
            tr.appendChild(btn_remove);
            // tr.appendChild(btn_add);
              // tr.appendChild(btn);

            // tr.appendChild(btn);
            // tr.appendChild(btn);
          }
          myTableDiv.appendChild(table);


            });

            var button_custome_row = document.createElement("input");
            var custome_button_div = document.getElementById("add_customerow");
            button_custome_row.type = "button";
            button_custome_row.className = "btn";
            button_custome_row.value = "Add Row";
            button_custome_row.setAttribute('class', 'btn btn-outline-info btn-rounded waves-effect ');
      // button_custome_row.setAttribute('style', 'width:10%');
      // button_custome_row.setAttribute('style', 'border-radius: 16px');
      button_custome_row.setAttribute('style', 'box-shadow: 0px 3px 6px #212529; border-radius: 16px; width: 100%');
            // button_custome_row.setAttribute('style', 'class:fa fa-plus');
            custome_button_div.appendChild(button_custome_row);
            custome_button_div.addEventListener("click", function() {
              addRow();
            });

            var submit_button = document.createElement("input");
            var button_div = document.getElementById("custome_submit_div");
            submit_button.type = "button";
      submit_button.className = "btn";
      submit_button.value = "Update";
      submit_button.setAttribute('id', 'custome_update');
      submit_button.setAttribute('class', 'btn btn-outline-success btn-rounded waves-effect');
      // submit_button.setAttribute('style', 'width:10%');
      // submit_button.setAttribute('style', 'border-radius: 16px');
      submit_button.setAttribute('style', 'box-shadow: 0px 3px 6px #212529; border-radius: 16px; width:100%');
      button_div.appendChild(submit_button);
      button_div.addEventListener("click", function(){
        submit_custome_update();
      });

      setTimeout(() => {
              addSelect(response_data);
          }, 500)

          setTimeout(() => {
            add_protocol_dropdown(response_data);
            add_action_dropdown(response_data);
          }, 500)

            setTimeout(() => {
            CountRows()
              
        }, 5000)

        
            
            
        }

        let m = 0;

        function drop() {
          document.getElementById('0').addEventListener("dblclick", function(){
            addSelect();
          });
        }

        let j = 0;  
        let k = 0;
        let o = 8;
        let n = 6;

        function addSelect(response_data) {
          // document.getElementById("0").innerHTML =" ";
          console.log(response_data[0][0])

      var x = document.getElementById("custome_table").rows.length;
      for(i = 0; i < x; i++){

        var select = document.createElement("select");
        select.setAttribute("name", "source_ip" + i);
        select.setAttribute("id", "source_ip" + i);
        select.setAttribute("class", "custome_dropdown");
        
        option = document.createElement("option");
        option.setAttribute("value", response_data[i][0]);
        option.innerHTML = response_data[i][0];
        select.appendChild(option);

        if(response_data[i][0] == 'INPUT'){
          option = document.createElement("option");
          option.setAttribute("value", "OUTPUT");
          option.innerHTML = "OUTPUT";
          select.appendChild(option);

          option = document.createElement("option");
          option.setAttribute("value", "FORWARD");
          option.innerHTML = "FORWARD";
          select.appendChild(option);
        }

        if(response_data[i][0] == 'OUTPUT'){
          option = document.createElement("option");
          option.setAttribute("value", "INPUT");
          option.innerHTML = "INPUT";
          select.appendChild(option);

          option = document.createElement("option");
          option.setAttribute("value", "FORWARD");
          option.innerHTML = "FORWARD";
          select.appendChild(option);
        }

        if(response_data[i][0] == 'FORWARD'){
          option = document.createElement("option");
          option.setAttribute("value", "INPUT");
          option.innerHTML = "INPUT";
          select.appendChild(option);

          option = document.createElement("option");
          option.setAttribute("value", "OUTPUT");
          option.innerHTML = "OUTPUT";
          select.appendChild(option);
        }

        
        // console.log(i)
        
      

        document.getElementById(k).innerHTML =" ";
          document.getElementById(k).appendChild(select);
          k = k + 9;




      }
    }

    function add_protocol_dropdown(response_data){
    var x = document.getElementById("custome_table").rows.length;
      for(i = 0; i < x; i++){

        console.log(response_data)
        var select = document.createElement("select");
        select.setAttribute("name", "protocol" + i);
        select.setAttribute("id", "protocol" + i);
        select.setAttribute("class", "custome_dropdown");
        
        option = document.createElement("option");
        option.setAttribute("value", "tcp");
        option.innerHTML = response_data[i][6];
        select.appendChild(option);

        option = document.createElement("option");
        option.setAttribute("value", "udp");
        option.innerHTML = "udp";
        select.appendChild(option);

        option = document.createElement("option");
        option.setAttribute("value", "icmp");
        option.innerHTML = "icmp";
        select.appendChild(option);

        option = document.createElement("option");
        option.setAttribute("value", "*");
        option.innerHTML = "*";
        select.appendChild(option);
        
        
         
        document.getElementById(n).innerHTML =" ";
        document.getElementById(n).appendChild(select);
        n = n + 9;
      } 
    }

    function add_action_dropdown(response_data){
      var x = document.getElementById("custome_table").rows.length;
      for(i = 0; i < x; i++){

        var select = document.createElement("select");
        select.setAttribute("name", "action" + i);
        select.setAttribute("id", "action" + i);
        select.setAttribute("class", "custome_dropdown");
        
        option = document.createElement("option");
        option.setAttribute("value", "ACCEPT");
        option.innerHTML = response_data[i][8];
        select.appendChild(option);

        if(response_data[i][8] == 'ACCEPT'){
          option = document.createElement("option");
          option.setAttribute("value", "DROP");
          option.innerHTML = "DROP";
          select.appendChild(option);
        }
        else{
          option = document.createElement("option");
          option.setAttribute("value", "ACCEPT");
          option.innerHTML = "ACCEPT";
          select.appendChild(option);
        }

        
        
        
         
        document.getElementById(o).innerHTML =" ";
        document.getElementById(o).appendChild(select);
        o = o + 9;
      } 
    }
        

        function submit_custome_update(){

          document.getElementById('info').innerHTML = "";
          var myTab = document.getElementById('custome_table');
          var tabRow = document.getElementById('custome_table').rows;
          var result = [];
          var data = [];
          var k = 0;
          // console.log(myTab.rows.length)


          let row_length = myTab.rows.length;
          for(let i = 0; i < row_length; i++){

               var row = myTab.rows.item(i).cells;
              let allData = '';

                // console.log(row)
               for(let j = 0; j < row.length; j++){
                console.log("index :", j);
                let final_data;
                let select_data = row[j].getElementsByTagName("select")
                console.log(select_data)


                if(select_data.length > 0){
                  console.log("here")
                  let id = select_data[0].getAttribute("id");
                  final_data = document.getElementById(id).value;
                  console.log(final_data)
                }
                else{
                  final_data = row[j].innerHTML;
                  console.log("final");
                  console.log(final_data)
                }

                if(j == 0 || j == row.length ){
              
            allData = allData + final_data
          }
          else{
            allData = allData + '|' + final_data
          }

                // console.log(final_data)

                // console.log(row[j])
                // console.log(row[1].innerHTML)


                // if(j == 0 ){
                //  tempData = document.getElementById(`source_ip${j}`).value
                //  allData = allData + tempData
                // }

                // if(j == 6 ){
                //  tempData = document.getElementById(`protocol${j}`).value
                //  allData = allData + '|' + tempData
                // }
                // if(j == row.length){
                //  tempData = document.getElementById(`action${j}`).value
                //  allData = allData + tempData
                // }
                // else{
                //  allData = allData + '|' + row[j].innerHTML
                // }
                // let temp_data = row[0].innerHTML;
                 
                // let val = document.getElementById(select_data).value;
          // console.log(val)

            // if(j == 0 || j == row.length ){
            //  if(tabRow.nodeName === "SELECT"){
            //    console.log("IN IF")
            //  }
              
            //  allData = allData + row[j].innerHTML
            // }
            // else{
            //  allData = allData + '|' + row[j].innerHTML
            // }
                 
                // console.log(allData)
               }

                data.push(allData)


           // var cellLength = row.length;

          }
          // console.log(data)

      let dropdown = document.getElementById('interface');
      // let id = dropdown.options[dropdown.selectedIndex].value;
      let name = dropdown.options[dropdown.selectedIndex].text;
  // console.log(name)


            $.ajax({
                url: '/rules_update',
                type: 'POST',
                data: { 
                  "_token": "{{ csrf_token() }}", 
                  "data": data,
                  "file_name": name 
                },
                success: function(data, status){
                  console.log(status)
                  if(status == 'success'){
                    document.getElementById('message_update_success').innerHTML = 'Template Updated Successfully';
                  }
                }

          });
          setTimeout(() => {
              document.getElementById("message_update_success").innerHTML = ""; 
          }, 2000)
        // console.log(result)



        }





     function CountRows() {
        var totalRowCount = 0;
        var rowCount = 0;
        var table = document.getElementById("custome_table");
        console.log(table)
        var rows = table.getElementsByTagName("tr")
        for (var i = 0; i < rows.length; i++) {
            totalRowCount++;
            if (rows[i].getElementsByTagName("td").length > 0) {
                rowCount++;
            }
        }
        var message = "Total Row Count: " + totalRowCount;
        message += "\nRow Count: " + rowCount;
        // console.log(message);
    }


    function addRow(){

      var tbl = document.getElementById('custome_table'), // table reference
          row = tbl.insertRow(tbl.rows.length),      // append table row
          i;
      // var cell = insertCell();
      // insert table cells to the new row
      for (i = 0; i < tbl.rows[0].cells.length; i++) {
          // var last_cell = createCell(row.insertCell(i), i, 'row');
          var last_cell = row.insertCell(i), i;
          last_cell.setAttribute('contenteditable', true);


      }

        var btn_remove = document.createElement('input');
      btn_remove.type = "button";
      btn_remove.className = "btn";
      btn_remove.value = "Delete";
      btn_remove.id = 'customebtn';

      btn_remove.addEventListener ("click", function() {
        this.closest('tr').remove()
      });

      
      row.appendChild(btn_remove);

       CountRows();

    }


  // function createCell(cell, text, style) {
  //     var div = document.createElement('input'), 
  //         txt = document.createTextNode(''); 
  //     div.appendChild(txt);                    
  //     div.setAttribute('class', style);        
  //     div.setAttribute('className', style);    
  //     div.setAttribute('contenteditable', true);
  //     div.setAttribute('value', "");
  //     cell.appendChild(div);         
  //     return div;                   
  // }



  function restrict_flag(data, flag){
    console.log(data.value)
    if(data.value == 'tcp' || data.value == 'icmp'){
      document.getElementById(flag).disabled = false;
      return false;
    }
    document.getElementById(flag).disabled = true;

  }

  function remove_row(id){
    console.log(id);
  }

    $(document).ready(function(){
    $("#template_name").keypress(function(e){

        var keyCode = e.which;
        /*
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */

        console.log(keyCode)
        if (keyCode == 32) {

          let c = String.fromCharCode(keyCode);
          document.getElementById('error_template_name').innerHTML = " Space is not allowed";
          document.getElementById('valid_template_name').innerHTML = " ";
          document.getElementById('save_rules').disabled = true;

          // console.log(keyCode)
          return false;
        }

        
          document.getElementById('error_template_name').innerHTML = " ";
          document.getElementById('valid_template_name').innerHTML = "Great";
          document.getElementById('save_rules').disabled = false;


      });

  });


      $(document).ready(function(){
    $("#template_re_name").keypress(function(e){

        var keyCode = e.which;
        /*
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */

        console.log(keyCode)
        if (keyCode == 32) {

          let c = String.fromCharCode(keyCode);
          document.getElementById('error_template_re_name').innerHTML = " Space is not allowed";
          document.getElementById('valid_template_re_name').innerHTML = " ";
          document.getElementById('save_rules').disabled = true;

          // console.log(keyCode)
          return false;
        }

        
          document.getElementById('error_template_re_name').innerHTML = " ";
          document.getElementById('valid_template_re_name').innerHTML = "Great";
          document.getElementById('save_rules').disabled = false;


      });

  });


  
     // $(document).ready(function(){
     function table_input_port_validate(source_ip, e) {
      console.log("IN FUN GO")
      $(source_ip).keypress(function(e){


        var keyCode = e.which;

        /*
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */
        if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 44 || keyCode > 44) && (keyCode < 48 || keyCode > 57) ) {
          let c = String.fromCharCode(keyCode);
          // document.getElementById('error_source_ip').innerHTML = c + " is not allowed"; 
          // document.getElementById('valid_source_ip').innerHTML = " ";
          document.getElementById('save_rules').disabled = true;

          return false;
        }

          document.getElementById('save_rules').disabled = false;
      });
     }
      

     function table_input_ip_validate(source_ip, e) {
      console.log("IN FUN GO")
      $(source_ip).keypress(function(e){


        var keyCode = e.which;

        /*
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */
        if ( (keyCode != 8 || keyCode == 32 ) && (keyCode < 46 || keyCode > 46) && (keyCode < 48 || keyCode > 57) ) {
          let c = String.fromCharCode(keyCode);
            // document.getElementById('error_source_ip').innerHTML = c + " is not allowed"; 
            // document.getElementById('valid_source_ip').innerHTML = " ";
          document.getElementById('save_rules').disabled = true;

          return false;
        }

          document.getElementById('save_rules').disabled = false;
      });
     }


</script>
@stop