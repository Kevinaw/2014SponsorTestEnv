<?php
session_start();
while (list ($key, $val) = each($_POST)) {
    //  if ($val){
    $$key = $val;
    //echo $key.": ".$$key."<br>";
    //	}
}
$closeit = date('Y-m-d');
$postnum = sizeof($_POST);
$getnum = sizeof($_GET);
if (!isset($_SESSION['registrationStep'])) {
    header('Location: error.php?noSession=true');
    die();
} else if ($closeit > '2015-05-12') {
    header('Location: closed.php');
    die();
} else if ($postnum == 0 && $getnum == 0) {
    header('Location: error.php?noPostRecords=0');
    die();
} else {

// -------------------------------------------------
// Written for IPC by Heidi at id associates
// On: Some hot July day in 2004
// Why: This form grabs reg data from the form
// -------------------------------------------------
    include('config_include/connect.php');
    include('config_include/eventVariables.php');
    include('config_include/gatewayConfig.php');
    $insertArray = array();
    reset($_POST);
    echo "<p>Post ///////////////////////////</p>";
    while (list ($key, $val) = each($_POST)) {
        //  if ($val){
        $$key = $val;
        echo $key . ": " . $$key . "<br>";
        if ((substr($$key, 0, 2) == "TU" || substr($$key, 2, 2) === "WG") && $val != "" && $key != "regType") {
            array_push($insertArray, mysql_real_escape_string($$key));
            //echo "<p>set A $key for insert</p>";
        } else if ($key == "amazing" && $val != "") {
            //echo "<p>set B $key for insert</p>";
            array_push($insertArray, "AMZWLK");
        }
        //	}
    }
    echo "<p>GET ///////////////////////////</p>";
    while (list ($key, $val) = each($_GET)) {
        //  if ($val){
        $$key = $val;
        //echo $key.": ".$$key."<br>";
        if (substr($$key, 0, 2) == "TU" || substr($$key, 2, 2) === "WG") {
            array_push($insertArray, mysql_real_escape_string($$key));
        } else if ($key == "amazing") {
            array_push($insertArray, "AMZWLK");
        }
        //	}
    }
    $insertArrayL = sizeof($insertArray);

    echo "<p>SESSION ///////////////////////////</p>";
    while (list ($key, $val) = each($_SESSION)) {
        //  if ($val){
        $$key = $val;
        echo $key . ": " . $$key . "<br>";
        //	}
    }




    if (!isset($billing_check)) {
        $billing = "No";
    }
    if (isset($regType) && $regType != "") {
        $funccode = $regType;
    } else {
        $funccode = "";
    }

//include('includes/formPosts.php');
    if ($country == "NG") {
        header('Location: nigerianRegistration.php');
        die();
    }

    if (!$vid) {
        $checkvid = "NO";
        // time to insert
        // first timers with on VID
        $totalpaid = number_format(0, 2);
        $totalcharged = number_format($totalcharged, 2);
        $totaldue = $totalcharged;
        $invoicedate = date('Y-m-d');
        $paytype = '';
        if ($_SESSION['registrationStep'] == 1) {
            $insertstmt = "INSERT INTO $tablesponsor 
					(sal, 
					fname, 
					lname, 
					title, 
					nickname, 
					company, 
					address1, 
					address2, 
					city, 
					state, 
					country, 
					zip, 
					phone, 
					fax, 
					email, 
					user_password, 
					billing, 
					billing_sal, 
					billing_fname, 
					billing_lname, 
					billing_company, 
					billing_title, 
					billing_address1, 
					billing_address2, 
					billing_city, 
					billing_state, 
					billing_country, 
					billing_zip, 
					billing_phone, 
					billing_fax, 
					billing_email, 
					funccode, 
					totalcharged, 
					totalpaid, 
					totaldue, 
					invoicedate, 
					paytype) 
					values 
					('" . mysql_real_escape_string($sal) . "', 
					'" . mysql_real_escape_string($fname) . "', 
					'" . mysql_real_escape_string($lname) . "', 
					'" . mysql_real_escape_string($title) . "',
					 '" . mysql_real_escape_string($nickname) . "', 
					 '" . mysql_real_escape_string($company) . "', 
					 '" . mysql_real_escape_string($address1) . "',
					  '" . mysql_real_escape_string($address2) . "', 
					  '" . mysql_real_escape_string($city) . "', 
					  '" . mysql_real_escape_string($state) . "', 
					  '" . mysql_real_escape_string($country) . "', 
					  '" . mysql_real_escape_string($zip) . "', 
					  '" . mysql_real_escape_string($phone) . "', 
					  '" . mysql_real_escape_string($fax) . "', 
					  '" . mysql_real_escape_string($email) . "', 
					  '" . mysql_real_escape_string($user_password) . "', 
					  '" . mysql_real_escape_string($billing_check) . "', 
					  '" . mysql_real_escape_string($billing_sal) . "', 
					  '" . mysql_real_escape_string($billing_fname) . "', 
					  '" . mysql_real_escape_string($billing_lname) . "', 
					  '" . mysql_real_escape_string($billing_company) . "', 
					  '" . mysql_real_escape_string($billing_title) . "', 
					  '" . mysql_real_escape_string($billing_address1) . "', 
					  '" . mysql_real_escape_string($billing_address2) . "', 
					  '" . mysql_real_escape_string($billing_city) . "', 
					  '" . mysql_real_escape_string($billing_state) . "', 
					  '" . mysql_real_escape_string($billing_country) . "', 
					  '" . mysql_real_escape_string($billing_zip) . "', 
					  '" . mysql_real_escape_string($billing_phone) . "', 
					  '" . mysql_real_escape_string($billing_fax) . "', 
					  '" . mysql_real_escape_string($billing_email) . "', 
					  '" . mysql_real_escape_string($funccode) . "', 
					  '" . mysql_real_escape_string($totalcharged) . "', 
					  '" . mysql_real_escape_string($totalpaid) . "', 
					  '" . mysql_real_escape_string($totaldue) . "', 
					  '" . mysql_real_escape_string($invoicedate) . "', 
					  '" . mysql_real_escape_string($paytype) . "')";
            echo "<p>$insert</p>";
            $insresult = mysql_query($insertstmt) or die("Insert Query failed due to this error: " . mysql_error() . ". <BR><BR>The query data is: " . $insertstmt);
            //$_SESSION['registrationStep']=2;
            //echo $_SESSION['registrationStep'];
        }
        // get vid to insert detail records

        $selectStmt = "SELECT max(vid) as vid FROM $tablesponsor WHERE lname = '" . mysql_real_escape_string($lname) . "' AND company = '" . mysql_real_escape_string($company) . "' AND totalcharged = '" . mysql_real_escape_string($totalcharged) . "'";

        $selectresult = mysql_query($selectStmt) or die("Picking VID Query failed : " . mysql_error() . "<BR><BR>The statement being executed is: " . $selectStmt);

        $row = mysql_fetch_array($selectresult);

        $vid = $row['vid'];
        $paytype = $row['paytype'];


        if ($_SESSION['registrationStep'] == 1) {
            // add invoice number to profile if it exists
            if ($user_password != "") {
                $updateprofile = "update $tableprofile set invoicenum='800$vid' where id='$user_password'";
                $updateprofileR = mysql_query($updateprofile) or die("There was an error updating your login with the invoice number.<br>" . mysql_error() . "<br>$updateprofile");
            }
            // insert statements
            include('includes/insertStmts.php');
        }
    } else {
        $newone = '1';
        $itWentOK = 0;
        $holdid = $vid;
        //if($totalpaid){
        // grab payment history
        $payselect = "SELECT * from $tablePaymentSponsor where vid = '$vid'";
        //echo "<p>$payselect</p>";
        $payresult = mysql_query($payselect) or die("select query failed due to this error: " . mysql_error() . " . <br><br>The query data is: " . $payselect);
        $adjust = 0;
        $totals = 0;

        while ($pays = mysql_fetch_array($payresult)) {
            if ($pays['transaction_type'] == "CNCLFEE" || $pays['transaction_type'] == "RFNDFEE") {
                $adjust = $adjust + $pays['pay_amount'];
            }
            $totals = $totals + $pays['pay_amount'];
        }

        // calculate invoice amounts
        //$newtotalpaid = $totals;

        $totaldue = $totalcharged - $totals + $adjust;

//		$newtotalpaid = sprintf("%01.2f",$newtotalpaid);
//		$newtotalcharged = sprintf("%01.2f",$newtotalcharged);
        //$totaldue = $totalcharged - $totalpaid;
        //}		
        $invoicedate = date('Y-m-d');
        $pullstatus = "SELECT reg_status, paytype FROM $tablesponsor where vid='$vid'";
        $thestatus = mysql_query($pullstatus) or die("The record could not be found, error: " . mysql_error());
        $getstatus = mysql_fetch_array($thestatus);
        $regstatus = $getstatus['reg_status'];
        $paytype = $getstatus['paytype'];

        if (isset($_SESSION['registrationStep']) && $_SESSION['registrationStep'] == 3) {
            // didn't receive post data so pull it from db
            $getrecord = "select * from $tablesponsor where vid='$vid'";
            $getrecordresult = mysql_query($getrecord) or die("There was an error retrieving the registrant information");
            $recordset = mysql_fetch_assoc($getrecordresult);

            while (list ($key, $val) = each($recordset)) {
                if ($val)
                    $$key = $val;
                //echo $key.": ".$$key."<br>";
            }
        } else {

            $updatestmt = "UPDATE $tablesponsor SET sal = '" . mysql_real_escape_string($sal) . "', fname = '" . mysql_real_escape_string($fname) . "', lname = '" . mysql_real_escape_string($lname) . "', title = '" . mysql_real_escape_string($title) . "', nickname = '" . mysql_real_escape_string($nickname) . "', company = '" . mysql_real_escape_string($company) . "', address1 = '" . mysql_real_escape_string($address1) . "', address2 = '" . mysql_real_escape_string($address2) . "', city = '" . mysql_real_escape_string($city) . "', state = '" . mysql_real_escape_string($state) . "', country = '" . mysql_real_escape_string($country) . "', zip = '" . mysql_real_escape_string($zip) . "', phone = '" . mysql_real_escape_string($phone) . "', fax = '" . mysql_real_escape_string($fax) . "', email = '" . mysql_real_escape_string($email) . "', user_password = '" . mysql_real_escape_string($user_password) . "', billing = '" . mysql_real_escape_string($billing_check) . "', billing_sal = '" . mysql_real_escape_string($billing_sal) . "', billing_fname = '" . mysql_real_escape_string($billing_fname) . "', billing_lname = '" . mysql_real_escape_string($billing_lname) . "', billing_company = '" . mysql_real_escape_string($billing_company) . "', billing_title = '" . mysql_real_escape_string($billing_title) . "', billing_address1 = '" . mysql_real_escape_string($billing_address1) . "', billing_address2 = '" . mysql_real_escape_string($billing_address2) . "', billing_city = '" . mysql_real_escape_string($billing_city) . "', billing_state = '" . mysql_real_escape_string($billing_state) . "', billing_country = '" . mysql_real_escape_string($billing_country) . "', billing_zip = '" . mysql_real_escape_string($billing_zip) . "', billing_phone = '" . mysql_real_escape_string($billing_phone) . "', billing_fax = '" . mysql_real_escape_string($billing_fax) . "', billing_email = '" . mysql_real_escape_string($billing_email) . "', funccode = '" . mysql_real_escape_string($funccode) . "', totalcharged = '" . mysql_real_escape_string($totalcharged) . "', totalpaid = '" . mysql_real_escape_string($totalpaid) . "', totaldue = '" . mysql_real_escape_string($totaldue) . "', invoicedate = '" . mysql_real_escape_string($invoicedate) . "' WHERE '$vid' = vid ";
            mysql_query($updatestmt) or die("The main update statement failed to execute with error: " . mysql_error() . ". <BR><BR>The statement is: " . $updatestmt);
            //echo "<p>$updatestmt</p>";

            $selectDetails = "select * from $tabledetailname where vid = '$vid'";
            $deresult = mysql_query($selectDetails) or die("The collection of old detail records statement failed with error: " . mysql_error());

            $denum = mysql_num_rows($deresult);
            while ($deline = mysql_fetch_array($deresult)) {
                // insert old detail records in the hold detail table for safe keeping
                $insertstmt = "INSERT INTO $holddetail (id, vid, funccode, charged, date_changed) values ('" . $deline['id'] . "','" . $deline['vid'] . "','" . $deline['funccode'] . "','" . $deline['charged'] . "', '" . date('Y-m-d') . "')";
                mysql_query($insertstmt) or die("The holddetail statement failed to execute with error: " . mysql_error() . " the statement that failed was: " . $insertstmt);
                // once they are safe in the hold detail table you can delete them
                $id = $deline["id"];
                $deletestmt = "delete from $tabledetailname where id = '$id'";
                mysql_query($deletestmt) or die("The delete statement failed to execute with error: " . mysql_error() . "<BR<BR>The statement that failed was: " . $deletestmt);
                // good news everyone
                $itWentOK = 1;
            } // while statement end
            if ($denum == 0) {
                $itWentOK = 1;
            }
            if ($itWentOK == 1) {
                // insert new records
                include('includes/insertStmts.php');
            }
            //decide what to print
            $vid = $holdid;
        }
    }

    if ($amazing == "Yes") {
        $funccost = number_format($totalcharged - 30, 2);
    } else {
        $funccost = $totalcharged;
    }

    if (isset($promoCode) && $promoCode != "") {
        // check if they need to pay for Amazing Walk

        if ($amazing == "Yes") {
            $totaldue = number_format($totaldue - 200, 2);
            $totalcharged = number_format($totalcharged - 200, 2);
            $funccost = "0.00";
        } else {
            $totaldue = "0.00";
            $totalcharged = "0.00";
            $funccost = "0.00";
        }

        echo "$$totaldue";
        echo "$$totalcharged";
        $today = date('Y-m-d');

        // sanitize our promo code
        $promoCode = mysql_real_escape_string($promoCode);
        // start processing promo code
        $psel = "select * from $tablepromo where promoCode='$promoCode' order by id desc limit 1";
        $pres = mysql_query($psel) or die("There was an error retrieving the promotion code" . mysql_error());
        $n = mysql_num_rows($pres);
        if ($n != 1) {
            $promomessage = "<h2 class=\"red\">The Promotional Code was not valid.</h2><p class=\"red\"><strong>If you believe this is in error, click the Make Changes button below and re-enter your promotional code.<br />If you continue to have problems, contact support at <a href=\"mailto:support@idassociates.ab.ca?Subject=Banff/2013 Pipeline Workshop - Trouble with Promotional Code\">support@idassociates.ab.ca</a></strong>";
        } else {
            // code was found, start processing
            $promo = mysql_fetch_array($pres);
            $pid = $promo['id'];
            $penable = $promo['enabled'];
            $pinv = $promo['invoice'];

            if (!$penable) { // not enabled
                $promomessage = "<h2>The promotion code is no longer valid.</h2><p>If you believe this is in error, click the Make Changes button below and re-enter your promotional code.</p>";
            } else if ($pin != "" && $pinv != $vid) { // already redeemed
                // code was used by some one else
                $promomessage = "<h2>This Promotional Code has already been redeemed.</h2><p>If you received multiple Promotional Codes, you can click the Make Changes button below and enter a new Promotional Code.</p><p>If you continue to have trouble, contact support at <a href=\"mailto:support@idassociates.ab.ca?Subject=Banff/2013 Pipeline Workshop - Trouble with Promotional Code\">support@idassociates.ab.ca</a></p>";
            } else if ($pinv == "" && $penable) { // code is good and hasn't been used yet
                // hasn't been used, process promo code
                // update promo record and mark with the invoice number
                $pupdate = "update $tablepromo set invoiceSponsor='$vid' where id='$pid'";
                $pupres = mysql_query($pupdate) or die("There was an error updating the promotion code." . mysql_error());

                // update registrant information to zero out total charged and total due
                $vupdate = "update $tablesponsor set totalcharged='$totalCharged', totaldue='$totaldue', datepaid='$today', paytype='PROMO' where vid='$vid'";
                $vupres = mysql_query($vupdate) or die("There was an error updating the registrant record with the promotional code. " . mysql_error());

                // insert a record into the payment table to track redeemed promo codes
                $purupdate = "insert into $tablePaymentSponsor (vid, pay_amount, date_paid, time_paid, transaction_type, response, response_id)
													values
													('$vid', '0.00', '$today', '', 'PROMO', 'APPROVED', '$promoCode')";
                $purupres = mysql_query($purupdate) or die("There was an error inserting the promotional code into the payment records. " . mysql_error());

                $promomessage = "<h2>Your Promotional Code has been successfully processed.</h2><p class=\"red\"><strong>Please note that this does not complete your registration. You must finish the process by clicking the send invoice button at the bottom of your registration summary.</strong></p>";
            } else if ($pinv == $vid) { // they have already used the promo code
                // make sure we don't reset their total owing
                $promomessage = "<h2>Your Promotional Code has been successfully processed.</h2><p class=\"red\"><strong>Please note that this doesn not complete your registration. You must finish the process by clicking the send invoice button at the bottom of your registration summary.</strong></p>";
            }
        }
    }
    $_SESSION['registrationStep'] = 2;


    $strName = $fname . " " . $lname;
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Banff/2013 Pipeline Workshop Sponsor Registration</title>
            <link href="css/asmebanffstyles.css" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="jquery/jquery-1.7.1.min.js"></script>
            <script type="text/javascript" src="jquery/colorbox/jquery.colorbox-min.js"></script>
            <script language="JavaScript" type="text/JavaScript">

                function checkPay(form) { 
                //alert(document.invoice.payOpt.value);
                if(!document.invoice.payOpt.value) {
                alert("Please choose a payment option then press the Proceed to Payment button.");
                return false;
                } else { 
                if(document.invoice.payOpt.value=="CC"){ 
                document.invoice.action="<?php echo $beanstreamTransactionAddress; ?>";
                //document.invoice.enctype="multipart/form-data";
                //document.invoice.encoding="multipart/form-data";
                } else {
                if(document.invoice.payOpt.value=="LOGOUT"){
                document.invoice.action="logout.php";
                } else if(document.invoice.payOpt.value=="cancel") {
                document.invoice.action="cancelRegistration.php";
                }
                document.invoice.enctype="multipart/form-data";
                document.invoice.encoding="multipart/form-data";
                }
                //alert(document.invoice.action);
                return true; 
                }
                }

            </script>
            <link href="jquery/colorbox/colorbox.css" rel="stylesheet" type="text/css">
            <link href="css/regform.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <div id="wrapper">
                <?php include('includes/header.php'); ?>
                <div id="content">
                    <form method='post' action='paymentChoice.php' name='invoice' onSubmit='return false'>
                        <input type='hidden' name='vid' value='<?php echo $vid; ?>'>
                        <input type='hidden' name='email' value='<?php echo $email; ?>'>
                        <input type='hidden' name='billing_email' value='<?php echo $billing_email; ?>'>
                        <input type='hidden' name='totaldue' value='<?php echo $totaldue; ?>'>
                        <input type='hidden' name='promoCode' value='<?php echo $promoCode; ?>'>
                        <input type="hidden" name="trnOrderNumber" value="BPS-<?php echo $vid; ?>">
                        <input type="hidden" name="ordName" value="<?php
                        if ($billing_fname != "" && $billing_lname != "") {
                            echo $billing_fname, " ", $billing_lname;
                        } else {
                            echo $fname, " ", $lname;
                        }
                        ?>">
                        <input type="hidden" name="trnAmount" value="<?php printf("%.2f", $totaldue); ?>">
                        <input type="hidden" name="trnReturnCard" value="<?php echo 1; ?>">
                        <input type="hidden" name="ordPhoneNumber" value="<?php
                        if ($billing_phone != "") {
                            echo $billing_phone;
                        } else {
                            echo $phone;
                        }
                        ?>">
                        <input type="hidden" name="ordAddress1" value="<?php
                        if ($billing_address1 != "") {
                            echo $billing_address1;
                        } else {
                            echo $address1;
                        }
                        ?>">
                        <input type="hidden" name="ordAddress2" value="<?php
                        if ($billing_address2 != "") {
                            echo $billing_address2;
                        } else {
                            echo $address2;
                        }
                        ?>">
                        <input type="hidden" name="ordCity" value="<?php
                        if ($billing_city != "") {
                            echo $billing_city;
                        } else {
                            echo $city;
                        }
                        ?>">
                        <input type="hidden" name="ordProvince" value="<?php
                        if ($billing_state != "") {
                            echo $billing_state;
                        } else {
                            echo $state;
                        }
                        ?>">
                        <input type="hidden" name="ordCountry" value="<?php
                        if ($billing_country != "") {
                            echo $billing_country;
                        } else {
                            echo $country;
                        }
                        ?>">
                        <input type="hidden" name="ordPostalCode" value="<?php
                        if ($billing_zip != "") {
                            echo $billing_zip;
                        } else {
                            echo $zip;
                        }
                        ?>">
                        <input type="hidden" name="ordEmailAddress" value="<?php
                        if ($billing_email != "") {
                            echo $billing_email;
                        } else {
                            echo $email;
                        }
                        ?>">	
                        <input type="hidden" name="errorPage" value="<?php echo $beanstreamReturnAddress; ?>">	
                        <input type="hidden" name="approvedPage" value="<?php echo $beanstreamReturnAddress; ?>">	
                        <input type="hidden" name="declinedPage" value="<?php echo $beanstreamReturnAddress; ?>">	

                        <h1>Registration Summary </h1>
                        <p>Below is a summary of your selections. Please check your invoice carefully.</p>
                        <?php
                        if (isset($promomessage)) {
                            echo $promomessage;
                        }
                        ?>
                        <p>&nbsp;</p>
                        <?php
                        $invoice_info = implode('', file('includes/invoice_template2.php'));
                        // strip in registrant info, invoice # and date
                        $invoice_info = str_replace("{vid}", $vid, $invoice_info);
                        $date = convertDate(date('Y-m-d'));
                        $invoice_info = str_replace("{date}", $date, $invoice_info);
                        $invoice_info = str_replace("{fname}", $fname, $invoice_info);
                        $invoice_info = str_replace("{lname}", $lname, $invoice_info);
                        $invoice_info = str_replace("{company}", $company, $invoice_info);
                        $full_address = $address1;
                        if ($address2) {
                            $full_address .= ", " . $address2;
                        }
                        $full_address .="<br>" . $city;
                        if ($state) {
                            $full_address .= ", " . $state;
                        }
                        $full_address .= ", " . $country . "&nbsp;&nbsp;" . $zip;
                        $invoice_info = str_replace("{full_address}", $full_address, $invoice_info);
                        // strip in billing info if any
                        if ($billing_email != "") {
                            $billing_replace = '<tr>
																<td width="80" align="left" valign="top" nowrap >
																	<p><strong>Bill To:</strong> </p>
																</td><td colspan="3"><p>';
                            if ($billing_fname != "") {
                                $billing_replace .= $billing_fname . " " . $billing_lname . "<br>";
                            }
                            $billing_replace .= $billing_company . "<br>";
                            $billing_replace .= $billing_address1;
                            if ($billing_address2) {
                                $billing_replace .= ", " . $billing_address2;
                            }
                            $billing_replace .= "<br>" . $billing_city;
                            if ($billing_state) {
                                $billing_replace .=", " . $billing_state;
                            }
                            $billing_replace .= ", " . $billing_country . "&nbsp;&nbsp;" . $billing_zip;
                            $billing_replace .="</p></td></tr>";
                        } else {
                            $billing_replace = "";
                        }
                        $invoice_info = str_replace("{billing_info}", $billing_replace, $invoice_info);
                        //////////////////////////////////////////////////////////////////////////////
                        // strip in invoice details///////////////////////////////////////////////////
                        if ($regstatus == "CANCELLED") {
                            $invoice_info = str_replace("{special_notes}", "<p class='red'>THIS REGISTRATION HAS BEEN CANCELLED</p>", $invoice_info);
                        } else if ($regstatus == "JUNK") {
                            $invoice_info = str_replace("{special_notes}", "<p class='red'>THIS REGISTRATION HAS BEEN MARKED AS JUNK</p>", $invoice_info);
                        } else {
                            $invoice_info = str_replace("{special_notes}", "", $invoice_info);
                        }
                        $invoice_details = "";
                        $details = "select c.* from $conference c, $tabledetailname d where d.funccode=c.funccode and d.vid='$vid' order by c.date, c.startTime asc";
                        $deresult = mysql_query($details) or die("Query failed : " . mysql_error());

                        $monday = array();
                        $tuesday = array();
                        $wednesday = array();

                        while ($deline = mysql_fetch_array($deresult)) {
                            if ($deline['date'] == "2013-04-08") {
                                array_push($monday, $deline);
                            } else if ($deline['date'] == "2013-04-09") {
                                array_push($tuesday, $deline);
                            } else if ($deline['date'] == "2013-04-10") {
                                array_push($wednesday, $deline);
                            }
                        }
                        $mondayL = sizeof($monday);
                        $tuesdayL = sizeof($tuesday);
                        $wednesdayL = sizeof($wednesday);



                        $invoice_details .= "<tr><td colspan=\"3\" align=\"left\">";
                        if ($funccode == "FULL") {
                            $invoice_details .= "<p><strong>Full Registration (includes all lunches)</strong></p></td><td align=\"right\">$funccost</td>";
                        } else {
                            $invoice_details .= "<p><strong>One Day Registration (includes lunch)</strong></p></td><td align=\"right\">$funccost</td>";
                        }
                        $invoice_details .= "</tr>";
                        //echo "<tr><td>".$mondayL."  ".$confticksL."  ".$conftutsL."</td></tr>";
                        if ($mondayL > 0) {
                            $invoice_details .= "<tr><td colspan='4'><hr /></td></tr>";
                            $invoice_details .= "<tr><td colspan='4'><p><strong>Monday, " . convertDate($monday[0]['date']) . "</strong></p></td></tr>";
                            for ($a = 0; $a < $mondayL; $a++) {
                                $invoice_details .= "<tr><td align=\"left\" valign=\"top\" width=\"100\" class=\"dottheline\"><p>[" . $monday[$a]['funccode'] . "]</p></td><td colspan=\"2\" align=\"left\" valign=\"top\" class=\"dottheline\"><p> " . $monday[$a]['funcdescr'];
                                if ($monday[$a]['funccost'] == "--") {
                                    $thecost = "--";
                                } else {
                                    $thecost = number_format($monday[$a]['funccost'], 2);
                                }
                                $invoice_details .= "</p></td> <td align='right' class=\"dottheline\"><p>$thecost</p></td></tr>";
                            }
                            $invoice_details .= "<tr><td align=\"left\" valign=\"top\" width=\"100\"><p></p></td><td colspan=\"2\" align=\"left\" valign=\"top\"><p>Lunch</p></td> <td align='right'><p>--</p></td></tr>";
                        }
                        if ($tuesdayL > 0) {
                            $invoice_details .= "<tr><td colspan='4'><hr /></td></tr>";
                            $invoice_details .= "<tr><td colspan='4'><p><strong>Tuesday, " . convertDate($tuesday[0]['date']) . "</strong></p></td></tr>";
                            for ($a = 0; $a < $tuesdayL; $a++) {

                                $invoice_details .= "<tr><td align=\"left\" valign=\"top\" class=\"dottheline\"><p>[" . $tuesday[$a]['funccode'] . "]</p></td><td colspan=\"2\" align=\"left\" valign=\"top\" class=\"dottheline\"><p> " . $tuesday[$a]['funcdescr'];
                                if ($tuesday[$a]['funccost'] == "--") {
                                    $thecost = "--";
                                } else {
                                    $thecost = number_format($tuesday[$a]['funccost'], 2);
                                }
                                $invoice_details .= "</p></td> <td align='right' class=\"dottheline\"><p>$thecost</p></td></tr>";
                            }
                            $invoice_details .= "<tr><td align=\"left\" valign=\"top\" width=\"100\"><p></p></td><td colspan=\"2\" align=\"left\" valign=\"top\"><p>Lunch</p></td> <td align='right'><p>--</p></td></tr>";
                        }
                        if ($wednesdayL > 0) {
                            $invoice_details .= "<tr><td colspan='4'><hr /></td></tr>";
                            $invoice_details .= "<tr><td colspan='4'><p><strong>Wednesday, " . convertDate($wednesday[0]['date']) . "</strong></p></td></tr>";
                            for ($a = 0; $a < $wednesdayL; $a++) {

                                $invoice_details .= "<tr><td align=\"left\" valign=\"top\" width=\"100\" class=\"dottheline\"><p>[" . $wednesday[$a]['funccode'] . "]</p></td><td colspan=\"2\" align=\"left\" valign=\"top\" class=\"dottheline\"><p> " . $wednesday[$a]['funcdescr'];
                                if ($wednesday[$a]['funccost'] == "--") {
                                    $thecost = "--";
                                } else {
                                    $thecost = number_format($wednesday[$a]['funccost'], 2);
                                }
                                $invoice_details .= "</p></td>  <td align='right' class=\"dottheline\"><p>$thecost</p></td></tr>";
                            }
                            $invoice_details .= "<tr><td align=\"left\" valign=\"top\" width=\"100\"><p>&nbsp;</p></td><td colspan=\"2\" align=\"left\" valign=\"top\"><p>Lunch</p></td> <td align='right'><p>--</p></td></tr>";
                        }
                        if ($funccode == "FULL") {
                            $invoice_details .= "<tr><td colspan='4'><hr /></td></tr>";
                            $invoice_details .= "<tr><td colspan='4'><p><strong>Thursday, April 11</strong></p></td></tr>";
                            $invoice_details .= "<tr><td width=\"100\" class=\"dottheline\">&nbsp;</td><td colspan=\"2\" class=\"dottheline\"><p>Plenary Session – Co-chairs' Reports and Discussion</p></td>  <td align='right' class=\"dottheline\"><p>--</p></td></tr>";
                            $invoice_details .= "<tr><td width=\"100\" class=\"dottheline\">&nbsp;</td><td colspan=\"2\" class=\"dottheline\"><p>Break/Networking</p></td>  <td align='right' class=\"dottheline\"><p>--</p></td></tr>";
                            $invoice_details .= "<tr><td width=\"100\" class=\"dottheline\">&nbsp;</td><td colspan=\"2\" class=\"dottheline\"><p>General Discussion Session</p></td>  <td align='right' class=\"dottheline\"><p>--</p></td></tr>";
                            $invoice_details .= "<tr><td width=\"100\" class=\"dottheline\">&nbsp;</td><td colspan=\"2\" class=\"dottheline\"><p>Workshop Wrap-up</p></td>  <td align='right' class=\"dottheline\"><p>--</p></td></tr>";
                            $invoice_details .= "<tr><td width=\"100\" class=\"dottheline\">&nbsp;</td><td colspan=\"2\" class=\"dottheline\"><p>Lunch</p></td>  <td align='right' class=\"dottheline\"><p>--</p></td></tr>";
                        }
                        $invoice_info = str_replace("{invoice_details}", $invoice_details, $invoice_info);
                        ///////////////////////// end of invoice details //////////////////////////////////
                        //////////////////////////////////////////////////////////////////////////////
                        if ($totalcharged) {
                            $totaldue = $totalcharged - $totalpaid;
                        }
                        $totalcharged = sprintf("%01.2f", $totalcharged);
                        $invoice_info = str_replace("{totalcharged}", $totalcharged, $invoice_info);
                        $totalpaid = sprintf("%01.2f", $totalpaid);

////////////////////////////////////////////////////////////////////////////////////
//////////////////////// grab payment history //////////////////////////////////////		
                        $paymenthist = "select * from $tablePaymentSponsor where vid='$vid' order by id asc";
                        $paymenthistresult = mysql_query($paymenthist) or die("Query failed : " . mysql_error());

                        $histnum = mysql_num_rows($paymenthistresult);
                        $payment_line = '';
                        if ($histnum == 0) {
                            $payment_line .= '
							<tr>
								<td colspan="3" align="right">
									<p><strong>Amount Paid:</strong></p>
								</td>
								<td align="right">
									<p>' . $totalpaid . '</p>
								</td>
							</tr>';
                        } else {
                            while ($hist = mysql_fetch_array($paymenthistresult)) {
                                if ($hist['pay_amount'] < 0) {
                                    $payorrefund = '<strong>Refund Issued</strong> ';
                                    $selectclass = ' class="red" ';
                                    $special = '';
                                } else if ($hist['transaction_type'] == 'CNCLFEE') {
                                    $payorrefund = '<strong>Cancellation Fee</strong> ';
                                    $selectclass = '';
                                    $special = '<tr><td colspan="4" align="right"><em>Please note: When you receive your refund, the fee will already have been taken off the refund total</em></td></tr>';
                                    $totaldue = $totaldue + 50;
                                } else if ($hist['transaction_type'] == 'RFNDFEE') {
                                    $payorrefund = '<strong>Refund Fee</strong>';
                                    $selectclass = '';
                                    $special = '<tr><td colspan="4" align="right"><em>Please note: When you receive your refund, the fee will already have been taken off the refund total</em></td></tr>';
                                    $totaldue = $totaldue + 50;
                                } else {
                                    $payorrefund = '<strong>Payment Received</strong> ';
                                    $selectclass = '';
                                    $special = '';
                                }
//								$payment_line .= '
//									<tr>
//										<td colspan="3" align="right" valign="top"'.$selectclass.'>
//											<p>'.$payorrefund.' '.convertDate($hist['date_paid']).':</p>
//										</td>
//										<td align="right" valign="top"'.$selectclass.'>
//											<p>'.$hist['pay_amount'].'</p>
//										</td>
//									</tr>'.$special;
                                $payment_line .= '
									<tr>
										<td colspan="3" align="right" valign="top"' . $selectclass . '>
											<p>' . $payorrefund . ' ' . convertDate($hist['date_paid']) . ' (' . $hist['transaction_type'] . ' #' . $hist['response_id'] . '):</p>
										</td>
										<td align="right" valign="top"' . $selectclass . '>
											<p>' . $hist['pay_amount'] . '</p>
										</td>
									</tr>' . $special;
                            }
                            $todaydate = date('Y-m-d');
                        }
                        $invoice_info = str_replace("{paymenthistory}", $payment_line, $invoice_info);
///////////////////////end of payment history //////////////////////////////////////	

                        if ($regstatus == 'CANCELLED') {
                            $invoice_info = str_replace("{message_status}", "red", $invoice_info);
                            $invoice_info = str_replace("{totaldue_message}", "<em>REGISTRATION CANCELLED</em>&nbsp;&nbsp;&nbsp; Total Owing:", $invoice_info);
                            $invoice_info = str_replace("{refund_message}", "<h2 class='red'>THIS REGISTRATION HAS BEEN CANCELLED.</h2>", $invoice_info);
                            $totaldue = '0.00';
                        } else if ($totaldue >= 0) {
                            $invoice_info = str_replace("{message_status}", "", $invoice_info);
                            $invoice_info = str_replace("{totaldue_message}", "Total Owing:", $invoice_info);
                            $invoice_info = str_replace("{refund_message}", "", $invoice_info);
                        } else {
                            $invoice_info = str_replace("{message_status}", "red", $invoice_info);
                            $invoice_info = str_replace("{totaldue_message}", "Refund Due:", $invoice_info);
                            $invoice_info = str_replace("{refund_message}", "<h2 class='red'>Changes in your registration have resulted in a refund. <br />Refunds are subject to a $50 processing fee.</h2>", $invoice_info);
                        }
                        $totaldue = sprintf("%01.2f", $totaldue);
                        $invoice_info = str_replace("{totaldue}", $totaldue, $invoice_info);

                        echo $invoice_info;
                        ?>


                        <input type='hidden' name='payOpt' value="CC">

                        <?php
                        if ($totaldue > 0) {
                            ?>
                            <p>
                                <input name='Back' type='button' class="transformButtonStyle" onClick="this.form.action = 'index.php';
                                                this.form.submit();" value='Go Back and Make Changes' />
                                       <?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
                                    <input name="logout" type="button" class="transformButtonStyle" id="logout" style="margin-left:10px;" ONCLICK='document.invoice.payOpt.value = "LOGOUT";
                                                        if (checkPay(this.form))
                                                            document.invoice.submit();
                                                        return false;' value="Log Out">
                                       <?php } ?>

                        <!--	<p>
                        <input type='radio' name='pay' value='CC' onClick="document.invoice.payOpt.value = 'CC'">
                        Credit Card		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type='radio' name='pay' value='MAIL' onClick="document.invoice.payOpt.value = 'MAIL'">
                        Cheque or Money Order
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type='radio' name='pay' value='BANK' onClick="document.invoice.payOpt.value = 'BANK'">
                        Bank Draft	</p>
                        <p>
                                -->
                                <input name="paymentButton" type="button" class="transformButtonStyle" id="paymentButton" ONCLICK='if (checkPay(this.form))
                                                    document.invoice.submit();
                                                return false;' value="Pay by Credit Card">
                                <input name="paymentByChequeButton" type="button" class="transformButtonStyle" id="paymentButton" ONCLICK='if (checkPay(this.form))
                                                    document.invoice.submit();
                                                return false;' value="Pay by Cheque/Money Order">
                                <input name="cancelButton" type="button" class="transformButtonStyle" id="cancelButton" ONCLICK='document.invoice.payOpt.value = "cancel";
                                                if (checkPay(this.form))
                                                    document.invoice.submit();
                                                return false;' value="Cancel Registration">
                            </p>
                            <p>An invoice or receipt will be sent to the email address you provided on the previous page.	</p>
                            <p><em><strong>Cancellation requests must be received in writing no later than March 8, 2013.  There will be a $10 handling fee assessed for each refund.</strong></em> Please email to <a href="mailto:support@idassociates.ab.ca">support@idassociates.ab.ca</a> for any cancellation requests.</p>
                        <?php } else if ($totaldue < 0) {
                            ?>
                            <p>
                                What would you like to do?</p>
                            <p>
                                <input type='button' name='Back' value='Go Back and Make Changes' onClick="this.form.action = 'index.php';
                                                this.form.submit();" />
                                &nbsp;&nbsp;
                                <input type="button" value="Confirm Refund" ONCLICK='document.invoice.payOpt.value = "REFUND";
                                                if (checkPay(this.form))
                                                    document.invoice.submit();
                                                return false;'>
                                       <?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
                                    <input name="logout2" type="button" id="logout2" ONCLICK='document.invoice.payOpt.value = "LOGOUT";
                                                        if (checkPay(this.form))
                                                            document.invoice.submit();
                                                        return false;' value="Log Out" style="margin-left:10px;">
                                       <?php } ?>
                            </p>
                            <br>


                            <?php
                        }
                        if ($totaldue == 0 && $paytype != "") {
                            ?>
                            <h2>Your changes have not affected your total. 
                                No  payments are due at this time.</h2>
                            <p>Would you like to:</p>
                            <p>
                                <input type='button' name='Back2' value='Go Back and Make Changes' onClick="this.form.action = 'index.php';
                                                this.form.submit();" />
                                <input type="button" value="Send Revised Invoice" ONCLICK='document.invoice.payOpt.value = "RESEND";
                                                if (checkPay(this.form))
                                                    document.invoice.submit();
                                                return false;'>
                                       <?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
                                    <input name="logout3" type="button" id="logout3" ONCLICK='document.invoice.payOpt.value = "LOGOUT";
                                                        if (checkPay(this.form))
                                                            document.invoice.submit();
                                                        return false;' value="Log Out" style="margin-left:10px;">
                                       <?php } ?>
                            </p>
                        <?php } else if ($totaldue == 0 && $paytype == "") { ?>
                            <h2>Your registration category has no fees. <br>
                                Please complete your registration by clicking the Send Invoice button.</h2>
                            <input type='button' name='Back2' value='Go Back and Make Changes' onClick="this.form.action = 'index.php';
                                            this.form.submit();" />
                            <input type="button" value="Send Invoice" ONCLICK='document.invoice.payOpt.value = "FREE";
                                            if (checkPay(this.form))
                                                document.invoice.submit();
                                            return false;'>
                                   <?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
                                <input name="logout4" type="button" id="logout4" ONCLICK='document.invoice.payOpt.value = "LOGOUT";
                                                    if (checkPay(this.form))
                                                        document.invoice.submit();
                                                    return false;' value="Log Out" style="margin-left:10px;">
                                   <?php } ?>
                               <?php } ?>
                               <?php
                               mysql_close($link);
                               ?>
                    </form>
                </div>
                <div id="footer">
                    <p>&nbsp;</p>
                </div>
            </div>
        </body>
    </html>
    <?php
}

//	while (list ($key, $val) = each ($_SESSION))
//	{
//	//  if ($val){
//		$$key = $val;
//		echo $key.": ".$$key."<br>";
//	//	}
//	}
?>