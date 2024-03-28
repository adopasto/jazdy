<?php
    session_start();    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <h1>Register</h1>
            <div id="flash-message error-message">
                <?php                
                    if (isset($_SESSION['error']['message'])) {
                        echo $_SESSION['error']['message'];
                        unset($_SESSION['error']['message']);
                    }
                ?>
            </div>            
            <form action="process_register.php" method="post" id="register-form">
                <div class="row-full">
                    <div class="column">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="data[email]" value="<?php echo $_SESSION['data']['email'] ?? '';?>">
                    </div>
                    <div class="column error">
                        <?php
                            if (isset($_SESSION['error']['email'])) {
                                echo $_SESSION['error']['email'];
                            }
                        ?>
                    </div>
                </div>
                <div class="row-full">
                    <div class="column">
                        <label for="firstname">Firstname:</label>
                        <input type="text" id="firstname" name="data[firstname]" value="<?php echo $_SESSION['data']['firstname'] ?? '';?>">
                    </div>
                    <div class="column error">
                        <?php
                            if (isset($_SESSION['error']['firstname'])) {
                                echo $_SESSION['error']['firstname'];
                            }
                        ?>
                    </div>                    
                </div>
                <div class="row-full">
                    <div class="column">
                        <label for="lastname">Lastname:</label>
                        <input type="text" id="lastname" name="data[lastname]" value="<?php echo $_SESSION['data']['lastname'] ?? '';?>">
                    </div>
                    <div class="column error">
                        <?php
                            if (isset($_SESSION['error']['lastname'])) {
                                echo $_SESSION['error']['lastname'];
                            }
                        ?>
                    </div>                                        
                </div>
                <div class="row-full">
                    <div class="column">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="data[password]">
                    </div>
                    <div class="column error">
                        <?php
                            if (isset($_SESSION['error']['password'])) {
                                echo $_SESSION['error']['password'];
                            }
                        ?>
                    </div>                                        
                </div>
                <div class="row-full">
                    <div class="column">
                        <label for="repeat-password">Repeat Password:</label>
                        <input type="password" id="repeat-password" name="data[repeat-password]">
                    </div>
                    <div class="column error">
                        <?php
                            if (isset($_SESSION['error']['repeat-password'])) {
                                echo $_SESSION['error']['repeat-password'];
                            }
                        ?>
                    </div>                                                           
                </div>
                <div class="button-container">
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="js/flash-message.js"></script>
        <script type="text/javascript" src="js/register-validation.js"></script>        
    </body>
</html>