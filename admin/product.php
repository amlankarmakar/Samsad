<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();


if (isset($_POST["delete"]))
{
    if (isset($_POST["check"]))
    {
        foreach ($_POST["check"] as $value)
        {
            $table_name = "product";
            $where = "unique_id='" . $value . "'";
            $database->delete_data($table_name, $where);
        }
        echo '<script>alert("Selected product has been deleted")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=product.php'>");
    }
    else
    {
        echo '<script>alert("Please select product to delete")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=product.php'>");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Products</title>
    <?php
    require_once('design/header_script.php');
    ?>
</head>
<body>
<div id="main_container">

    <div class="header">
        <div class="logo">
            <img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;"/>
        </div>


        <?php require("design/nav.php"); ?>

        <div class="center_content" style="height:80%">

            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-archive" aria-hidden="true"></i> PRODUCT</h2>
                </div>
            </div>

            <div class="row">
                <form name="product_form" action="#" method="post">
                    <?php

                    echo '<button class="btn btn-danger" name="delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete Item</button>&nbsp';
                    echo '<a href="add-new-product.php" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add New Item</a>';

                    ?>
                    <table id="product" class="table table-striped table-condensed" width="98%">
                        <thead>
                        <tr align="center">
                            <th scope="col" class="rounded-company">xx</th>
                            <th scope="col" class="rounded">Image</th>
                            <th scope="col" class="rounded">Product Name</th>
                            <th scope="col" class="rounded">Author</th>
                            <th scope="col" class="rounded">Price</th>
                            <th scope="col" class="rounded">Inventory</th>
                            <th scope="col" class="rounded">Status</th>
                            <th scope="col" class="rounded-q4">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr align="center">
                            <th scope="col" class="rounded-company">xx</th>
                            <th scope="col" class="rounded">Image</th>
                            <th scope="col" class="rounded">Product Name</th>
                            <th scope="col" class="rounded">Author</th>
                            <th scope="col" class="rounded">Price</th>
                            <th scope="col" class="rounded">Inventory</th>
                            <th scope="col" class="rounded">Status</th>
                            <th scope="col" class="rounded-q4">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php


                        $query = "SELECT * FROM product ORDER By id DESC ";
                        $result = mysql_query($query);

                        if (1)
                        {
                            while ($row = mysql_fetch_array($result))
                            {
                                $p_image_link = $row["p_image_link"];
                                $p_name = $row["p_name"];
                                $p_author = $row["p_author"];
                                $p_price = $row["p_price"];
                                $p_inventory = $row["p_inventory"];
                                $p_status = $row["p_status"];
                                $p_unique_id = $row["unique_id"];
                                $p_sub_cat = $row["p_sub_category"];

                                if (empty($p_image_link))
                                {
                                    $p_image_link = "../product_images/no_image.jpg";
                                }
                                else
                                {
                                    $p_image_link = "../" . $row["p_image_link"];
                                }

                                if (empty($p_price))
                                {
                                    $p_price = 0;
                                }
                                if ($p_status == 0)
                                {
                                    $s = "Enable";
                                }
                                else
                                {
                                    $s = "Disabled";
                                }

                                echo '<tr align="center">';
                                echo '<td><input type="checkbox" name="check[]" value="' . $p_unique_id . '"/></td>';
                                echo '<td><img src="' . $p_image_link . '" alt="" title="" border="0" draggable="false" onmousedown="return false;" hight="50px" width="50px"/></a></td>';
                                echo '<td width="15%">' . $p_name . '</td>';
                                echo '<td width="20%">' . $p_author . '</td>';
                                echo '<td>Rs ' . $p_price . '</td>';
                                echo '<td>' . $p_inventory . '</td>';
                                echo '<td>' . $s . '</td>';
                                echo '<td><a class="btn btn-sm btn-info" href="edit-product.php?p_uid=' . $p_unique_id . '&p_sub_cat=' . $p_sub_cat . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>';
                                echo '</tr>';
                            }
                        }

                        else
                        {
                            echo '<tr align="center">';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td width="15%">&nbsp;</td>';
                            echo '<td width="20%">&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '</tr>';
                        }

                        ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>   <!--end of center content -->

        <div class="clear"></div>
        <!--end of main content-->

        <?php require("design/footer.php"); ?>

    </div>
</body>
<script>
    $(document).ready(function ()
    {
        $('#product').DataTable();
    });
</script>
</html>