<?php
$tuesdayAvail = TRUE;
$mondayAvail = TRUE;
$wednesdayAvail = TRUE;
$selectStmt = "select sid from $tablesponsor where sponcode = 'CBTU' and `totaldue`=0";
$selectresult = mysql_query($selectStmt) or die("Picking VID Query failed : " . mysql_error() . "<BR><BR>The statement being executed is: " . $selectStmt);
if (mysql_num_rows($selectresult) > 0) {
    $tuesdayAvail = FALSE;
}
$selectStmt = "select sid from $tablesponsor where sponcode = 'CBMO' and `totaldue`=0";
$selectresult = mysql_query($selectStmt) or die("Picking VID Query failed : " . mysql_error() . "<BR><BR>The statement being executed is: " . $selectStmt);
if (mysql_num_rows($selectresult) > 0) {
    $mondayAvail = FALSE;
}
$selectStmt = "select sid from $tablesponsor where sponcode = 'CBWD' and `totaldue`=0";
$selectresult = mysql_query($selectStmt) or die("Picking VID Query failed : " . mysql_error() . "<BR><BR>The statement being executed is: " . $selectStmt);
if (mysql_num_rows($selectresult) > 0) {
    $wednesdayAvail = FALSE;
}
?>

<div class="formBlock">
    <p class="leftCol required">Required Fields *</p>
