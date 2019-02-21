<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Basic hotel booking form</title>
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/0.5.1/tailwind.css'>

<link rel="stylesheet" href="{{ asset('css/report-create.css') }}">

      <link rel="stylesheet" href="{{ asset('css/report-tag-add.css') }}">


</head>

<body>

  <!-- =============================================================================

    Title: Simple Hotel booking form
    Description: Simple Clean form for booking a room
    Nerds name: Andi
    Site: http://andi.io
    Twitter: @gitmash
    Location: Zurich, Switzerland

    ==== THANKS ====

    Forked from @soulrider911 https://codepen.io/soulrider911/pen/ugnyl/
    font: Lato (google font)
    Icon font:   http://fontawesome.io/icons/

    ==== @TODO ====

    Make <select> easier to select

========================================================================== -->

<form action="">
  <!--  General -->
  <div class="form-group">
    <h2 class="heading">Booking & contact</h2>
    <div class="controls">
      <input type="text" id="name" class="floatLabel" name="name">
      <label for="name">Title</label>
    </div>
  </div>
  <!--  Details -->
  <div class="form-group">

    {{-- <div class="col-1-3 col-1-3-sm">
    <div class="controls">
      <i class="fa fa-sort"></i>
      <select class="floatLabel">
        <option value="blank"></option>
        <option value="single-bed">Zweibett</option>
        <option value="double-bed" selected>Doppelbett</option>
      </select>
      <label for="fruit">Bedding</label>
     </div>
    </div> --}}

     {{-- </div> --}}
      <div class="grid">
        <div class="controls">
          <textarea name="comments" class="floatLabel" id="comments"></textarea>
          <label for="comments">Comments</label>
          </div>
            <button type="submit" value="Submit" class="col-1-4">Submit</button>
      </div>
  </div> <!-- /.form-group -->
</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery-ui-autocomplete.js'></script>
<script src='http://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery.select-to-autocomplete.js'></script>
<script src='http://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery.select-to-autocomplete.min.js'></script>


    <script  src="{{ asset('js/tags.js') }}"></script>
    <script  src="{{ asset('js/report-create.js') }}"></script>




</body>

</html>
