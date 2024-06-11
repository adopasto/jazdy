<?php    
    session_start();
    include_once 'fetch_users.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <?php             
        if (isset($_SESSION['error'])):?>
            <div class="error-message flash-message">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>    
        <?php elseif (isset($_SESSION['success'])):?>
            <div class="">
                Užívateľ bol vytvorený    
            </div>
        <?php endif;?>        
        <form action="process_login.php" method="post">
            <div class="row-full">
                <div class="column">
                    <label for="username">Username:</label>
                    <select id="id" name="data[id]">
                        <?php
                            foreach ($usersDropdown as $key => $value) {
                                echo '<option value="' . $key . '">' . $value . '</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row-full">
                <div class="column">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="data[password]">
                </div>
            </div>
            <div class="button-container">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
    <script type="text/javascript" src="js/flash-message.js"></script>   
</body>

</html>