</div>
<div id="registrantInfo" class="formBlock" style="clear:left; width:100%;">
    <h2>Step 1. Contact Information</h2>
    <div class="leftCol notRequired" style="width:20%;">
        <p>
            <select name="sal" id="sal" class="noreqfield">
                <option value="">Salutation</option>
                <option value="Mr." <?php
                if ($sal == 'MR.') {
                    echo "selected";
                }
                ?> >Mr.</option>
                <option value="Dr." <?php
                if ($sal == 'DR.') {
                    echo "selected";
                }
                ?> >Dr.</option>
                <option value="Ms." <?php
                if ($sal == 'MS.') {
                    echo "selected";
                }
                ?> >Ms.</option>
                <option value="Mrs." <?php
                if ($sal == 'MRS.') {
                    echo "selected";
                }
                ?>>Mrs.</option>
                <option value="Miss" <?php
                if ($sal == 'MISS.') {
                    echo "selected";
                }
                ?>>Miss.</option>
            </select>
        </p>
    </div>
    <div style="clear:left;"></div>
    <div class="leftCol required" style="width:40%;">
        <p>First Name
            * </p>
        <p>
            <input name="fname" type="text" class="reqfield" id="fname" value="<?php
            if (isset($fname)) {
                echo $fname;
            }
            ?>" />
        </p>
    </div>
    <div class="leftCol required" style="width:40%;">
        <p>Last Name
            * (Maximum 23 characters)</p>
        <p>
            <input name="lname" type="text" class="reqfield" id="lname" value="<?php
            if (isset($lname)) {
                echo $lname;
            }
            ?>" maxlength="23"/>
        </p>
    </div>
    <div style="clear:left;"></div>
    <div class="leftCol required" style="width:auto; margin-left:50px;">
        <p><strong>First name as you would like it to display on Badge</strong> * (max. 17 characters)</p>
        <p>
            <input name="nickname" type="text" class="reqfield" id="nickname" value="<?php
            if (isset($nickname)) {
                echo $nickname;
            }
            ?>" size="40" maxlength="17" style="width:auto;"/>
        </p>
    </div>
    <div class="leftCol notRequired" style="width:92%;">
        <p>Company Name (Maximum 50 characters)</p>
        <p>
            <input name="company" type="text" id="company" value="<?php
            if (isset($company)) {
                echo $company;
            }
            ?>" maxlength="50"  class="noreqfield"/>
        </p>
    </div>
    <div style="clear:left;"></div>

    <div class="leftCol notRequired" style="width:40%;">
        <p>Job Title</p>
        <p>
            <input name="title" type="text" id="title" value="<?php
            if (isset($title)) {
                echo $title;
            }
            ?>" maxlength="50" class="noreqfield" />
        </p>
    </div>
    <div class="leftCol required" style="width:40%;">
        <p>Business Type
        </p>
        <p>
            <select name="businesstype" id="businesstype" class="reqfield">
                <option value="" <?php
                if (!(strcmp("", "$businesstype"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Select a Bussiness Type</option>
                <option value="Academic" <?php
                if (!(strcmp("Academic", "$businesstype"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Academic</option>
                <option value="Consultant" <?php
                if (!(strcmp("Consultant", "$businesstype"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Consultant</option>
                <option value="Operator" <?php
                if (!(strcmp("Operator", "$businesstype"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Operator</option>
                <option value="Regulator" <?php
                if (!(strcmp("Regulator", "$businesstype"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Regulator</option>
                <option value="Vendor" <?php
                if (!(strcmp("Vendor", "$businesstype"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Vendor</option>
                <option value="Other" <?php
                if (!(strcmp("Other", "$businesstype"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Other</option>
            </select>
        </p>
    </div>
    <div style="clear:left;"></div>




    <div class="leftCol required" style="width:92%;">
        <p>Address
            * </p>
        <p>
            <input name="address1" type="text" id="address1"  value="<?php
            if (isset($address1)) {
                echo $address1;
            }
            ?>" class="reqfield"/>
        </p>
    </div>
    <div class="leftCol notRequired" style="width:92%;">
        <p>Address 2 </p>
        <p>
            <input name="address2" type="text" id="address2"  value="<?php
            if (isset($address2)) {
                echo $address2;
            }
            ?>"  class="noreqfield"/>
        </p>
    </div>
    <div style="clear:left;"></div>
    <div class="leftCol required" style="width:50%;">
        <p>City
            * </p>
        <p>
            <input name="city" type="text" class="reqfield" id="city" value="<?php
            if (isset($city)) {
                echo $city;
            }
            ?>" />
        </p>
    </div>
    <div class="leftCol notRequired" style="width:30%;">
        <p>State/Province</p>
        <p>
            <input name="state" type="text" id="state" value="<?php
            if (isset($state)) {
                echo $state;
            }
            ?>"  class="noreqfield"/>
        </p>
    </div>
    <div class="leftCol required" style="clear:left;">
        <p>Country
            * </p>
        <p>
            <?php
            $countries = "select * from $tableCountries";
            $countriesResult = mysql_query($countries) or die(mysql_error() . "<br>$countries");
            ?>
            <select name="country" id="country" class="reqfield" style="width:auto;">
                <option value="" <?php
                if (!(strcmp("", "$country"))) {
                    echo "selected=\"selected\"";
                }
                ?>>Select a Country</option>
                        <?php while ($count = mysql_fetch_array($countriesResult)) { ?>
                    <option value="<?php echo $count['iso2']; ?>" <?php
                    if (!(strcmp($count['iso2'], "$country"))) {
                        echo "selected=\"selected\"";
                    }
                    ?>><?php echo $count['countryName']; ?></option>
                        <?php } ?>
            </select>
        </p>
    </div>
    <div class="leftCol required">
        <p>Zip/Postal Code
            * </p>
        <p>
            <input name="zip" type="text" class="reqfield" id="zip" style="width:auto;" value="<?php
            if (isset($zip)) {
                echo $zip;
            }
            ?>" size="16"/>
        </p>
    </div>
    <div style="clear:left;"></div>
    <div class="leftCol required" style="width:30%">
        <p>Phone Number (include area code)
            * </p>
        <p>
            <input name="phone" type="text" class="reqfield" id="phone" value="<?php
            if (isset($phone)) {
                echo $phone;
            }
            ?>"/>
        </p>
    </div>
    <div class="leftCol notRequired" style="width:30%">
        <p>Fax Number (include area code) </p>
        <p>
            <input name="fax" type="text" id="fax" value="<?php
            if (isset($fax)) {
                echo $fax;
            }
            ?>" class="noreqfield"/>
        </p>
    </div>
    <div style="clear:left;"></div>
    <div class="leftCol required" style="width:92%;">
        <p>Email
            * </p>
        <p>
            <input name="user_password" type="hidden" id="user_password" value="<?php
            if (isset($user_password)) {
                echo $user_password;
            }
            ?>">
            <input name="email" type="text" class="reqfield" id="email" value="<?php
            if (isset($email)) {
                echo $email;
            }
            ?>" />
        </p>
    </div>
    <div style="clear:left;"></div>
</div>
<p>
    <input name="continuebutton" type="button" class="transformButtonStyle" id="<?php
    if (!isset($vid) || $vid == "") {
        echo "continuebutton";
    } else {
        echo "savechanges";
    }
    ?>" value="<?php
           if (!isset($vid) || $vid == "") {
               echo "Continue";
           } else {
               echo "Save Changes";
           }
           ?>" style="width:auto;">
</p>
</div>
<div id="registrantSummary" class="formBlock" style="display:none" <?php
if (!isset($vid) || $vid == "") {
    echo "style=\"display:none;\"";
}
?>>
    				<div id="registrantFields" class="leftCol summaries" style="width:40%;">
                                                            <h3>Contact / Billing Information</h3>
                                                            <p id="regName">Name</p>
                                                            <p id="regCompany">company</p>
                                                            <p id="regAddress">address<br />
                                                                            city, province<br />
                                                                            country&nbsp;&nbsp;Postal</p>
                                                            <p id="regEmail">email</p>
                                                            <p id="regPhone">phone</p>
                                            </div>
<!--                                            <div id="billingFields" class="leftCol summaries" style="width:40%;">
                                                            <h3>Billing Information</h3>
                                                            <p id="billName">Name</p>
                                                            <p id="billCompany">company</p>
                                                            <p id="billAddress">address<br />
                                                                            city, province<br />
                                                                            country&nbsp;&nbsp;Postal</p>
                                                            <p id="billEmail">email</p>
                                                            <p id="billPhone">phone</p>
                                            </div>  -->
    <div style="clear:both;"></div>
    <input name="makeChanges" type="button" class="transformButtonStyle" id="<?php
    if (!isset($vid) || $vid == "") {
        echo "makeChanges";
    } else {
        echo "editRegistrant";
    }
    ?>" value="<?php
           if (!isset($vid) || $vid == "") {
               echo "Make Changes";
           } else {
               echo "Edit Registrant";
           }
           ?>" style="width:auto;">
</div>
<div id="registrationType" class="formBlock" <?php
if (!isset($vid) || $vid == "") {
    echo "style=\"display:none;\"";
}
?>>
    <input name="totalcharged" id="totalcharged" type="hidden" value="<?php echo $totalcharged; ?>">
    <input type="hidden" name="totalpaid"  value="<?php echo $totalpaid; ?>">
    <input type="hidden" name="totaldue"   value="<?php echo $totaldue; ?>">
    <input type="hidden" name="vid" value="<?php echo $vid; ?>">
    </td>
    <h2 id="step2">Step 2. Choose Sponsorship Category <?php echo $funcccode; ?></h2>
    <div id="patron" class="selectType leftCol required" style="width:28%">
        <h3>Patron</h3>
        <div class="notRequired">
            <p>
                <label>
                    <input <?php
                    if (!(strcmp("$funccode", "PTRN"))) {
                        echo "checked=\"checked\"";
                    }
                    ?> type="radio" name="regType" class="regType" value="PTRN">
                    $5000+ (3 free registrations)</label>
            </p>
        </div>
        <p>&nbsp;</p>
    </div>
    <div id="sponsor" class="selectType leftCol required" style="width:28%">
        <h3>Sponsor</h3>
        <div class="notRequired">
            <p>
                <label>
                    <input <?php
                    if (!(strcmp("$funccode", "SPNS"))) {
                        echo "checked=\"checked\"";
                    }
                    ?> type="radio" name="regType" class="regType"  value="SPNS">
                    $3000 (2 free registrations)</label>
            </p>
        </div>
        <p>&nbsp;</p>
    </div>
    <div id="coffeebreak" class="selectType leftCol required" style="width:28%">
        <h3>Coffee Break</h3>
        <div class="notRequired">
            <p>
                <label>
                    <input type="radio" name="regType" class="regType"  value="CBRK">
                    $3000 (2 free registrations)</label>
            </p>
        </div>
        <p>&nbsp;</p>
    </div>


</div>
<div class="registrationCategories" id="schedule" style="clear:left; <?php
if (!isset($vid) || $vid == "") {
    echo "display:none;";
}
?>">
    <h2 style="float:left;">Sponsorship Details</h2>
    <div  id="PTRN" class="regDay" style="clear:left;">
        <div id="billing" class="formBlock" style="padding:10px 10px 0px 10px; margin: 0px 0px 10px 0px;">
            <h3 style="float:none;">Patron</h3>
            <div class="leftCol required" style="width:40%;">
                <h3 style="float:none;">
                    <label>
                        <input checked="checked" class="sessionButtons" id="TU3"  type="radio" name='defaultPatron'  value="defaultPatron">
                        $5000
                    </label>
                </h3>
                <br>
            </div>
            <div class="leftCol required" style="width:40%;">
                <h3 style="float:none;">
                    <label>
                        <input class="sessionButtons"  id="TU2"  type="radio" name='customPatron'  value="customPatron">
                        Other Amount:
                    </label>
                </h3>
                <label>
                    <input name="patronAmount" type="text" class="reqfield" id="patronAmount" style="width:200px" value="5000">
                </label>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div id="SPNS" class="regDay">
        <!--                   Here is the form sponsor-->
    </div>
    <div id="CBRK" class="regDay">
        <div id="billing" class="formBlock required" style="padding:10px 10px 0px 10px; margin: 0px 0px 10px 0px;">
            <h3 style="float:none;"><p>Coffee Break</p></h3>
            <p>Choose a day</p>

            <div class="leftCol required" style="width:27%;">
                <h3 style="float:none;">
                    <label><?php if ($mondayAvail): ?>
                            <input <?php
                            if (!(strcmp("$funccode", "CBMO"))) {
                                echo "checked=\"checked\"";
                            }
                            ?>  type="radio" class="tutorials sessionButtons" name="tutorialB" id="TU4" value="CBMO">
                            <?php else: ?>
                            (Taken)
                        <?php endif; ?>

                        Monday

                    </label>
                </h3>
                <br>
            </div>


            <div class="leftCol required" style="width:27%;">
                <h3 style="float:none;">
                    <label>
                        <?php if ($tuesdayAvail): ?>
                            <input <?php
                            if (!(strcmp("$funccode", "CBTU"))) {
                                echo "checked=\"checked\"";
                            }
                            ?>  type="radio" class="tutorials sessionButtons" name="tutorialB" id="TU4" value="CBTU">
                            <?php else: ?>
                            (Taken)
                        <?php endif; ?>
                        Tuesday
                    </label>
                </h3>
                <br>
            </div>


            <div class="leftCol required" style="width:27%;">
                <h3 style="float:none;">
                    <label>
                        <?php if ($wednesdayAvail): ?>
                            <input <?php
                            if (!(strcmp("$funccode", "CBWD"))) {
                                echo "checked=\"checked\"";
                            }
                            ?> type="radio" class="tutorials sessionButtons" name="tutorialB" id="TU4" value="CBWD">
                            <?php else: ?>
                            (Taken)
                        <?php endif; ?>
                        Wednesday
                    </label>
                </h3>
                <br>
            </div>

            <div style="clear:both;"></div>
        </div>
    </div>

    <?php
// start a session to check on page 2
    $_SESSION['registrationStep'] = 1;
    ?>
    <div id="billing" class="formBlock" style="padding:10px 10px 0px 10px; margin: 0px 0px 10px 0px;">
        <div id="displayCost">
            <p>
                <span class="priceDisp" id="costAmount">--</span>
                <strong>Total Cost: </strong></p>
        </div>
        <div style="clear:both;"></div>
    </div>
