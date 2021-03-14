<?php
    session_start();
    $username = $_GET["username"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="css/page.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Uredi profil (<?php echo $username; ?>)</title>
        <!-- HEADER -->
        <div class="navbar navbar-inverse" style="margin-bottom: 0px;">
            <div class="container-fluid"> 
                <div class="navbar-header">
                <a class="navbar-brand">Forum</a>
                </div>

                <div id="searchBar">
                    <input type="text">
                </div>
            </div>
        </div>
    </head>

    <body>
        
        <h1>Tvoj profil</h1>
        <p>Profilna slika....</p>
        <?php
            echo "<h3>".$username."</h3>";
        ?>

        <button type="button"><a href="homepage.php"><--</a></button>
        
    </body>

    <footer>
        <nav class="navbar navbar-inverse" id="noga">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><div class="footer-header"><div class="brand-name">FORUM</div>, Jože Strožer</div></a>
                </div>
            </div>
        </nav>
    </footer>

    <script>
    </script>
</html>