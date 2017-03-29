<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1>Dashboard</h1>

            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="index.php?pageId=About">About Us</a></li>
                <li><a href="index.php?pageId=Contact">Contact Us</a></li>
                <?php if(isset($_SESSION["is_logged_in"])) : ?>
                    <li><a href="index.php?pageId=GamesList"><i class="fa fa-gamepad fa-lg" ></i> Games List</a></li>
                <?php endif ?>
            </ul>


        </div>
    </div>
</div>