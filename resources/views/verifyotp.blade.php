<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  @if(session('success'))
    <h6 class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </h6>
@endif
  <div class="container" style="padding-top:25px;">
    <div class="card">
        <div class="card-body">
        <form  id="register" route={{}}>
    @csrf
    
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">otp</label>
        <input type="number" name="otp" class="form-control" id="exampleInputPassword1" placeholder="Mobile">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

        </div>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $("#register").submit(function(e) {
            e.preventDefault(); // Fix the typo here

            var formData = $(this).serialize();

            $.ajax({
                type: "POST", 
                url: "{{ route('store') }}",
                data: formData,
                success: function(response) {
                    alert("Otp has been sent to your registered mobile number successfully!");

                    setTimeout(function() {
                        window.location.reload();
                    }, 500);
                },
                error: function(error) {
                    $(".form-messages").html("An error occurred: " + error.statusText);
                },
            });
        });
    });
  
    </script>
  </body>
</html>