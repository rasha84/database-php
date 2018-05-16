<!DOCTYPE HTML>  
<html>
<head>
  <style>.error {color: #FF0000;}</style>
  <!-- <?php
  include_once 'connect.php';
  ?> -->
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$fname = $lname = $email = $gender = $comment = $website = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $nameErr = "Name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["lname"])) {
    $nameErr = "Name is required";
  } else {
    $lname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }    
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  // if(isset($_POST['save']) && $fname =! "" && $lname =! "" && $email =! "" && $gender =!"" )
  // {
  //   $sql = "INSERT INTO clients (firstname,lastname, email, c_url, comment, gender)
  //   VALUES ($fname, $lname, $email,$website,$comment, $gender)";
  //   $conn->exec($sql);
  //   echo 'entry inserted';

  // }


}

?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
  FirstName: <input type="text" name="fname">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  LastName: <input type="text" name="lname">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="save">  
</form>

<?php
  include_once 'connect.php';

  echo "<h2>Your Input:</h2>";
  echo $fname;
  echo "<br>";
  echo $lname;
  echo "<br>";
  echo $email;
  echo "<br>";
  echo $website;
  echo "<br>";
  echo $comment;
  echo "<br>";
  echo $gender;

  if($fname != "" && $lname != "" && $email != "" && $gender !="" )
  {
    // $sql = "INSERT INTO clients (firstname,lastname, email, c_url, comment, gender)
    // VALUES ('$fname', '$lname', '$email', '$website', '$comment', '$gender')";
    //echo '<pre>'; var_dump($sql); echo '</pre>'; die();
    //cette methode n'est pas sécuriser pour acceder à la base de donnée
    // $conn->exec($sql);
    //il faut utiliser PDO prepare 
    
    $sql = "INSERT INTO clients (firstname,lastname, email, c_url, comment, gender)
    VALUES (:fname, :lname, :email, :website, :comment, :gender)";
    $prepared = $conn->prepare($sql);
    $prepared->bindParam(':fname', $fname);
    $prepared->bindParam(':lname', $lname);
    $prepared->bindParam(':email', $email);
    $prepared->bindParam(':website', $website);
    $prepared->bindParam(':comment', $comment);    
    $prepared->bindParam(':gender', $gender);        
    $prepared->execute();
    echo 'New record created successfully';
   

  }

  //$prepared = null;
  //$conn = null;


  
?>
</body>
</html>