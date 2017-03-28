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
                else {
                    $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_TITLE);
                }
                
                for($hench = 0; $hench < sizeof($henchpeople); $hench++) {
                    $id = $henchpeople[$hench]->Id;
                    if($_POST[$id] == 'Add') {
                        $duplicate = false;
                        for($doop = 0; $doop < sizeof($_SESSION['cart']); $doop++) {
                            if($id == $_SESSION['cart'][$doop][0]) {
                                $duplicate = true;
                            }
                        }
                        if($duplicate == false) {
                            $tempHench = array();
                            $tempSpec = array();
                            foreach($henchpeople[$hench]->Specialities as $speciality) {
                                array_push($tempSpec, $speciality);
                            }
                            array_push($tempHench, $henchpeople[$hench]->Id, $henchpeople[$hench]->Name, $tempSpec, $henchpeople[$hench]->Description);
                            array_push($_SESSION['cart'], $tempHench);
                        }
                    }
                }
                
            } else {
                $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_TITLE);
                $_SESSION['cart'] = array();
            }
            $_SESSION['henchpeople'] = $henchpeople;
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
                            <input type="radio" name="sort" value="skillCount">Number of Skills<br><br>
                            
                            <div class = "center"><input type = "submit" value = "Sort"></div>
                        </div>
                    </div>
                    <!--CONTENT-->
                    <div class = "contentContainer">
                        <div class = "content">
                            <table>
                                <tr>
                                    <td class = "title">Name</td>
                                    <td class = "title">ID</td>
                                    <td class = "title">Speciality</td>
                                    <td class = "title">Description</td>
                                    <td class = "title">Contract</td>
                                </tr>
                                
                                <?php
                                    for($hench = 0; $hench < sizeof($henchpeople); $hench++) {
                                        if($hench % 2 == 0)
                                            echo "<tr style = 'background-color: #d1ffe3'>";
                                        else
                                            echo "<tr>";
                                        echo "<td style = 'padding-left: 10px'>" . $henchpeople[$hench]->Name . "</td>";
                                        echo "<td class = 'data'>" . $henchpeople[$hench]->Id . "</td>";
                                        echo "<td style = 'padding-left: 10px'>";
                                        foreach ($henchpeople[$hench]->Specialities as $speciality) {
                                            echo $speciality . " ";
                                        }
                                        echo "</td>";
                                        
                                        echo "<td class = 'data'>";
                                        echo "<section id='item$hench'>";
                                        echo "<a href='#item$hench'>Expand</a>";
                                        echo "<span>" . $henchpeople[$hench]->Description . "</span>";
                                        echo "</section>";
                                        echo "</td>";
                                        
                                        $name = $henchpeople[$hench]->Id;
                                        
                                        echo "<td class = 'data'><input type = 'checkbox' name = '$name' value = 'Add'></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </table>
                            <div class = "center padding"><input type = "Submit"/></div>
                        </div>
                    </div>
                </div>
                <!--CART-->
                <div class = "footer">
                    <h2 class = "center">Cart</h2>
                    <div style = "padding: 10px">
                    <table>
                        <tr>
                            <td class = "title">Name</td>
                            <td class = "title">ID</td>
                            <td class = "title">Speciality</td>
                            <td class = "title">Description</td>
                        </tr>
                        <?php
                            for($hench = 0; $hench < sizeof($_SESSION['cart']); $hench++) {
                                if($hench % 2 == 0)
                                    echo "<tr style = 'background-color: #d1ffe3'>";
                                else
                                    echo "<tr>";
                                echo "<td style = 'padding-left: 10px'>" . $_SESSION['cart'][$hench][1] . "</td>";
                                echo "<td class = 'data'>" . $_SESSION['cart'][$hench][0] . "</td>";
                                echo "<td style = 'padding-left: 10px'>";
                                foreach ($_SESSION['cart'][$hench][2] as $speciality) {
                                    echo $speciality . " ";
                                }
                                echo "</td>";
                                echo "<td style = 'padding-left: 10px'>" . $_SESSION['cart'][$hench][3] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <?php
                        if(sizeof($_SESSION['cart']) == 0)
                            echo "<br><b>Empty</b>";
                    ?>
                    </div>
                </div>
            </div>
        </form>
        </main>
    </body>
</html>