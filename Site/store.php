<?php
    session_start();
?>

<html>
    <head>
        <title>Supervillian Staffing Services - Store</title>
        <link rel="stylesheet" type="text/css" href="lib/css/styles.css?<?php echo time(); ?>" />
    </head>
    <body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST['filter'] == "a") {
                    // SELECTS
                    $_SESSION['output'] = "Output a";
                }
                else if ($_POST['filter'] == "b") {
                    // SELECTS
                    $_SESSION['output'] = "Output b";
                }
            } else {
                // DEFAULT SELECTS
                $_SESSION['output'] = "Default";
            }
        ?>
        
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" name = "henchmen">
            <div class = "main">
                <!--HEADER-->
                <div class = "header">
                    <h1 class = "center">Henchmen Shop</h1>
                </div>
                <div class = "parentDiv">
                    <!--LEFT MENU-->
                    <div class = "sidebarContainer">
                        <div class = "sidebar">
                            <b>Filter by</b><br>
                            <input type="radio" name="filter" value="a">a<br>
                            <input type="radio" name="filter" value="b">b<br><br>
                            
                            <div class = "center"><input type = "submit" name = "filter" value = "Filter"></div>
                        </div>
                    </div>
                    <!--CONTENT-->
                    <div class = "contentContainer">
                        <div class = "content">
                            Content...<br>
                            <?php echo $_SESSION['output']; ?>
                        </div>
                    </div>
                </div>
                <!--CART-->
                <div class = "footer">
                    <h2 class = "center">Cart</h2>
                </div>
            </div>
        </form>
    </body>
</html>