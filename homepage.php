<?php
    include("php_handle/db_connect.php");
    session_start();
    $username = $_SESSION["username"];
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
        <title>Homepage (<?php echo $username; ?>)</title>
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
        
        <div id="bodyContainer">
            <div id="profileSection">
                <div id="tabProfile" class="tabCloud">
                    <h4>Informacije o profilu</h4>
                    <hr>
                    <p style="font-weight: bold;"><?php echo $username;?></p>
                    <p>Število objav: </p>
                    <p>Število komentarjev: </p>

                    <?php
                        echo "<button type='button' onclick=editProfile('".$username."');>Uredi profil</button>";
                    ?>
                    
                </div>
                <div id="followedCommunities" class="tabCloud">
                    <h4>Skupine, ki jim slediš</h4>
                    <hr>
                    <!-- SLEDENE SKUPINE -->
                    <?php
                        $sledene_skupine = $conn->query (
                            "SELECT s.ime FROM sledene_skupine sk
                            JOIN skupina s ON sk.id_skupina = s.id
                            JOIN uporabniki u ON sk.id_uporabnik = u.id
                            WHERE u.username = '$username'"
                        );

                        // Zanka, ki izpiše vse skupine, ki jim uporabnik sledi.
                        while ($row = $sledene_skupine->fetch_assoc()) {
                            echo "<p><a href='#'>".$row["ime"]."</a></p>";
                        }
                    ?>
                </div>
            </div> 
            <div id="mainSection">

                <?php
                    $objava = $conn->query (
                        "SELECT * FROM objava o
                        WHERE o.id_skupina IN (SELECT id_skupina FROM sledene_skupine sk WHERE sk.id_uporabnik = (SELECT id FROM uporabniki WHERE username='$username'));"
                    );

                    while ($row = $objava->fetch_assoc()) {
                        echo "<div id='post-".$row["id"]."' class='tabCloud'>";
                        echo    "<h4 style='font-weight: bold;'><a href='post_detail.php?post_id=".$row["id"]."'>".$row["naslov"]."</a></h4>";
                        echo    "<p style='font-color: grey; font-size: 10px;'>".$row["cas_objave"]."</p>";
                        echo    "<p>UPORABNIK</p>";
                        echo    "<hr />";
                        echo "</div>";
                    }
                ?>
            </div>
            <div id="communitySection">
                <div id="tabSuggestedCommunities" class="tabCloud">
                    <h4>Predlagane skupine</h4>
                    <hr>
                    <?php
                        $priporoceneSkupine = $conn->query ("SELECT * FROM skupina s WHERE s.id
                        NOT IN (SELECT id_uporabnik FROM sledene_skupine WHERE id_uporabnik=(SELECT id FROM uporabniki WHERE username='$username'))");

                        while ($row = $priporoceneSkupine->fetch_assoc()){
                            echo "<div class='tabCloud'>";
                                echo "<h5 style='font-weight: bold;'>".$row["ime"]."</h5>";
                                echo "<p>Število sledilcev: ".$row["st_uporabnikov"]."</p>";
                                echo "<button type='button'>Sledi</button>";
                            echo "</div>";
                        }
                        
                    ?>
                </div>
            </div>
        </div>
        
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
        function editProfile(username){

            window.location.href = "edit_profile.php?username="+username;
        }
    </script>
</html>