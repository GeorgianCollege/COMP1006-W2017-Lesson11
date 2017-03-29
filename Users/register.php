<?php

$messages = "";
$isUserNameUnique = false;

include_once('Models/User.php');

if(isset($_POST["username"])){
    include_once('Config/database.php');

    $username = $_POST["username"];
    // TODO: check for unique username
    try {
        $db = DBConnection();
        $query = "SELECT * FROM users 
                  WHERE username = :username";
        $statement = $db->prepare($query); // encapsulate the sql statement
        $statement->bindValue(':username', $username);
        $statement->execute(); // run on the db server
        if($statement->rowCount() == 1) { // we have a match
            $messages="Invalid Username";
        }
        else {
            $isUserNameUnique = true;
        }
        $statement->closeCursor(); // close the connection
    }
    catch(Exception $e) {
        $messages = $e->getMessage();
    }

    if($isUserNameUnique) {
        try {
            $db = DBConnection();
            $password = $_POST["password"];

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $displayName = $_POST["displayName"];

            $query = "INSERT INTO users (username, password, displayName) VALUES (:username, :password, :displayName)";
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $hashed_password);
            $statement->bindValue(':displayName', $displayName);
            $statement->execute();
            $statement->closeCursor();

            // if everything good go to index page
            header('Location: index.php');
        } catch (Exception $e) {
            $messages = $e->getMessage();
        }
    }
}
else {
    $messages = "";
}

$title = "Register";

?>

<!-- Render the Registration form  -->
	<main class="container">
	<!-- Display flash messages  -->
	<?php if ($messages != "") : ?>
        <div class="alert alert-danger"><?php echo $messages ?></div>
    <?php endif ?>

		<div class="row">
            <div class="col-md-offset-4 col-md-4">
                <h1>User Registration</h1>
                <form method="post" action="index.php?pageId=Register">
                    <fieldset class="form-group">
                        <label for="username">Username: *</label>
                        <input name="username" type="text" class="form-control" required />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="password">Password: *</label>
                        <input name="password" type="password" class="form-control" required />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="displayName">Display Name: *</label>
                        <input name="displayName" type="text" class="form-control" required />
                    </fieldset>
                    <fieldset class="form-group text-right">
                        <input type="submit" class="btn btn-success" value="Submit"/>
                        <a href="index.php">
                            <input type="button" class="btn btn-warning" value="Cancel"/>
                        </a>
                    </fieldset>
                </form>
            </div>
        </div>
	</main>
