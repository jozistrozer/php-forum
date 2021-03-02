<?php
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
                </div>
                <div id="followedCommunities" class="tabCloud">
                    <h4>Skupine, ki jim slediš</h4>
                    <hr>
                    <p><a href="#">Živali</a></p>
                    <p><a href="#">Python</a></p>
                    <p><a href="#">DIY</a></p>
                </div>
            </div> 
            <div id="mainSection">
                <div id="post-0" class="tabCloud">
                    <h4>Primer naslova</h4>
                    <p style="font-color: grey; font-size: 10px;">12:18</p>
                    <p style="font-size: 10px;"><a href="#">jstrozer</a></p>
                    <hr>
                    <p>Tukaj je primer paragrafa, ki opisuje bla bla bla bla bla</p>
                </div>
                <div id="post-1" class="tabCloud">
                    <h4>Primer naslova</h4>
                    <p style="font-color: grey; font-size: 10px;">12:18</p>
                    <p style="font-size: 10px;"><a href="#">jstrozer</a></p>
                    <hr>
                    <p>Tukaj je primer paragrafa, ki opisuje bla bla bla bla bla</p>
                </div>
                <div id="post-2" class="tabCloud">
                    <h4>Primer naslova</h4>
                    <p style="font-color: grey; font-size: 10px;">12:18</p>
                    <p style="font-size: 10px;"><a href="#">jstrozer</a></p>
                    <hr>
                    <p>Tukaj je primer paragrafa, ki opisuje bla bla bla bla bla</p>
                </div>
            </div>
            <div id="communitySection">
                <div id="tabSuggestedCommunities" class="tabCloud">
                    <h4>Predlagane skupine</h4>
                    <hr>
                    <div class="tabCloud">
                        <h5 style="font-weight: bold;">Živali</h5>
                        <p>Število sledilcev: 513</p>
                        <button type="button">Sledi</button>
                        
                    </div>
                    <div class="tabCloud">
                        <h5 style="font-weight: bold;">Python</h5>
                        <p>Število sledilcev: 1.2k</p>
                        <button type="button">Sledi</button>
                        
                    </div>
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
</html>