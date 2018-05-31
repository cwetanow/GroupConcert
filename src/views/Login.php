<!DOCTYPE HTML>
<html>
    <head>
        <title>GroupConcert - Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                        <header id="header">
                            <h1 class="logo" id="login-title">Login</h1>
                        </header>
                        <section id="login-banner" class="banner">
                            <form method="post" action="../controllers/Login.php">
                                <div class="row uniform" id="login-inputs">
                                    <div class="8u 12u$(xsmall)">
                                        <input type="text" name="username" id="username" placeholder="Username" required />
                                        <div class="error">
                                            <?php if(isset($_GET['username']) && $_GET['username']):?>
                                                Username is required.
                                            <?php endif?>
                                        </div>
                                    </div>
                                    <div class="8u 12u$(xsmall)">
                                        <input type="password" name="password" id="password" placeholder="Password" />
                                        <div class="error">
                                            <?php if(isset($_GET['password']) && $_GET['password']):?>
                                                Password is required.
                                            <?php endif?>
                                        </div>
                                    </div>
                                    <div class="8u 12u$">
                                        <ul id="login-actions" class="actions">
                                            <li><input type="submit" value="Login" class="special" /></li>
                                            <li><input type="reset" value="Reset" /></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </section>
                </div>
            </div>

            <div id="sidebar">
                <div class="inner">
                        <section id="search" class="alt">
                            <h2>Group Concert</h2>
                        </section>

                        <nav id="menu">
                            <header class="major">
                                <h2>Menu</h2>
                            </header>
                            <ul>
                                <li><a href="./HomepageView.php">Homepage</a></li>
                                <li><a href="./LoginView.php">Login</a></li>
                                <li><a href="./RegisterView.php">Register</a></li>
                            </ul>
                        </nav>

                        <footer id="footer">
                            <p class="copyright">&copy; Group Concert. All rights reserved.</p>
                        </footer>

                </div>
            </div>
        </div>

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/skel.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>

    </body>
</html>