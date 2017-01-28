<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

	// Confirm that POST values are present before accessing them.

	// Perform Validations
	// Hint: Write these in private/validation_functions.php

	// if there were no errors, submit data to database

	  // Write SQL INSERT statement
	  // $sql = "";

	  // For INSERT statments, $result is just true/false
	  // $result = db_query($db, $sql);
	  // if($result) {
	  //   db_close($db);

	  //   TODO redirect user to success page

	  // } else {
	  //   // The SQL INSERT statement failed.
	  //   // Just show the error, not the form
	  //   echo db_error($db);
	  //   db_close($db);
	  //   exit;
	  // }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
	// TODO: display any form errors here
	// Hint: private/functions.php can help
  ?>

  <!-- TODO: HTML form goes here -->
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$errors = [];
 	if (is_blank($_POST['first_name'])) 
 	{
    	$errors[] = "First name cannot be blank.";
 	} 
 	elseif (!has_length($_POST['first_name'], ['min' => 2, 'max' => 255])) 
 	{
    	$errors[] = "First name must be between 2 and 255 characters.";
 	}
 	if (is_blank($_POST['last_name'])) 
 	{
    	$errors[] = "Last name cannot be blank.";
 	} 
 	elseif (!has_length($_POST['last_name'], ['min' => 2, 'max' => 255])) 
 	{
    	$errors[] = "Last name must be between 2 and 255 characters.";
  	}
  	if (is_blank($_POST['email'])) 
 	{
    	$errors[] = "Email cannot be blank.";
 	} 
 	else if (!has_length($_POST['email'], ['min' => 2, 'max' => 255])) 
 	{
    	$errors[] = "email must be between 2 and 255 characters.";
  	}
  	else if(!strpos($_POST['email'], "@"))
  	{
  		$errors[] = "Email should contain the '@' symbol";
  	}
  	if (is_blank($_POST['username'])) 
 	{
    	$errors[] = "Username cannot be blank.";
 	} 
 	elseif (!has_length($_POST['username'], ['min' => 8, 'max' => 255])) 
 	{
    	$errors[] = "Username must be between 8 and 255 characters.";
  	}

  	if(!empty($errors))
  	{
  		echo display_errors($errors);
  		echo '<form action="register.php" method="post">';
  		echo 'There were errors!';
		  echo '<p>First name:</p> <input type="text" name="first_name" id="first_name" value="'.htmlspecialchars($_POST['first_name']).'"><br>';
  		echo '<p>Last name:</p> <input type="text" name="last_name" id="last_name" value="'.htmlspecialchars($_POST['last_name']).'"><br>';
  		echo '<p>email:</p> <input type="text" name="email" id="email" value="'.htmlspecialchars($_POST['email']).'"><br>';
  		echo '<p>username:</p> <input type="text" name="username" id="username" value="'.htmlspecialchars($_POST['username']).'"><br>';
  		echo '<button type="submit">Register!</button>';
  		echo '</form>';
  	}
  	else
  	{
  		$first_name = $_POST['first_name'];
  		$last_name = $_POST['last_name'];
  		$email = $_POST['email'];
  		$username = $_POST['username'];
  		$date = date("Y-m-d H:i:s");
  		$insert_new_user_query = "INSERT INTO users (first_name, last_name, email, user_name, created_at) VALUES ('$first_name', '$last_name', '$email', '$username', '$date');";
  		//$insert_new_user_query = db_escape($db, $insert_new_user_query);
  		$result = db_query($db, $insert_new_user_query);

  		if($result)
  		{
  			db_close($db);
        header('Location: registration_success.php');	
  		}else 
  		{
	  //   // The SQL INSERT statement failed.
	  //   // Just show the error, not the form
  			echo db_error($db);
  			db_close($db);
  			exit;
  		}
  	}
  }
  else
  {
		echo '<form action="register.php" method="post">';
		echo "It's a brand new page!";
		echo '<p>First name:</p> <input type="text" name="first_name" id="first_name"><br>';
		echo '<p>Last name:</p> <input type="text" name="last_name" id="last_name"><br>';
		echo '<p>email:</p> <input type="text" name="email" id="email"><br>';
		echo '<p>username:</p> <input type="text" name="username" id="username"><br>';
		echo '<button type="submit">Register!</button>';
		echo '</form>';
	}
  ?>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
