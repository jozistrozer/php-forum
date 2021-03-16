<?php
    include("php_handle/db_connect.php");
    session_start();
    $username = $_SESSION["username"];
    $post_id = $_GET["post_id"];
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
                    <p style="font-weight: bold;" id="username"><?php echo $username;?></p>
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
                <div style='border: 1px solid black;'>
                <?php
                    $post = mysqli_fetch_all($conn->query("SELECT * FROM objava WHERE id = '$post_id'"))[0];

                    // Objava
                    echo "<h2>".$post[2]."</h2>";
                    echo "<p>".$post[1]."</p>";
                    echo "<hr>";
                    echo "<p style='margin-bottom: 50px;'>".$post[3]."</p>";
                    echo "<hr>";
                    
                    // Komentarji
                    echo "<p style='font-weight: bold;'>Komentarji:</p>";
                    
                    $komentarji = $conn->query("SELECT u.username, k.komentar FROM komentar k
                                                JOIN uporabniki u ON u.id = k.id_uporabnik
                                                WHERE id_objava='$post_id'");
                    
                    while ($row = $komentarji->fetch_assoc()) {
                        echo "<p style='border: 1px solid black;'><span style='font-weight:bold;'>".$row["username"].": </span>".$row["komentar"]."</p>";
                    }
                    
                    
                    
                    // Dodajanje komentarja
                    echo "<hr />"; 
                    echo "<p>Dodaj komentar: <input type='text' id='inpKomentar' minlength='3'></input><button type='button' onclick='DodajKomentar(".$post_id.");'>Komentiraj</button></p>";
                    
                    ?>
                </div>
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

        function DodajKomentar(post_id) {
            var komentar = document.getElementById("inpKomentar").value;
            var username = document.getElementById("username").textContent;

            if (komentar.length > 2) {
                $.ajax({
                    url: 'php_handle/dodaj_komentar.php',
                    type: 'post',
                    data: {post_id: post_id, komentar: komentar, username: username},
                    success: function(response){
                        if (response == 1) {
                            location.reload();
                        } else {
                            alert("Napaka pri dodajanju komentarja.");
                            console.log(response);
                        }
                    }
                });
            } else {
                alert("Komentar je prekratek.");
            }
        }
    </script>
</html>