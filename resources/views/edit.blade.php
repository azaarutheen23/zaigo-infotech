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
                    <h3 class="h6 text-uppercase mb-0">Employee's Update Details</h3>
                  </div>
                  <div class="card-body">
                    <form class="form-horizontal" method="POST" id="employee" action="{{url('update')}}" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Name</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" name="name" value="{{$employees->name}}">
                          <input type="hidden" class="form-control" name="id" value="{{$employees->id}}">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Email</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" onblur="return getMessage(this.value);" name="email" value="{{$employees->email}}">
                          <p id="msg"></p>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Known Technologies</label>
                        <div class="col-md-9">
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox1" @if(strstr($employees->known_technologies,"PHP")) checked @endif  name="known_technologies[]" type="checkbox" value="PHP"> PHP
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox2" @if(strstr($employees->known_technologies,"PYTHON")) checked @endif name="known_technologies[]" type="checkbox" value="PYTHON"> PYTHON
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" name="known_technologies[]" type="checkbox" @if(strstr($employees->known_technologies,".NET")) checked @endif value=".NET"> .NET
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" name="known_technologies[]" type="checkbox" @if(strstr($employees->known_technologies,"JAVA")) checked @endif value="JAVA"> JAVA
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" name="known_technologies[]" type="checkbox" @if(strstr($employees->known_technologies,"ROR")) checked @endif value="ROR"> ROR
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" name="known_technologies[]" type="checkbox" @if(strstr($employees->known_technologies,"GO")) checked @endif value="GO"> GO
                          </label>
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox3" name="known_technologies[]" type="checkbox" @if(strstr($employees->known_technologies,"DART")) checked @endif value="DART"> DART
                          </label>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Profile Picture</label>
                        <div class="col-md-9">
                          <div class="form-group">
                          <p>Current Profile Picture <img width="200" src="{{ asset('uploads/'.$employees->profile_picture)}}"> </p>
                          
                            <div class="input-group mb-3">
                              <input id="img_upload" type="file" value="{{$employees->profile_picture}}" name="profile_picture" class="form-control">
                              <input type="hidden" class="form-control" name="current_profile" value="{{$employees->profile_picture}}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-md-3 form-control-label">Joining Date</label>
                        <div class="col-md-9">
                          <input id="datepick" value="{{$employees->joining_date}}" name="joining_date" class="form-control">
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
            url: '{{url("chkmail")}}',
            data: {"_token": "{{ csrf_token() }}",a: a},
      success:function(data) {
        if(data==""){
        $("#msg").html(data);

      }
    }
  });
}
function formcheck(){
getMessage(a);
var img=$("#img_upload").val();
var name=$("#name").val();
var joining_date=$("#date_pick").val();
var email=$("#email").val();
var tech = $("input[name='known_technologies[]']").val();
var total=$('.known_tech:checked').length;
//alert(total);
//     if(name=="" || img=="" joining_date=="" || email==""){
//     $('#overall_err').text("Please fill All Mandatory Field");
//     return false;
// }
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

