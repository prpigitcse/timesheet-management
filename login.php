<?php 
// include_once("dbConnect.php");
?>

<!doctype html>
<head></head>
<body>
<form action="" method="post">
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
    <?php echo "<br>";?>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <?php echo "<br>";?>
    <button type="submit">Login</button>
    <button type="button" onclick="" class="cancelbtn">Cancel</button>
</form>
</body>