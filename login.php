<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    require("dbconnect.php");
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Check committee table
    $committee_sql = sprintf("SELECT * FROM user
                              WHERE email = '%s'",
                             $email);
							 
						//	 echo $committee_sql;
    
    $committee_result = $mysqli->query($committee_sql);
    $committee_user = $committee_result->fetch_assoc();
   
    //echo $password;
        
        if ($committee_user["password"] == $password) {
            
            session_start();
            session_regenerate_id();
            
            $_SESSION["id"] = $committee_user["comm_id"];
            $_SESSION["role"] = $committee_user["role"];
            
            header("Location: index.php");
            exit;
        }
    }
    
   


?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Repository System</title>
    <meta charset="UTF-8">

    <!-- Link stylesheet -->
    <link rel="stylesheet" href="../include/styles.css">

</head>
<body>
    
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <br>
    
<style>

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            padding: 20px;
            text-align: center;
        }

        .box label {
            display: block;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .box input[type="email"],
        .box input[type="password"] {
            width: 250px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .box button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .box button:hover {
            background-color: #45a049;
        }

        .box p {
            margin-top: 20px;
        }

        .main-title {
    font-size: 30px;
    padding-bottom: 20px;
}

    </style>
</head>
<body>

<div class="container">
    <div class="box">
    <h1 class="main-title">Pemantauan Projek</h1>
<h2> Login Page</h2>
        <form method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="">
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <br>
            <button>Log in</button>
        </form>
        <!-- <p>Need help? Click <a href="help.html">here</a>.</p> -->
    </div>
</div>

</body>
</html>