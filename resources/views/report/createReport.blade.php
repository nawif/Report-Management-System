<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Create Report</title>
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/0.5.1/tailwind.css'>

<link rel="stylesheet" href="{{ asset('css/report-create.css') }}">
<link rel="stylesheet" href="{{ asset('css/report-tag-add.css') }}">
<link rel="stylesheet" href="{{ asset('css/report-select-group.css') }}">


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
    <h2 class="heading">Create a Report</h2>
    <div class="controls">
      <input type="text" id="name" class="floatLabel" name="name">
      <label for="name">Title</label>

    </div>
  </div>
  <!--  Details -->
  <div class="form-group">
      <div class="grid">
        <div class="controls">
          <textarea name="comments" class="floatLabel" id="comments"></textarea>
          <label for="comments">Comments</label>
          <div class="tags-input"></div>
          <p class="tag-p" >Separate your tags with a comma</p>
          <div class="selectMultipleCont">
            <select multiple data-placeholder="Group">
                <option>Sketch</option>
                <option>Framer X</option>
                <option>Photoshop</option>
                <option>Principle</option>
                <option>Invision</option>
            </select>
          </div>

        <input type="file"
       class="selectMultipleCont"
       name="filepond"
       multiple
       data-max-file-size="3MB"
       data-max-files="3" />
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
    <script  src="{{ asset('js/report-select-group.js') }}"></script>





</body>

</html>
