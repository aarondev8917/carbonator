<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Carbonator</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
   <style>
   .error{ color:red; } 
  </style>
</head>
 
<body>
 
<div class="container">
    <h2 style="margin-top: 10px;">Carbonator! Measure you carbon emission</h2>
    <br>
    <br>
   
    <form id="carbonator" method="post" action="javascript:void(0)">
        <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message"></span>
         </div>
      <div class="form-group">
        <label for="activity">Activity</label>
        <input type="number" name="activity" class="form-control" id="activity" placeholder="Please enter fuel consumption" required>
        <span class="text-danger">{{ $errors->first('activity') }}</span>
      </div>
      <div class="form-group">
        <label for="activityType">activityType</label>
        <input type="text" name="activityType" class="form-control" id="activityType" placeholder="Please enter activityType" required>
        <span class="text-danger">{{ $errors->first('activityType') }}</span>
      </div>
      <div class="form-group">
        <label for="fuelType">fuelType</label>
        <input type="text" name="fuelType" class="form-control" id="fuelType" placeholder="Please enter fuelType">
        <span class="text-danger">{{ $errors->first('fuelType') }}</span>
      </div>
      <div class="form-group">
        <label for="mode">mode</label>
        <input type="text" name="mode" class="form-control" id="mode" placeholder="Please enter mode">
        <span class="text-danger">{{ $errors->first('mode') }}</span>
      </div>           
      <div class="form-group">
        <label for="country">Country</label>
        <input type="text" name="country" class="form-control" id="phcountryone" placeholder="Please enter country" maxlength="5" required>
        <span class="text-danger">{{ $errors->first('country') }}</span>
      </div>
      <div class="form-group">
       <button type="button" id="send_form" class="btn btn-success">Submit</button>
      </div>
    </form>
 
</div>

</body>
</html>

<script>
//-----------------
$(document).ready(function(){
$('#send_form').click(function(e){
   e.preventDefault();
   /*Ajax Request Header setup*/
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

   $('#send_form').html('Sending..');
   
   /* Submit form data using ajax*/
   $.ajax({
      url: '{{ url("/api/footprint")}}',
      method: 'POST',
      data: $('#carbonator').serialize(),
      success: function(response){
         //------------------------
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(JSON.stringify(response));
            $('#msg_div').show().removeClass('d-none');

            document.getElementById("carbonator").reset(); 
            setTimeout(function(){
                $('#res_message').html('');
                $('#res_message').hide();
                $('#msg_div').hide().addClass('d-none');
            },10000);
         //--------------------------
      },
      error: function(data){
          console.log(data);
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(data.responseText);
            $('#msg_div').show().removeClass('d-none').removeClass('alert-success').addClass('alert-danger');

            document.getElementById("carbonator").reset(); 
            setTimeout(function(){
                $('#res_message').hide();
                $('#msg_div').hide();
                $('#msg_div').addClass('d-none').removeClass('alert-danger').addClass('alert-success')
            },10000);
        }       
    });
   });
});
//-----------------
</script>