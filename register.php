<?php
/**
 * User: Erik Wilson
 * Date: 13-May-17
 * Time: 17:20
 */
require_once '_functions.php';
check_install();

//require the config file
require_once "config.php";

// start the session and connect to DB
session_start();
$dbh = db_connect() or die(ERR_MSG);

cookie_loader($dbh);

if (isset($_SESSION['user'])) {
    header("Location: index.php");
}

$pageTitle = "Register - Concert Tracker";

ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <!-- Include the HTML head -->
    <?php include "htmlhead.php" ?>
    <body>
    <header>
        <?php
        include "navbar.php";
        echo $navbar;
        ?>
    </header>

    <main class="container head-foot-spacing">
        <!-- Import from file form -->
        <form class="container panel form-login panel-default"
              action="user-register.php" method="post">
            <a class="btn btn-sm btn-primary" style="float: right" href="login.php">Login Here</a>
            <h2>Register</h2>
            <hr>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" maxlength="50" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" maxlength="50" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" minlength="8">
            </div>
            <div class="form-group" id="confirm-div">
                <label for="passconf">Confirm Password:</label>
                <input type="password" name="passconf" id="passconf" class="form-control" minlength="8">
                <span id="helpblock-match" class="help-block hidden">Passwords must match</span>
            </div>
            <hr>
            <button type="submit" class="btn btn-default" name="register">
                Register
            </button>
        </form>
    </main>

    <!-- Simple footer -->
    <?php
    include 'footer.php';
    echo $footer;
    ?>
    
    <script>
        function checkPasswordMatch() {
            // set variables
            var password        = $("#password").val();
            var confirmPassword = $("#passconf").val();
            var div             = $("#confirm-div");
            var matchHelp       = $("#helpblock-match");

            // check password confirmation
            if (password === "" && confirmPassword === "") {
                div.removeClass("has-success");
                div.removeClass("has-error");
                matchHelp.addClass("hidden");
            } else if (password !== confirmPassword) {
                div.removeClass("has-success");
                div.addClass("has-error");
                matchHelp.removeClass("hidden");
            } else {
                div.removeClass("has-error");
                div.addClass("has-success");
                matchHelp.addClass("hidden");
            }
        }

        $(document).ready(function () {
            $("#password, #passconf").keyup(checkPasswordMatch);
        });
    </script>

    </body>
    </html>
<?php
ob_end_flush();
