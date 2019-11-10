@extends('includes.header')
@section('content')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">

<div class="page-holder w-100 d-flex flex-wrap">
<div class="container-fluid px-xl-5">
          <section class="py-5">
            <div class="row">
              <div class="col-lg-12 mb-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="h6 text-uppercase mb-0">Employee's Registration</h3>
                  </div>
                  <p id="overall_err"></p>
                  <div class="card-body">
                    <form onsubmit="return formcheck();" class="form-horizontal" method="POST" id="employee" action="{{url('insert')}}" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Email <span style="color:red">*</span></label>
                        <div class="col-md-9">
                          <input type="email" onblur="return getMessage(this.value);" class="form-control" id="email" name="email">
                          <p id="msg"></p>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Known Technologies <span style="color:red">*</span></label>
                        <div class="col-md-9">
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox1" class="known_tech" name="known_technologies[]" type="checkbox" value="PHP"> PHP
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox2" class="known_tech" name="known_technologies[]" type="checkbox" value="PYTHON"> PYTHON
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" class="known_tech" name="known_technologies[]" type="checkbox" value=".NET"> .NET
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" class="known_tech" name="known_technologies[]" type="checkbox" value="JAVA"> JAVA
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" class="known_tech" name="known_technologies[]" type="checkbox" value="ROR"> ROR
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" class="known_tech" name="known_technologies[]" type="checkbox" value="GO"> GO
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" class="known_tech" name="known_technologies[]" type="checkbox" value="DART"> DART
                          </label>
                          <p style="color:red" id="tech_alert"></p>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Profile Picture <span style="color:red">*</span></label>
                        <div class="col-md-9">
                          <div class="form-group">
                            <div class="input-group mb-3">
                              <input id="img_upload" type="file" name="profile_picture" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Joining Date <span style="color:red">*</span></label>
                        <div class="col-md-9">
                          <input id="datepick" name="joining_date" class="form-control">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <div class="col-md-9 ml-auto">
                          <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
@endsection
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
$(document).ready(function() {

  
  var $j = jQuery.noConflict();
  $('#datepick').datepicker({ dateFormat: 'dd-mm-yy' }).val();
});
function getMessage(a) {
  //alert(a);

  $.ajax({
            type: "POST",
            url: 'chkmail',
            data: {"_token": "{{ csrf_token() }}",a: a},
      success:function(data) {
        if(data=="This Email Id Already Exists"){
        $("#msg").html(data);
        return false;
      }
    }
  });
  formcheck();
}
function formcheck(){
var img=$("#img_upload").val();
var name=$("#name").val();
var joining_date=$("#date_pick").val();
var email=$("#email").val();
var tech = $("input[name='known_technologies[]']").val();
var total=$('.known_tech:checked').length;
if(name==""||img==""||joining_date==""||email==""||tech==""){
  $('#overall_err').text("Please fill All Mandatory Field");
  return false;
}
else if(total<3){
      $('#tech_alert').text("Please Check Atleast Three Technologies");
      return false;
}
    return true;
  }
</script>
<style>
#msg{
    color: red;
    padding: 10px;
}
p#overall_err {
    padding: 10px;
    text-align: center;
    color: red;
}
</style>