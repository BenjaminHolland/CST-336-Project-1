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
                if ($_POST['sort'] == "id") {
                    $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_ID);
                }
                else if ($_POST['sort'] == "name") {
                    $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_TITLE);
                }
                else if ($_POST['sort'] == "skillCount") {
                    $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_SKILL_COUNT);
                }
            } else {
                $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_TITLE);
            }
        ?>
        <main id="accordion" class = "outerPadding">
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
                            <b>Sort by</b><br>
                            <input type="radio" name="sort" value="id">Henchmen ID<br>
                            <input type="radio" name="sort" value="name">Henchmen Name<br>
                            <input type="radio" name="sort" value="skillCount">Henchmen Skills<br><br>
                            
                            <div class = "center"><input type = "submit" value = "sort"></div>
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
                                
                                <?php
                                    echo "<tr>";
                                    for($hench = 0; $hench < sizeof($henchpeople); $hench++) {
                                        echo "<td class = 'data'>" . $henchpeople[$hench]->Name . "</td>";
                                        echo "<td class = 'data'>";
                                        foreach ($henchpeople[$hench]->Specialities as $speciality) {
                                            echo $speciality;
                                        }
                                        echo "</td>";
                                        
                                        echo "<td class = 'data'>";
                                        echo "<section id='item$hench'>";
                                        echo "<a href='#item$hench'>Expand</a>";
                                        echo "<span>" . $henchpeople[$hench]->Description . "</span>";
                                        echo "</section>";
                                        echo "</td>";
                                        
                                        echo "<td class = 'data'>Button</td>";
                                    }
                                    echo "</tr>";
                                ?>
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
        </main>
    </body>
</html>