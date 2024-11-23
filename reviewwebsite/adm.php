<?php
if(isset($_POST["submit"])){
  $con=mysqli_connect("localhost","root","","mini_projet");
  $title=$_POST["title"];
  $director=$_POST["director"];
  $actor1=$_POST["actor1"]; 
  $actor2=$_POST["actor2"]; 
  $type=$_POST["type"]; 
  $seasons=$_POST["s"]; 
  $photo=$_FILES["photo"]["tmp_name"];
  $country=$_POST["country"]; 
  $languag=$_POST["language"];
  $ReleaseYear=$_POST["release-year"]; 
  $genre=$_POST["genre"];
  $Duration=$_POST["duration"];
  $Description=$_POST["description"];
  $title_error = $director_error = $actor1_error = $actor2_error = $country_error = $language_error = $seasons_error = $photo_error = $release_year_error = $duration_error = $description_error = "";
  if($type=="series"){
  if(empty($seasons)==false){
  if(preg_match("#^[A-Za-z]+$#",$director)){
    if(preg_match("#^[A-Za-z]+$#",$actor1)){
      if(preg_match("#^[A-Za-z]+$#",$actor2)){
          if(preg_match("#^[A-Za-z]+$#",$country)){
            if(preg_match("#^[A-Za-z]+$#",$languag)){
              
                $sql="insert into film(`title`, `director`, `actor1`, `actor2`, `type`, `seasons`, `photo`, `country`, `languag`, `ReleaseYear`, `genre`, `Duration`, `Description`)
                values('$title','$director','$actor1','$actor2','$type',$seasons,'photos/$title.jpg','$country','$languag',$ReleaseYear,'$genre',1,'$Description')";
                move_uploaded_file($photo,"photos/$title.jpg");
                mysqli_query($con,$sql);
              
            }else $language_error = "Language must only contain letters.";
          }else $country_error = "Country must only contain letters.";
      }else $actor2_error = "Actor 2's name must only contain letters.";
    }else $actor1_error = "Actor 1's name must only contain letters.";
  }else $director_error = "Director's name must only contain letters.";
}else $seasons_error="This field is required for the series.";
}
else{
  if(empty($Duration)==false){
  if(preg_match("#^[A-Za-z]+$#",$director)){
    if(preg_match("#^[A-Za-z]+$#",$actor1)){
      if(preg_match("#^[A-Za-z]+$#",$actor2)){
          if(preg_match("#^[A-Za-z]+$#",$country)){
            if(preg_match("#^[A-Za-z]+$#",$languag)){
              
                $sql="insert into film(`title`, `director`, `actor1`, `actor2`, `type`, `seasons`, `photo`, `country`, `languag`, `ReleaseYear`, `genre`, `Duration`, `Description`)
                values('$title','$director','$actor1','$actor2','$type',1,'photos/$title.jpg','$country','$languag',$ReleaseYear,'$genre','$Duration','$Description')";
                move_uploaded_file($photo,"photos/$title.jpg");
                mysqli_query($con,$sql);
              
              }else $language_error = "Language must only contain letters.";
            }else $country_error = "Country must only contain letters.";
        }else $actor2_error = "Actor 2's name must only contain letters.";
      }else $actor1_error = "Actor 1's name must only contain letters.";
    }else $director_error = "Director's name must only contain letters.";
  }else $duration_error ="required for the film";
}
mysqli_close($con);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Document</title>
  <style>
    /* General styling for inputs */
    input[type="text"], input[type="number"], input[type="file"], textarea, select {
      width: 100%; /* Make inputs fill available width */
      padding: 8px; /* Add padding for better spacing */
      margin: 10px 0; /* Space between input elements */
      border: 1px solid #ccc; /* Light border for input fields */
      border-radius: 4px; /* Rounded corners */
      font-size: 16px; /* Larger text for readability */
    }

    /* Styling for the textarea */
    textarea {
      resize: vertical; /* Allow vertical resizing of the textarea */
    }

    /* Submit button styling */
    input[type="submit"] {
      background-color: #007bff; /* Blue background */
      color: white; /* White text */
      padding: 12px 24px; /* Increase padding for a larger button */
      font-size: 18px; /* Increase font size */
      border: none; /* Remove border */
      border-radius: 6px; /* Slightly larger rounded corners */
      cursor: pointer; /* Pointer cursor on hover */
    }

    /* Submit button hover effect */
    input[type="submit"]:hover {
      background-color: #0056b3; /* Darker blue on hover */
    }

    /* Form container styling */
    form {
      width: 60%; /* Limit form width */
      margin: 0 auto; /* Center the form */
      background-color: #f9f9f9; /* Light background */
      padding: 20px; /* Padding around form elements */
      border-radius: 8px; /* Rounded corners for form */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    h1 {
      text-align: center; /* Center the title */
      color: #333; /* Dark text for contrast */
    }

    /* Styling for error messages */
    .error {
      color: red;
      font-size: 14px;
    }
  </style>

</head>
<body>
  <div>
    <h1>Movie/Series Information</h1>
    <form method="post" enctype="multipart/form-data">
      <input type="text" name="title" placeholder="Enter title" value="<?php echo isset($title) ? $title : ''; ?>" required><br>

      <input type="text" name="director" placeholder="Enter director's name" value="<?php echo isset($director) ? $director : ''; ?>" required><br>
      <div class="error"><?php echo $director_error ?? ''; ?></div>

      <input type="text" name="actor1" placeholder="Enter the name of actor 1" value="<?php echo isset($actor1) ? $actor1 : ''; ?>" required><br>
      <div class="error"><?php echo $actor1_error ?? ''; ?></div>
      <input type="text" name="actor2" placeholder="Enter the name of actor 2" value="<?php echo isset($actor2) ? $actor2 : ''; ?>" required><br>
      <div class="error"><?php echo $actor1_error ?? ''; ?></div>

      <select name="type" required>
        <option value="film" <?php echo (isset($type) && $type == "film") ? "selected" : ""; ?>>Film</option>
        <option value="series" <?php echo (isset($type) && $type == "series") ? "selected" : ""; ?>>Series</option>
      </select><br>

      <input type="number" name="s" min="1" placeholder="Enter number of seasons (not required for films)" value="<?php echo isset($seasons) ? $seasons : ''; ?>"><br>
      <div class="error"><?php echo $seasons_error ?? ''; ?></div>

      <input type="file" name="photo" accept="image/*" required><br>

      <input type="text" name="country" placeholder="Enter the country of production" value="<?php echo isset($country) ? $country : ''; ?>" required><br>
      <div class="error"><?php echo $country_error ?? ''; ?></div>

      <input type="text" name="language" placeholder="Enter the language" value="<?php echo isset($languag) ? $languag : ''; ?>" required><br>
      <div class="error"><?php echo $language_error ?? ''; ?></div>

      <input type="number" name="release-year" placeholder="Enter the release year" value="<?php echo isset($ReleaseYear) ? $ReleaseYear : ''; ?>" required min="1900" max="2099"><br>

      <select name="genre" required>
      <option value="action" <?php echo (isset($genre) && $genre == "action") ? "selected" : ""; ?>>Action</option>
        <option value="comedy" <?php echo (isset($genre) && $genre == "comedy") ? "selected" : ""; ?>>Comedy</option>
        <option value="drama" <?php echo (isset($genre) && $genre == "drama") ? "selected" : ""; ?>>Drama</option>
        <option value="horror" <?php echo (isset($genre) && $genre == "horror") ? "selected" : ""; ?>>Horror</option>
      </select><br>

      <input type="number" name="duration" placeholder="Enter duration in minutes (required for the film)" value="<?php echo isset($Duration) ? $Duration : ''; ?>" min="1"><br>
      <div class="error"><?php echo $duration_error ?? ''; ?></div>
      

      <textarea name="description" rows="4" placeholder="Write a brief description" required><?php echo isset($Description) ? $Description : ''; ?></textarea><br>
      <div class="error"><?php echo $description_error ?? ''; ?></div>

      <input type="submit" value="Submit" name="submit">
    </form>
  </div>
</body>
</html>

