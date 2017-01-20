<html>
    <head>
        <title>Login Page</title>

        <?php include "include/scripts.php" ?>
        <?php include 'include/nav.php' ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style type = "text/css">
            body {
                font-family:Arial, Helvetica, sans-serif;
                font-size:14px;
            }

            label {
                font-weight:bold;
                width:100px;
                font-size:14px;
            }

            .box {
                border:#666666 solid 1px;
            }
        </style>
    </head>

    <body bgcolor = "#FFFFFF">
        <div align = "center">
            <div style = "width:300px; border: solid 1px #333333; " align = "left">
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

                <div style = "margin:30px">

                    <form action = "" method = "post">
                        <label>UserName</label><br />
                        <input type = "text" name = "username" class = "box"/><br /><br />

                        <label>Password</label><br />
                        <input type = "password" name = "password" class = "box" /><br/><br />
                        <input type = "submit" value = " Submit "/><br />
                    </form>

                    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $this->model->error_login; ?></div>

                </div>
            </div>
        </div>

        <div align = "center">
            <div style = "width:300px; border: solid 1px #333333; " align = "left">
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Register</b></div>

                <div style = "margin:30px">

                    <form action = "register" method = "post">
                        <label>UserName</label><br />
                        <input type = "text" name = "username" class = "box"/><br /><br />
                        <label>Email</label><br />
                        <input type = "email" name = "email" class = "box"/><br /><br />
                        <label>Password</label><br />
                        <input type = "password" name = "password" class = "box" /><br/><br />
                        <label>Confirm Password</label><br />
                        <input type = "password" name = "confirm_password" class = "box" /><br/><br />
                        <input type = "submit" value = " Register "/><br />
                    </form>

                    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $this->model->error_register; ?></div>

                </div>
            </div>
        </div>
    </body>
</html>