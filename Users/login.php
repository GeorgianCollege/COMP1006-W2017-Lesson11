<?php

if(isset($_POST["username"])){
    include_once('Config/database.php');
    try{
        $db = DBConnection();
        $username = $_POST["username"];
        $password = $_POST["password"];

        //$hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "SELECT password FROM users 
                  WHERE username = :username"; // SQL statement
        $statement = $db->prepare($query); // encapsulate the sql statement
        $statement->bindValue(':username', $username);
        //$statement->bindValue(':password', $hashed_password);
        $statement->execute(); // run on the db server
        $hashed_password = $statement->fetch();
        if(password_verify($password, $hashed_password["password"])) {
            $statement->closeCursor(); // close the connection
            session_start();
            $_SESSION["is_logged_in"] = true;
            // if everything good go to index page
            header('Location: index.php');
        }
        else {
            $statement->closeCursor(); // close the connection
            $messages = "Invalid Username or Password";
        }
    }
    catch(Exception $e) {
        $messages = $e->getMessage();
    }
}
else {
    $messages = "";
}

$title = "Login";
?>

<main class="container">
    <?php if ($messages != "") : ?>
        <div class="alert alert-danger"><?php echo $messages ?></div>
    <?php endif ?>
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
           <h1>Please Login</h1>
           <form method="post" action="index.php?pageId=Login">
                <fieldset class="form-group">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" required autofocus/>
                 </fieldset>
                 <fieldset class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password" required/>
                    or <a href="index.php?pageId=Register">Register</a>
                </fieldset>
                <fieldset class="form-group text-right">
                    <input type="submit" class="btn btn-success" value="Log In"/>
                    <a href="index.php">
                        <input type="button" class="btn btn-warning" value="Cancel"/>
                    </a>
               </fieldset>
            </form>
         </div>
      </div>
    </main>
