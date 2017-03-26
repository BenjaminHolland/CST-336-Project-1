<?php
    session_start();
    include 'lib/data/Context.php';
    $context=new Context();
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
                // DEFAULT
                $hench = $context->getAvailableHenchpeople();
                var_dump($hench);
                echo $hench[0];
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
                            <table>
                                <tr>
                                    <td class = "title">Name</td>
                                    <td class = "title">Speciality</td>
                                    <td class = "title">Description</td>
                                    <td class = "title">Contract</td>
                                </tr>
                            </table>
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