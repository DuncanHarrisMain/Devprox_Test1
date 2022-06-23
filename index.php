<?php
    /*
    All code to follow and in corresponding files were solely coded by:
    Author- Duncan Harris
    */

    require("inputValidator.php");
    require("connect.php");
    if(isset($_POST["submit"]))
    {

        $validation = new Validator($_POST);
        $error = $validation->validateForm();

       if(empty($error))
       {
            $connection = new Connector($_POST);
            $error2 = $connection->runQueries();
       }
       
    }
    if(isset($_POST["cancel"]))
    {
        header("reset");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Document</title>
</head>
<body>
    <div class="user">
        <h2>User</h2>
        <hr>
        <form id="userForm" action="index.php" method="POST">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? "") ?>"><br>
            <div class="error">
                <?php echo $error["name"] ?? "";?>
            </div>
            <label>Surname</label>
            <input type="text" name="surname" value="<?php echo htmlspecialchars($_POST['surname'] ?? "") ?>"><br>
            <div class="error">
                <?php echo $error["surname"] ?? "";?>
            </div>
            <label>ID Number</label>
            <input type="text" name="idNo" value="<?php echo htmlspecialchars($_POST['idNo'] ?? "") ?>"><br>
            <div class="error">
                <?php echo $error["idNo"] ?? "";?>
            </div>
            <div class="error">
                <?php echo $error2["idNo"] ?? "";?>
            </div>
            <label>Date Of Birth</label>
            <input type="text" name="dob" placeholder="dd-mm-yyyy" value="<?php echo htmlspecialchars($_POST['dob'] ?? "") ?>"><br>
            <div class="error">
                <?php echo $error["dob"] ?? "";?>
            </div>
            <input type="submit" name="submit" value="submit">
            <input type="submit" name="clear" value="clear">
        </form>
    </div>
</body>
</html>