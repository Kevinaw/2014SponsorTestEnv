<?php include('../config_include/connect.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Banff/2013 Pipeline Workshop Sponsor Registration</title>
        <link href="../css/asmebanffstyles.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="../jquery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="../jquery/colorbox/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="../js/regForm.php"></script>
        <script type="text/javascript">
            function CentreWindow(newpage, newname, cw, ch, scroll) {
                var centl = (screen.width - cw) / 2;
                var centt = (screen.height - ch) / 2;
                centprops = 'height=' + ch + ',width=' + cw + ',top=' + centt + ',left=' + centl + ',scrollbars=yes,resizable'
                centwin = window.open(newpage, newname, centprops)
                if (parseInt(navigator.appVersion) >= 4) {
                    centwin.window.focus();
                }
            }
        </script>
        <link href="../jquery/colorbox/colorbox.css" rel="stylesheet" type="text/css">
        <link href="../css/regform.css" rel="stylesheet" type="text/css">
        <link href="../css/reports.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div id="content">
                <div id="regarea">
                    <p><a href="index.php">Back to reports index</a></p>
                    <?php
// -------------------------------------------------
// Written for IPC by Heidi at id associates
// On: On Summer Solstice!! 2006
// Why: Report amounts
// -------------------------------------------------

                    $showresults = "all";
                    $ordering = $_POST['ordering'];
                    if (!isset($_POST['orderit'])) {
                        $orderby = "sid";
                    } else {
                        $orderby = $_POST['orderit'];
                    }
                    $ordering = $_POST['ordering'];
                    if (!isset($_POST['ordering'])) {
                        $ordering = "asc";
                        $orderascdesc = " asc ";
                    } else {
                        $orderascdesc = " " . $_POST['ordering'] . " ";
                    }
                    ?>
                    <form method='post' action='' name='report' ENCTYPE='multipart/form-data' >
                        <h1>Quick Stats </h1>
                        <?php
                        //////////////////////// grand totals all months ///////////////////////////////////
                        $totalpaid = "SELECT *, COUNT(paytype), SUM(totalpaid) FROM $tablesponsor WHERE paytype!='' and paytype!='MAIL'  GROUP BY paytype ORDER BY paytype";
                        $totalpaidResult = mysql_query($totalpaid) or die(mysql_error());
                        $totalpaidNum = mysql_num_rows($totalpaidResult);

                        // Print out result
                        while ($gtrow = mysql_fetch_array($totalpaidResult)) {
                            ${$gtrow['paytype']} = $gtrow['COUNT(paytype)'];
                            ${$gtrow['paytype'] . "TOTAL"} = $gtrow['SUM(totalpaid)'];

                            $activeGTsums = floatval(${$gtrow['paytype'] . "TOTAL"});
                            $activeGTTotal = $activeGTTotal + $activeGTsums;

                            $activeGTSummaries .= '
	<tr>
		<td bgcolor="#D6E8CE"><p>' . $gtrow['paytype'] . '</p></td>
		<td align="center" bgcolor="#D6E8CE"><p>' . ${$gtrow['paytype']} . '</p></td>
		<td align="right" bgcolor="#D6E8CE"><p>' . sprintf("%01.2f", ${$gtrow['paytype'] . "TOTAL"}) . '</p></td>
	</tr>';
                        }

///////////////////////////////////////////////////////////////////////////////////////////
                        ?>

                        <table border="0" cellpadding="5" cellspacing="3">
                            <tr>
                                <td colspan="3" bgcolor="#99F58A"><p><strong>Payment Summaries</strong></p></td>
                            </tr>
                            <tr>
                                <td bgcolor="#D6F5BC"><p>Transaction Type</p></td>
                                <td bgcolor="#D6F5BC"><p>Number of Transactions</p></td>
                                <td bgcolor="#D6F5BC"><p>Total ($)</p></td>
                            </tr>
                            <?php echo $activeGTSummaries; ?>
                            <tr>
                                <td colspan="2" align="right" bgcolor="#D6F5BC"><p>TOTAL: &nbsp;</p></td>
                                <td align="right" bgcolor="#D6F5BC"><p><?php echo sprintf("%01.2f", $activeGTTotal); ?></p></td>
                            </tr>
                        </table>

                        <?php
 
//////////////////////// pull records to view and sort through ///////////////////////////////////
                        $recordsperpage = 100;
                        $pagenum = $_POST['pagenum'];
                        if ($pagenum == "") {
                            $pagenum = 0;
                        } else {
                            $pagenum = $pagenum - 1;
                        }
                        $nextrecords = $pagenum * $recordsperpage;

                        $selectTotal = "SELECT * FROM $tablesponsor WHERE paytype!='' and paytype!='MAIL' ";
                        $resultTotal = mysql_query($selectTotal) or die(mysql_error());
                        $resultNum = mysql_num_rows($resultTotal);

                        $numPages = ceil($resultNum / $recordsperpage);
                        $pagenav = "<table width=\"100%\"><tr><td><h3>Display Page: ";

                        for ($i = 1; $i <= $numPages; $i++) {
                            if ($i != ($pagenum + 1)) {
                                $pagenav .= "<a href=\"#\" onClick=\"document.report.pagenum.value=";
                                $pagenav .= $i;
                                $pagenav .= "; document.report.submit();\">";
                            }
                            $pagenav .= $i;
                            if ($i != $pagenum + 1) {
                                $pagenav .= "</a>";
                            }
                            $pagenav .= " &nbsp;";
                        }

                        $pagenav .= "</h3></td></tr></table>";

                        $query3 = "SELECT * FROM $tablesponsor WHERE paytype!='' and paytype!='MAIL' ORDER BY " . $orderby . " " . $orderascdesc . " LIMIT $nextrecords,$recordsperpage";
                        $result3 = mysql_query($query3) or die(mysql_error());


                        $goodrecords = array();

                        while ($reg = mysql_fetch_array($result3)) {
                            array_push($goodrecords, $reg);
                        }
                        $goodrecordsnum = sizeof($goodrecords);
                        ?>
                        <input name="pagenum" type="hidden" value="">

                        
                        
                        <h2>Page will automatically refresh when you make your selection.</h2>
                        <h3><strong>Registrant Summaries</strong></h3>
                        <p><strong>Show:</strong> 
                            <input name="showresults" type="radio" id="showresults"  onclick="document.report.submit();" value="all"  <?php
                        if (!(strcmp("$showresults", "all"))) {
                            echo "checked=\"checked\"";
                        }
                        ?>>
                            All Registrations&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
</p>
                        <p><strong>Sort Results by:</strong> 
                            <input <?php
                            if (!(strcmp("$orderby", "sid"))) {
                                echo "checked=\"checked\"";
                            }
                        ?> name="orderit" type="radio" id="invoicenum" value="vid" onclick="document.report.submit();">
                            Invoice #&nbsp;&nbsp;
                            <input <?php
                            if (!(strcmp("$orderby", "lname,fname"))) {
                                echo "checked=\"checked\"";
                            }
                        ?> type="radio" name="orderit" id="invoicenum2" value="lname,fname" onclick="document.report.submit();">
                            Last Name
                            &nbsp;&nbsp;
                            <input <?php
                            if (!(strcmp("$orderby", "totalpaid"))) {
                                echo "checked=\"checked\"";
                            }
                        ?> type="radio" name="orderit" id="invoicenum3" value="totalpaid" onclick="document.report.submit();">
                            Total Paid
                            &nbsp;&nbsp;
                            <input <?php
                            if (!(strcmp("$orderby", "totaldue"))) {
                                echo "checked=\"checked\"";
                            }
                        ?> type="radio" name="orderit" id="invoicenum4" value="totaldue" onclick="document.report.submit();"> 
                            Total Owing&nbsp;&nbsp;
                            <input <?php
                            if (!(strcmp("$orderby", "paytype"))) {
                                echo "checked=\"checked\"";
                            }
                        ?> type="radio" name="orderit" id="invoicenum5" value="paytype" onClick="document.report.submit();">
                            Pay Type  </p>
                        <p><strong>Order Results by:</strong> 
                            <input <?php
                            if (!(strcmp("$ordering", "asc"))) {
                                echo "checked=\"checked\"";
                            }
                        ?> name="ordering" type="radio" id="radio" value="asc" onclick="document.report.submit();">
                            ascending 
                            <input  <?php
                            if (!(strcmp("$ordering", "desc"))) {
                                echo "checked=\"checked\"";
                            }
                        ?> name="ordering" type="radio" id="radio2" value="desc" onclick="document.report.submit();">
                            descending</p>
                        <?php echo $pagenav; ?>
                        <table width="100%" border="0" cellpadding="5" cellspacing="3">
                            <tr>
                                <th bgcolor="#006600" colspan="6"><!--p><strong>Active Registrations</strong> (Pending Records in Blue)</p--></th>
                            </tr>
                            <?php for ($i = 0; $i < $goodrecordsnum; $i++) {
                                ?>
                                <tr bgcolor="#<?php
                            if ($goodrecords[$i]['paytype'] != "") {
                                echo "D6F5BC";
                            } else {
                                echo "66CCFF";
                            }
                                ?>">
                                    <td valign="top"><p><strong>Invoice #: <?php echo $goodrecords[$i]['sid']; ?></strong></p></td>
                                    <td valign="top"><p><?php echo $goodrecords[$i]['lname'] . ", " . $goodrecords[$i]['fname']; ?></p></td>
                                    <td valign="top"><p><strong>Paid: <?php echo $goodrecords[$i]['totalpaid']; ?></strong></p></td>
                                    <td valign="top"><p><strong>Owing: <?php echo $goodrecords[$i]['totaldue']; ?></strong></p></td>
                                    <td valign="top"><p><strong>Payment Type: </strong><?php echo $goodrecords[$i]['paytype']; ?> <br></p></td>
                                    <td ><p><a href="showInvoice.php?vid=<?php echo $goodrecords[$i]['sid']; ?>" target="_blank">View Invoice</a></p></td>
                                </tr>

                                <tr>
                                    <td colspan="6"><hr></td>
                                </tr>
                            <?php } ?>





                            <tr>
                                <td colspan="6"><hr></td>
                            </tr>

                            <tr>
                                <td colspan="6" ><?php echo $pagenav; ?></td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr></td>
                            </tr>
 
                        </table>
                        <p>&nbsp;</p>
                        <p>&nbsp;&nbsp;&nbsp;</p>
                    </form>
                    <?php
                    mysql_close($link);
                    ?>
                </div>
            </div>
            <div id="footer">
                <p>&nbsp;</p>
            </div>
        </div>
    </body>
</html>
