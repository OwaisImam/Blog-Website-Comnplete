<?php 
    session_start(); 
    error_reporting(0); 
    set_time_limit(0); 
    include("DBConnection.php"); 
    global $dbh; 
    $path= explode("/", $_SERVER["PHP_SELF"]); 
    $self = $_SERVER['PHP_SELF']; 

    $dbh=($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST,  DB_USERNAME,  DB_PASSWORD)) or die ('Could not connect to the database because: ' . mysqli_error($GLOBALS["___mysqli_ston"])); 
    mysqli_select_db($GLOBALS["___mysqli_ston"], constant('DB_NAME')); 

    $query="SELECT ID,Name,Logo,Status,DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated FROM logos WHERE Status=1 LIMIT 2"; 
    $result=mysqli_query($GLOBALS["___mysqli_ston"], $query) or die("Could not select because: ".mysqli_error($GLOBALS["___mysqli_ston"])); 
    if(mysqli_num_rows($result) > 1) 
    { 
        $_SETTINGS_Header_LOGO = mysqli_result($result,  0,  2);
        $_SETTINGS_Footer_LOGO = mysqli_result($result,  1,  2); 
    } 
    else 
        $_SETTINGS_LOGO = mysqli_result($result,  0,  2); 
     
    $settingResultSet=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM configurations ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
    $settingRecordSet=mysqli_fetch_array($settingResultSet); 
    foreach ($settingRecordSet as $key => $val) 
        define($key, $val); 
     
    $query="SELECT ID, Percentage FROM other_countries_shipping"; 
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die(mysqli_error($GLOBALS["___mysqli_ston"]));  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    define("SHIPPING_RATE", $row["Percentage"]); 

    function getShipping($Country) 
    { 
        $shippingAmount = 0; 
        $query="SELECT Percentage FROM shipping_rates WHERE ID<>0 AND CountryCode = '".$Country."' ORDER BY ID DESC Limit 1"; 
        $res = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
        $numperc = mysqli_num_rows($res); 
        if($numperc == 1) 
        { 
            $row=mysqli_fetch_array($res); 
            $shippingAmount = ($row["Percentage"]); 
            $shippingAmount = number_format((float)$shippingAmount, 2, '.', ''); 
        } 
        else 
        { 
            $query="SELECT Percentage FROM other_countries_shipping WHERE ID=1"; 
            $res = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $row=mysqli_fetch_array($res); 
            $shippingAmount = ($row["Percentage"]); 
            $shippingAmount = number_format((float)$shippingAmount, 2, '.', ''); 
        } 
        return $shippingAmount; 
    } 
    define("DIR_MODULES", "modules/"); 
     
    define("MANDATORY", "<span class=\"mandatory noPrint\">*</span>"); 
    define("THUMB_WIDTH", 72); //In Pixel 
    define("THUMB_HEIGHT", 72); //In Pixel 
    define("INDENT", "&nbsp;&nbsp;&nbsp;"); 
    define("MAX_IMAGE_SIZE", 5120); //In KB 
     
    define("DIR_BRANDS_IMAGES", "assets/brands-images/"); 
    define("DIR_CATEGORY_BANNERS", "assets/category-banners/"); 
    define("DIR_PRODUCTS_IMAGES", "assets/product-images/"); 
    define("DIR_PAGE_BANNERS", "assets/infopage-banner/"); 
    define("DIR_LOGOS", "assets/logo/"); 
    define("DIR_SLIDERS", "assets/website-sliders/"); 
    define("DIR_THUMBNAILS", "assets/thumbnails/"); 
    define("DIR_WEBSITE_BANNERS", "assets/website-banners/"); 
    define("DIR_PAYMENT_METHODS", "assets/payment-methods/"); 
    define("DIR_MULTIMEDIA_IMAGES", "assets/multimedia-images/"); 
    define("DIR_SOCIALMEDIA_IMAGES", "assets/socialmedia-images/"); 
    define("DIR_NEWSLETTERS", "assets/newsletters/"); 
     

     
    $_AD = array("<i class=\"fa fa-fw fa-times-circle\"></i>", "<i class=\"fa fa-fw fa-check-circle\"></i>"); 
     

    $_IMAGE_ALLOWED_TYPES=array("jpg", "jpeg", "gif", "png"); 
    $_NEWSLETTER_ALLOWED_TYPES=array("html", "htm", "HTML"); 
    $_PACKAGE_TYPES=array("-- Not Selected --", "Corporate", "Individual"); 
    $_USERS_TYPES=array("-- Not Selected --", "Corporate", "Individual"); 
    $_CATEGORY_TYPES=array("-- Not Selected --", "Company Profile", "Salary Report", "Feedback"); 
    $_FORM_TYPES=array("-- Not Selected --", "Corporate", "Individual"); 
    $_AD=array("Deactive", "Active"); 
    $_OPEN_IN=array("_self", "_blank"); 
    $_INPUT_TYPE=array("","Radio", "Selection", "Textbox"); 
    $_QUESTION_MODULES=array("","Countries","Industries","Educations","Experiances", "Occupation", "Skills", "KSA Cities", "Spciality (Majors)", "Traning Courses"); 
    $_MONTHS = array("","January","February","March","April","May","June","July","Augest","September","October","November","December"); 
    $_EXP_MONTH = array("","1","2","3","6","9","12","24","48"); 
    $_MARK_AS = array("", "Gender", "Grade","Company Size"); 
    $_MARK_AS_COMPANY = array("", "Company Size", "Industry", "KSA City"); 
    $_GENDER = array("", "Male", "Female"); 
    $_ADS_POSITION = array("", "Header", "Sidebar"); 
    $_AD_FILE_NAMES = array("", array("Main Page","Index.php"), array("Dashboard","Dashboard.php"), array("Pages","Page.php"), array("Login","Login.php"),  
                        array("Registration","Registration.php"),array("404","404.php"), );                         
    $_INSTITUTE_TYPE = array("", "College/University", "Vocational/Technical", "Other"); 
    $_MAJOR_TYPES = array("", "Scientific", "Non Scientific"); 
    $_MAJOR_TYPES_UNIVERSITY = array("", "Normal", "Vocational"); 
    $_QUESTION_MODULES_CORPORATE = array("","Industries", "KSA Cities", "How old is your company", "How many Branchs","How long to fill position (Time to Fill)","How long to join position (Time to Join)","How do you rate your Salary in your industry"); 
    $_MISC_TYPE=array("Heading", "Message", "HTML", "Image"); 
    $_EXCLUDEED_FILES = array("--Index.php","Blank.php","BuyPackage.php","BuyUsers.php","CompanyProfile(WithoutModules).php","CompanyProfile1.php","CorporateForm.php","CorporateUsers.php","Countries.php","Dashboard2.php","Faqs.php","Header1.php","IndividualForm.php","IndividualSalaryReport(02-05-14).php","IndividualSalaryReport-backup(20-04-14).php","IndividualUsers.php","Industries.php","Institutes.php","Logout.php","Majors.php","NationalCategories.php","News.php","QuestionCategories.php","Questions.php","Sidebar.php","buy_package.php","buy_report_corporate.php","chart.php","check.php","check_user_login.php","circles.php","display_image.php","form.php","index--.php","index2.php","inner.php","inquiries.php","ipnac.php","ipnc.php","ipnlistener.php","ipnp.php","ipnpa.php","ipnu.php","print_session.php","profile_check.php","profile_indicator.php","question_rivision---.php","question_rivision--.php","report1.php","report2.php","report___.php","rivision(WithoutAnswer).php","rivision(WithoutSubAnswer).php","s.php","salary_report1.php","show_cities.php","skill_details.php","test.php","thumbnail_generator.php","up.php","user_credits.php","user_info.php","user_reports_display.php","user_side_bar.php","view_list.php","view_salary_report-old.php","view_salary_report-test.php","view_salary_report_test.php"); 

    function get_value($two, $one, $three, $four) 
    { 
        $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ".$one." FROM ". $two." WHERE ".$three."='".$four."'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
        if(mysqli_num_rows($a) > 0) 
            return mysqli_result($a,  0,  0); 
        else 
            return ''; 
    } 
    function get_status($ID) 
    { 
        return get_value("order_status", "OrderStatus", "ID", $ID); 
    } 
    //var_dump(stream_get_wrappers()); //check installed extention in php.ini 
    function Newsletter($Newsletter) 
    { 
        $Content=file_get_contents($Newsletter); 
        return $Content; 
    } 
     
    function redirect($url) 
    { 
        header("Location: " . $url); 
        exit(); 
    } 
     
    function validEmailAddress($email_address) 
    { 
        if(strpos($email_address, " ") > 0) 
            return false; 
             
        //return preg_match("^(([\w-]+\.)+[\w-]+|([a-zA-Z]{1}|[\w-]{2,}))@((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\.([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\.([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\.([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|([a-zA-Z]+[\w-]+\.)+[a-zA-Z]{2,4})$^", $email_address); 
         
        return filter_var($email_address, FILTER_VALIDATE_EMAIL); 
    } 
     
    function validDate($dt) 
    { 
        if(trim($dt) == "") 
            return false; 
             
        $d = explode("/", $dt); 
        if(sizeof($d) != 3) 
            return false; 
             
        if(!ctype_digit($d[0]) || !ctype_digit($d[1]) || !ctype_digit($d[2])) 
            return false; 
             
        return checkdate($d[1], $d[0], $d[2]); 
    } 
     
    function dbinput($string, $allow_html = false) 
    { 
        global $dbh; 
         
        if($allow_html == false) 
            $string = strip_tags($string); 
         
        if (function_exists('mysqli_real_escape_string')) 
            return mysqli_real_escape_string( $dbh, $string); 
        elseif (function_exists('mysqli_real_escape_string')) 
            return ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $string) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")); 
         
        return addslashes($string); 
    } 
     
    function dboutput($string) 
    { 
        return stripslashes($string); 
    } 
     
    function dbhtmlinput($string) 
    { 
        $output = str_replace("'","\'",$string); 
        $output = str_replace(",","\,",$output); 
        return $output; 
    } 
     
    function not_null($value) 
    { 
        if (is_array($value)) 
        { 
            if (sizeof($value) > 0) 
                return true; 
            else 
                return false; 
        } 
        else 
        { 
            if ((is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) 
                return true; 
            else 
                return false; 
        } 
    } 
     
    function replace_quote($string) 
    { 
        return str_replace('"', '&quot;', $string); 
    } 
     
    $PageCounter = 0;     
    function get_menu($parent_id=0) 
    { 
        global $PageCounter, $_OPEN_IN; 
        $rc = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT c.ID, c.ParentID, cd.Title, c.ExternalLink, c.LinkTargert 
        FROM cms c 
        LEFT JOIN cms_details cd ON cd.CMSID = c.ID AND cd.LanguageID='".(int)LANGUAGE_ID."' 
        WHERE c.ShowInMenu = 1 AND c.Status = 1 AND c.ParentID = '".(int)$parent_id."' ORDER BY c.SortOrder, c.ID") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
        if(mysqli_num_rows($rc) > 0) 
        { 
            $PageCounter++; 
            echo '<ul'.($parent_id == 0 ? ' id="menu-main-menu" class="menu"' : ' class="sub-menu"').'>'; 
             
                 
            while($RsC = mysqli_fetch_assoc($rc)) 
            {    $html=''; 
                if(strtolower(dboutput($RsC["ExternalLink"])) == "login.php") 
                { 
                    if(isset($_SESSION['User']) && $_SESSION['User']==true) 
                    { 
                        $Title = "My Account"; 
                        $href = "Dashboard.php"; 
                        $html='<ul id="menu-main-menu" class="menu"> 
                                <li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="Dashboard.php"><span id="headertext">Dashboard</span></a></li> 
                                <li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="salary_report.php?agree=true&action=submit_survey"><span id="headertext">Salary Survey</span></a></li>'; 
                                 if(($_SESSION["UserType"] == 1)  || ($_SESSION["UserType"] == 2 && $_SESSION["ShowReport"] == 1 && $_SESSION["ParentUserType"] == 1 ) ||  ($_SESSION["UserType"] == 2 && $_SESSION["ParentUserType"] == 2 && $_SESSION["ShowReport"] == 1) || ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0)) 
                                 { 
                                    $html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="ReportManagement.php"><span id="headertext">Reports Management</span></a></li>'; 
                                } 
                                if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && (($_SESSION["UserType"] == 1 || $_SESSION["IsSubAdmin"] == 1)|| ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0)))     {  
                                 
                                if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && (($_SESSION["UserType"] == 1 || $_SESSION["Credit_Management"] == 1) || ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0)))                          
                                { 
                                $html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="CreditManagement.php"><span id="headertext">Credits Management</span></a></li>'; 
                                 } 
                                 if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && (($_SESSION["UserType"] == 1 || $_SESSION["User_Management"] == 1) || ($_SESSION["UserType"] == 2 && $_SESSION["ParentID"] == 0)))  
                                 { 
                                $html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="UserManagement.php"><span id="headertext">User Management</span></a></li>'; 
                                } 
                                 if((isset($_SESSION["User"]) && $_SESSION["User"] == true) && ($_SESSION["UserType"] == 1 || $_SESSION["Company_Profile"] == 1)) 
                                 { 
                                $html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="CompanyProfile.php"><span id="headertext">Company Profile</span></a></li>'; 
                                } 
                                } 
                                $html .= '<li  id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="'.(isset($_SESSION["User"]) && $_SESSION["User"] == true && $_SESSION["UserType"] == 1 ? "UpdateProfileCorporate.php" : "UpdateProfileIndividual.php").'"><span id="headertext">Personal Details</span></a></li>'; 
                                $html .= '<li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="Logout.php"><span id="headertext">Logout</span></a></li>'; 
                                 
                                $html .= '</ul>'; 
                    } 
                    else 
                    { 
                        $Title = dboutput($RsC["Title"]); 
                        $href = dboutput($RsC["ExternalLink"]); 
                    } 
                } 
                else 
                { 
                    $Title = dboutput($RsC["Title"]); 
                    $href = (dboutput($RsC["ExternalLink"]) != "" ? dboutput($RsC["ExternalLink"]) : "Page.php?id=".$RsC["ID"]); 
                } 
                 
                if($parent_id == 0) 
                    echo '<li id="menu-item-'.$RsC["ID"].'" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="'.$href.'" target="'.$_OPEN_IN[$RsC["LinkTargert"]].'"><span id="headertext">'.$Title.'</span></a>'.$html; 
                else 
                    echo '<li id="menu-item-'.$RsC["ID"].'" class="menu-item menu-item-type-post_type menu-item-object-portfolio"><a href="'.$href.'" target="'.$_OPEN_IN[$RsC["LinkTargert"]].'"><span id="headertext">'.$Title.'</span></a>'; 
                     
                get_menu($RsC["ID"]); 
                 
                echo '</li>'; 
            } 
             
            echo '</ul>'; 
        } 
     
    } 
    function get_pages_ids($parent_id = 0) 
    { 
        global $pages_ids; 
        $r = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ID FROM cms  WHERE ParentID = " . (int)$parent_id) or die("Product categories tree select: " . mysqli_error($GLOBALS["___mysqli_ston"])); 
        if(mysqli_num_rows($r) > 0) 
        { 
            while($RsC = mysqli_fetch_assoc($r)) 
            { 
                $pages_ids .= "," . $RsC["ID"]; 
                     
                get_pages_ids($RsC["ID"]); 
            } 
             
        } 
    } 
    function generate_password() 
    { 
        $pass = ""; 
        $salt = "ABCDEFGHIJKLMNOPQRSTUVWXWZ0123456789abchefghjkmnpqrstuvwxyz"; 
        srand((double)microtime()*1000000); 
        $i = 0;         
        while ($i <= 7) { 
            $num = rand() % 33; 
            $tmp = substr($salt, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
         
        return $pass; 
    } 
     
    function generate_refno($ID) 
    { 
        $refno = ""; 
        $salt = "ABCDEFGHIJKLMNOPQRSTUVWXWZ0123456789abchefghjkmnpqrstuvwxyz"; 
        srand((double)microtime()*1000000); 
        $i = 0;   
        while ($i <= 7) 
        { 
            $num = rand() % 33; 
            $tmp = substr($salt, $num, 1); 
            $refno = $refno . $tmp; 
            $i++; 
            if($i == 4) 
                $refno = $refno . $ID; 
        } 
         
        return $refno; 
    } 
     
    function send_mail($From, $To, $Subject, $Body, $IsHTML = true, $Attachments=array()) 
    { 
        $headers = "from: ".SMTP_USER."\r\n"; 
        $headers .= "Content-type: text/html\r\n"; 
        return mail($To, $Subject, $Body, $headers); 
         
    } 
         
    function count_coupon($StoreID) 
    { 
     
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM coupons WHERE StoreID = ".(int)$StoreID.""); 
        $total = mysqli_num_rows($res); 
         
        return $total; 
         
    } 
    function get_total_coupons() 
    { 
     
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM coupons"); 
        $total = mysqli_num_rows($res); 
         
        return $total; 
         
    } 
    function total_orders() 
    { 
     
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM orders"); 
        $total = mysqli_num_rows($res); 
         
        return $total; 
         
    } 
     
     
    function get_total_store() 
    { 
     
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM stores"); 
        $total = mysqli_num_rows($res); 
         
        return $total; 
         
    } 
    function get_brand($Name) 
    { 
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ID,BrandName,Image FROM brands WHERE ID <> 0 AND BrandName Like '".$Name."%'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
        $num = mysqli_num_rows($res); 
        if($num = 0) 
        { 
            echo ' '; 
        } 
        else 
        { 
            while($row = mysqli_fetch_array($res)) 
            { 
                echo '<div class="col-md-2 col-xs-12"> 
                        <div class="item-innner" align="center">                                                                                                                             
                            <img src="admin/'.DIR_BRANDS_IMAGES.dboutput($row['Image']).'" alt="" style="width:190px; height:110px; border:solid 1px #c1c1c1;"> 
                            <a href="#"><h3>'.$row['BrandName'].'</h3></a> 
                        </div> 
                    </div>'; 
            } 
        } 
    } 
     
     
    function converCurrency($from,$to,$amount){ 
         $url = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";  
         $request = curl_init();  
         $timeOut = 0;  
         curl_setopt ($request, CURLOPT_URL, $url);  
         curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1);  
         curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");  
         curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut);  
         $response = curl_exec($request);  
         curl_close($request);  
         return $response; 
         } 
          
          
     // function dirhamtodollar($price = 0) 
    // { 
        // $from_currency    = 'AED'; 
        // $to_currency    = 'USD'; 
        // $amount            = $price; 

        // $results = converCurrency($from_currency,$to_currency,$amount); 
        // $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s'; 
        // preg_match($regularExpression, $results, $finalData); 
        // if($price != 0) 
        // { 
            // $split = explode(' ',$finalData[0]); 
            // $number = explode('>',$split[1]); 
            // $twodigit = $number[1]; 
            // $final = number_format((float)$twodigit, 2, '.', ''); 
            // return $final; 
        // } 
        // return 0; 
    // }  
     
    // function dollartodirham($price = 0) 
    // { 
        // $from_currency    = 'USD'; 
        // $to_currency    = 'AED'; 
        // $amount            = $price; 

        // $results = converCurrency($from_currency,$to_currency,$amount); 
        // $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s'; 
        // preg_match($regularExpression, $results, $finalData); 
        // if($price != 0) 
        // { 
            // $split = explode(' ',$finalData[0]); 
            // $number = explode('>',$split[1]); 
            // $twodigit = $number[1]; 
            // $final = number_format((float)$twodigit, 2, '.', ''); 
            // return $final; 
        // } 
        // return 0; 
    // }  


    function dollartoeuro($price = 0) 
    { 
        $from_currency    = 'USD'; 
        $to_currency    = 'EUR'; 
        $amount            = $price; 

        $results = converCurrency($from_currency,$to_currency,$amount); 
        $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s'; 
        preg_match($regularExpression, $results, $finalData); 
        if($price != 0) 
        { 
            $split = explode(' ',$finalData[0]); 
            $number = explode('>',$split[1]); 
            $twodigit = $number[1]; 
            $final = number_format((float)$twodigit, 2, '.', ''); 
            return $final; 
        } 
        return 0; 
    } 
    function get_breadcrumbs($id, $category_tbl, $nm) 
    { 
        $s = "SELECT * FROM ".$category_tbl." WHERE ID = $id"; 
        $r = mysqli_query($GLOBALS["___mysqli_ston"], $s); 
        $row = mysqli_fetch_array($r); 

        if($row['Parent'] == 0) { 
            return ($nm == 1 ? '<li><a>'.$row['CategoryName'].'</a></li>' : '<li><a href="category.php?ID='.$row['ID'].'" title="'.$row['CategoryName'].'">'.$row['CategoryName'].'</a></li>'); 
        } else { 
            return get_breadcrumbs($row['Parent'],$category_tbl,$nm+1).($nm == 1 ? '<li class="active"><a>'.$row['CategoryName'].'</a></li>' : '<li><a href="category.php?ID='.$row['ID'].'" title="'.$row['CategoryName'].'">'.$row['CategoryName'].'</a> </li>'); 
        } 
    } 
    function get_breadcrumbs_cat($id, $category_tbl, $nm, $main) 
    { 
        $s = "SELECT * FROM ".$category_tbl." WHERE ID = $id"; 
        $r = mysqli_query($GLOBALS["___mysqli_ston"], $s); 
        $row = mysqli_fetch_array($r); 
        if($row['Parent'] == 0) { 
            return '<li><a href="category.php?ID='.$row['ID'].'" title="'.$row['CategoryName'].'">'.$row['CategoryName'].'</a></li>'; 
        } else { 
            return get_breadcrumbs_cat($row['Parent'],$category_tbl,$nm+1,$main).'<li><a href="category.php?ID='.$row['ID'].'" >'.$row['CategoryName'].'</a> </li>'; 
        } 
    } 

    function dollartopound($price = 0) 
    { 
        $from_currency    = 'USD'; 
        $to_currency    = 'GBP'; 
        $amount            = $price; 

        $results = converCurrency($from_currency,$to_currency,$amount); 
        $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s'; 
        preg_match($regularExpression, $results, $finalData); 
        if($price != 0) 
        { 
            $split = explode(' ',$finalData[0]); 
            $number = explode('>',$split[1]); 
            $twodigit = $number[1]; 
            $final = number_format((float)$twodigit, 2, '.', ''); 
            return $final; 
        } 
        return 0; 
    }  
     
    function poundtodollar($price = 0) 
    { 
        $from_currency    = 'GBP'; 
        $to_currency    = 'USD'; 
        $amount            = $price; 

        $results = converCurrency($from_currency,$to_currency,$amount); 
        $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s'; 
        preg_match($regularExpression, $results, $finalData); 
        if($price != 0) 
        { 
            $split = explode(' ',$finalData[0]); 
            $number = explode('>',$split[1]); 
            $twodigit = $number[1]; 
            $final = number_format((float)$twodigit, 2, '.', ''); 
            return $final; 
        } 
        return 0; 
    } 
    function eurotodollar($price = 0) 
    { 
        $from_currency    = 'EUR'; 
        $to_currency    = 'USD'; 
        $amount            = $price; 

        $results = converCurrency($from_currency,$to_currency,$amount); 
        $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s'; 
        preg_match($regularExpression, $results, $finalData); 
        if($price != 0) 
        { 
            $split = explode(' ',$finalData[0]); 
            $number = explode('>',$split[1]); 
            $twodigit = $number[1]; 
            $final = number_format((float)$twodigit, 2, '.', ''); 
            return $final; 
        } 
        return 0; 
    }  
     
    define("CURRENCY_SYMBOL", "Rs. "); 
    define("EURO_CURRENCY_SYMBOL", "&#128; "); 
    define("POUND_CURRENCY_SYMBOL", "&#163; "); 
     
    function PercentageToRatio($per = 0) 
    { 
        $rating = $per / 20; 
        echo $rating; 
    } 

    function getCountryByCode($Country) 
    { 
            echo ($Country == 'AFG' ? 'Afghanistan' : ''); 
            echo ($Country == 'ALA' ? '�land Islands' : ''); 
            echo ($Country == 'ALB' ? 'Albania' : ''); 
            echo ($Country == 'DZA' ? 'Algeria' : ''); 
            echo ($Country == 'ASM' ? 'American Samoa' : ''); 
            echo ($Country == 'AND' ? 'Andorra' : ''); 
            echo ($Country == 'AGO' ? 'Angola' : ''); 
            echo ($Country == 'AIA' ? 'Anguilla' : ''); 
            echo ($Country == 'ATA' ? 'Antarctica' : ''); 
            echo ($Country == 'ATG' ? 'Antigua and Barbuda' : ''); 
            echo ($Country == 'ARG' ? 'Argentina' : ''); 
            echo ($Country == 'ARM' ? 'Armenia' : ''); 
            echo ($Country == 'ABW' ? 'Aruba' : ''); 
            echo ($Country == 'AUS' ? 'Australia' : ''); 
            echo ($Country == 'AUT' ? 'Austria' : ''); 
            echo ($Country == 'AZE' ? 'Azerbaijan' : ''); 
            echo ($Country == 'BHS' ? 'Bahamas' : ''); 
            echo ($Country == 'BHR' ? 'Bahrain' : ''); 
            echo ($Country == 'BGD' ? 'Bangladesh' : ''); 
            echo ($Country == 'BRB' ? 'Barbados' : ''); 
            echo ($Country == 'BLR' ? 'Belarus' : ''); 
            echo ($Country == 'BEL' ? 'Belgium' : ''); 
            echo ($Country == 'BLZ' ? 'Belize' : ''); 
            echo ($Country == 'BEN' ? 'Benin' : ''); 
            echo ($Country == 'BMU' ? 'Bermuda' : ''); 
            echo ($Country == 'BTN' ? 'Bhutan' : ''); 
            echo ($Country == 'BOL' ? 'Bolivia, Plurinational State of' : ''); 
            echo ($Country == 'BES' ? 'Bonaire, Sint Eustatius and Saba' : ''); 
            echo ($Country == 'BIH' ? 'Bosnia and Herzegovina' : ''); 
            echo ($Country == 'BWA' ? 'Botswana' : ''); 
            echo ($Country == 'BVT' ? 'Bouvet Island' : ''); 
            echo ($Country == 'BRA' ? 'Brazil' : ''); 
            echo ($Country == 'IOT' ? 'British Indian Ocean Territory' : ''); 
            echo ($Country == 'BRN' ? 'Brunei Darussalam' : ''); 
            echo ($Country == 'BGR' ? 'Bulgaria' : ''); 
            echo ($Country == 'BFA' ? 'Burkina Faso' : ''); 
            echo ($Country == 'BDI' ? 'Burundi' : ''); 
            echo ($Country == 'KHM' ? 'Cambodia' : ''); 
            echo ($Country == 'CMR' ? 'Cameroon' : ''); 
            echo ($Country == 'CAN' ? 'Canada' : ''); 
            echo ($Country == 'CPV' ? 'Cape Verde' : ''); 
            echo ($Country == 'CYM' ? 'Cayman Islands' : ''); 
            echo ($Country == 'CAF' ? 'Central African Republic' : ''); 
            echo ($Country == 'TCD' ? 'Chad' : ''); 
            echo ($Country == 'CHL' ? 'Chile' : ''); 
            echo ($Country == 'CHN' ? 'China' : ''); 
            echo ($Country == 'CXR' ? 'Christmas Island' : ''); 
            echo ($Country == 'CCK' ? 'Cocos (Keeling) Islands' : ''); 
            echo ($Country == 'COL' ? 'Colombia' : ''); 
            echo ($Country == 'COM' ? 'Comoros' : ''); 
            echo ($Country == 'COG' ? 'Congo' : ''); 
            echo ($Country == 'COD' ? 'Congo, the Democratic Republic of the' : ''); 
            echo ($Country == 'COK' ? 'Cook Islands' : ''); 
            echo ($Country == 'CRI' ? 'Costa Rica' : ''); 
            echo ($Country == 'CIV' ? 'C�te dIvoire' : ''); 
            echo ($Country == 'HRV' ? 'Croatia' : ''); 
            echo ($Country == 'CUB' ? 'Cuba' : ''); 
            echo ($Country == 'CUW' ? 'Cura�ao' : ''); 
            echo ($Country == 'CYP' ? 'Cyprus' : ''); 
            echo ($Country == 'CZE' ? 'Czech Republic' : ''); 
            echo ($Country == 'DNK' ? 'Denmark' : ''); 
            echo ($Country == 'DJI' ? 'Djibouti' : ''); 
            echo ($Country == 'DMA' ? 'Dominica' : ''); 
            echo ($Country == 'DOM' ? 'Dominican Republic' : ''); 
            echo ($Country == 'ECU' ? 'Ecuador' : ''); 
            echo ($Country == 'EGY' ? 'Egypt' : ''); 
            echo ($Country == 'SLV' ? 'El Salvador' : ''); 
            echo ($Country == 'GNQ' ? 'Equatorial Guinea' : ''); 
            echo ($Country == 'ERI' ? 'Eritrea' : ''); 
            echo ($Country == 'EST' ? 'Estonia' : ''); 
            echo ($Country == 'ETH' ? 'Ethiopia' : ''); 
            echo ($Country == 'FLK' ? 'Falkland Islands (Malvinas)' : ''); 
            echo ($Country == 'FRO' ? 'Faroe Islands' : ''); 
            echo ($Country == 'FJI' ? 'Fiji' : ''); 
            echo ($Country == 'FIN' ? 'Finland' : ''); 
            echo ($Country == 'FRA' ? 'France' : ''); 
            echo ($Country == 'GUF' ? 'French Guiana' : ''); 
            echo ($Country == 'PYF' ? 'French Polynesia' : ''); 
            echo ($Country == 'ATF' ? 'French Southern Territories' : ''); 
            echo ($Country == 'GAB' ? 'Gabon' : ''); 
            echo ($Country == 'GMB' ? 'Gambia' : ''); 
            echo ($Country == 'GEO' ? 'Georgia' : ''); 
            echo ($Country == 'DEU' ? 'Germany' : ''); 
            echo ($Country == 'GHA' ? 'Ghana' : ''); 
            echo ($Country == 'GIB' ? 'Gibraltar' : ''); 
            echo ($Country == 'GRC' ? 'Greece' : ''); 
            echo ($Country == 'GRL' ? 'Greenland' : ''); 
            echo ($Country == 'GRD' ? 'Grenada' : ''); 
            echo ($Country == 'GLP' ? 'Guadeloupe' : ''); 
            echo ($Country == 'GUM' ? 'Guam' : ''); 
            echo ($Country == 'GTM' ? 'Guatemala' : ''); 
            echo ($Country == 'GGY' ? 'Guernsey' : ''); 
            echo ($Country == 'GIN' ? 'Guinea' : ''); 
            echo ($Country == 'GNB' ? 'Guinea-Bissau' : ''); 
            echo ($Country == 'GUY' ? 'Guyana' : ''); 
            echo ($Country == 'HTI' ? 'Haiti' : ''); 
            echo ($Country == 'HMD' ? 'Heard Island and McDonald Islands' : ''); 
            echo ($Country == 'VAT' ? 'Holy See (Vatican City State)' : ''); 
            echo ($Country == 'HND' ? 'Honduras' : ''); 
            echo ($Country == 'HKG' ? 'Hong Kong' : ''); 
            echo ($Country == 'HUN' ? 'Hungary' : ''); 
            echo ($Country == 'ISL' ? 'Iceland' : ''); 
            echo ($Country == 'IND' ? 'India' : ''); 
            echo ($Country == 'IDN' ? 'Indonesia' : ''); 
            echo ($Country == 'IRN' ? 'Iran, Islamic Republic of' : ''); 
            echo ($Country == 'IRQ' ? 'Iraq' : ''); 
            echo ($Country == 'IRL' ? 'Ireland' : ''); 
            echo ($Country == 'IMN' ? 'Isle of Man' : ''); 
            echo ($Country == 'ISR' ? 'Israel' : ''); 
            echo ($Country == 'ITA' ? 'Italy' : ''); 
            echo ($Country == 'JAM' ? 'Jamaica' : ''); 
            echo ($Country == 'JPN' ? 'Japan' : ''); 
            echo ($Country == 'JEY' ? 'Jersey' : ''); 
            echo ($Country == 'JOR' ? 'Jordan' : ''); 
            echo ($Country == 'KAZ' ? 'Kazakhstan' : ''); 
            echo ($Country == 'KEN' ? 'Kenya' : ''); 
            echo ($Country == 'KIR' ? 'Kiribati' : ''); 
            echo ($Country == 'PRK' ? 'Korea, Democratic Peoples Republic of' : ''); 
            echo ($Country == 'KOR' ? 'Korea, Republic of' : ''); 
            echo ($Country == 'KWT' ? 'Kuwait' : ''); 
            echo ($Country == 'KGZ' ? 'Kyrgyzstan' : ''); 
            echo ($Country == 'LAO' ? 'Lao Peoples Democratic Republic' : ''); 
            echo ($Country == 'LVA' ? 'Latvia' : ''); 
            echo ($Country == 'LBN' ? 'Lebanon' : ''); 
            echo ($Country == 'LSO' ? 'Lesotho' : ''); 
            echo ($Country == 'LBR' ? 'Liberia' : ''); 
            echo ($Country == 'LBY' ? 'Libya' : ''); 
            echo ($Country == 'LIE' ? 'Liechtenstein' : ''); 
            echo ($Country == 'LTU' ? 'Lithuania' : ''); 
            echo ($Country == 'LUX' ? 'Luxembourg' : ''); 
            echo ($Country == 'MAC' ? 'Macao' : ''); 
            echo ($Country == 'MKD' ? 'Macedonia, the former Yugoslav Republic of' : ''); 
            echo ($Country == 'MDG' ? 'Madagascar' : ''); 
            echo ($Country == 'MWI' ? 'Malawi' : ''); 
            echo ($Country == 'MYS' ? 'Malaysia' : ''); 
            echo ($Country == 'MDV' ? 'Maldives' : ''); 
            echo ($Country == 'MLI' ? 'Mali' : ''); 
            echo ($Country == 'MLT' ? 'Malta' : ''); 
            echo ($Country == 'MHL' ? 'Marshall Islands' : ''); 
            echo ($Country == 'MTQ' ? 'Martinique' : ''); 
            echo ($Country == 'MRT' ? 'Mauritania' : ''); 
            echo ($Country == 'MUS' ? 'Mauritius' : ''); 
            echo ($Country == 'MYT' ? 'Mayotte' : ''); 
            echo ($Country == 'MEX' ? 'Mexico' : ''); 
            echo ($Country == 'FSM' ? 'Micronesia, Federated States of' : ''); 
            echo ($Country == 'MDA' ? 'Moldova, Republic of' : ''); 
            echo ($Country == 'MCO' ? 'Monaco' : ''); 
            echo ($Country == 'MNG' ? 'Mongolia' : ''); 
            echo ($Country == 'MNE' ? 'Montenegro' : ''); 
            echo ($Country == 'MSR' ? 'Montserrat' : ''); 
            echo ($Country == 'MAR' ? 'Morocco' : ''); 
            echo ($Country == 'MOZ' ? 'Mozambique' : ''); 
            echo ($Country == 'MMR' ? 'Myanmar' : ''); 
            echo ($Country == 'NAM' ? 'Namibia' : ''); 
            echo ($Country == 'NRU' ? 'Nauru' : ''); 
            echo ($Country == 'NPL' ? 'Nepal' : ''); 
            echo ($Country == 'NLD' ? 'Netherlands' : ''); 
            echo ($Country == 'NCL' ? 'New Caledonia' : ''); 
            echo ($Country == 'NZL' ? 'New Zealand' : ''); 
            echo ($Country == 'NIC' ? 'Nicaragua' : ''); 
            echo ($Country == 'NER' ? 'Niger' : ''); 
            echo ($Country == 'NGA' ? 'Nigeria' : ''); 
            echo ($Country == 'NIU' ? 'Niue' : ''); 
            echo ($Country == 'NFK' ? 'Norfolk Island' : ''); 
            echo ($Country == 'MNP' ? 'Northern Mariana Islands' : ''); 
            echo ($Country == 'NOR' ? 'Norway' : ''); 
            echo ($Country == 'OMN' ? 'Oman' : ''); 
            echo ($Country == 'PAK' ? 'Pakistan' : ''); 
            echo ($Country == 'PLW' ? 'Palau' : ''); 
            echo ($Country == 'PSE' ? 'Palestinian Territory, Occupied' : ''); 
            echo ($Country == 'PAN' ? 'Panama' : ''); 
            echo ($Country == 'PNG' ? 'Papua New Guinea' : ''); 
            echo ($Country == 'PRY' ? 'Paraguay' : ''); 
            echo ($Country == 'PER' ? 'Peru' : ''); 
            echo ($Country == 'PHL' ? 'Philippines' : ''); 
            echo ($Country == 'PCN' ? 'Pitcairn' : ''); 
            echo ($Country == 'POL' ? 'Poland' : ''); 
            echo ($Country == 'PRT' ? 'Portugal' : ''); 
            echo ($Country == 'PRI' ? 'Puerto Rico' : ''); 
            echo ($Country == 'QAT' ? 'Qatar' : ''); 
            echo ($Country == 'REU' ? 'R�union' : ''); 
            echo ($Country == 'ROU' ? 'Romania' : ''); 
            echo ($Country == 'RUS' ? 'Russian Federation' : ''); 
            echo ($Country == 'RWA' ? 'Rwanda' : ''); 
            echo ($Country == 'BLM' ? 'Saint Barth�lemy' : ''); 
            echo ($Country == 'SHN' ? 'Saint Helena, Ascension and Tristan da Cunha' : ''); 
            echo ($Country == 'KNA' ? 'Saint Kitts and Nevis' : ''); 
            echo ($Country == 'LCA' ? 'Saint Lucia' : ''); 
            echo ($Country == 'MAF' ? 'Saint Martin (French part)' : ''); 
            echo ($Country == 'SPM' ? 'Saint Pierre and Miquelon' : ''); 
            echo ($Country == 'VCT' ? 'Saint Vincent and the Grenadines' : ''); 
            echo ($Country == 'WSM' ? 'Samoa' : ''); 
            echo ($Country == 'SMR' ? 'San Marino' : ''); 
            echo ($Country == 'STP' ? 'Sao Tome and Principe' : ''); 
            echo ($Country == 'SAU' ? 'Saudi Arabia' : ''); 
            echo ($Country == 'SEN' ? 'Senegal' : ''); 
            echo ($Country == 'SRB' ? 'Serbia' : ''); 
            echo ($Country == 'SYC' ? 'Seychelles' : ''); 
            echo ($Country == 'SLE' ? 'Sierra Leone' : ''); 
            echo ($Country == 'SGP' ? 'Singapore' : ''); 
            echo ($Country == 'SXM' ? 'Sint Maarten (Dutch part)' : ''); 
            echo ($Country == 'SVK' ? 'Slovakia' : ''); 
            echo ($Country == 'SVN' ? 'Slovenia' : ''); 
            echo ($Country == 'SLB' ? 'Solomon Islands' : ''); 
            echo ($Country == 'SOM' ? 'Somalia' : ''); 
            echo ($Country == 'ZAF' ? 'South Africa' : ''); 
            echo ($Country == 'SGS' ? 'South Georgia and the South Sandwich Islands' : ''); 
            echo ($Country == 'SSD' ? 'South Sudan' : ''); 
            echo ($Country == 'ESP' ? 'Spain' : ''); 
            echo ($Country == 'LKA' ? 'Sri Lanka' : ''); 
            echo ($Country == 'SDN' ? 'Sudan' : ''); 
            echo ($Country == 'SUR' ? 'Suriname' : ''); 
            echo ($Country == 'SJM' ? 'Svalbard and Jan Mayen' : ''); 
            echo ($Country == 'SWZ' ? 'Swaziland' : ''); 
            echo ($Country == 'SWE' ? 'Sweden' : ''); 
            echo ($Country == 'CHE' ? 'Switzerland' : ''); 
            echo ($Country == 'SYR' ? 'Syrian Arab Republic' : ''); 
            echo ($Country == 'TWN' ? 'Taiwan, Province of China' : ''); 
            echo ($Country == 'TJK' ? 'Tajikistan' : ''); 
            echo ($Country == 'TZA' ? 'Tanzania, United Republic of' : ''); 
            echo ($Country == 'THA' ? 'Thailand' : ''); 
            echo ($Country == 'TLS' ? 'Timor-Leste' : ''); 
            echo ($Country == 'TGO' ? 'Togo' : ''); 
            echo ($Country == 'TKL' ? 'Tokelau' : ''); 
            echo ($Country == 'TON' ? 'Tonga' : ''); 
            echo ($Country == 'TTO' ? 'Trinidad and Tobago' : ''); 
            echo ($Country == 'TUN' ? 'Tunisia' : ''); 
            echo ($Country == 'TUR' ? 'Turkey' : ''); 
            echo ($Country == 'TKM' ? 'Turkmenistan' : ''); 
            echo ($Country == 'TCA' ? 'Turks and Caicos Islands' : ''); 
            echo ($Country == 'TUV' ? 'Tuvalu' : ''); 
            echo ($Country == 'UGA' ? 'Uganda' : ''); 
            echo ($Country == 'UKR' ? 'Ukraine' : ''); 
            echo ($Country == 'ARE' ? 'United Arab Emirates' : ''); 
            echo ($Country == 'GBR' ? 'United Kingdom' : ''); 
            echo ($Country == 'USA' ? 'United States' : ''); 
            echo ($Country == 'UMI' ? 'United States Minor Outlying Islands' : ''); 
            echo ($Country == 'URY' ? 'Uruguay' : ''); 
            echo ($Country == 'UZB' ? 'Uzbekistan' : ''); 
            echo ($Country == 'VUT' ? 'Vanuatu' : ''); 
            echo ($Country == 'VEN' ? 'Venezuela, Bolivarian Republic of' : ''); 
            echo ($Country == 'VNM' ? 'Viet Nam' : ''); 
            echo ($Country == 'VGB' ? 'Virgin Islands, British' : ''); 
            echo ($Country == 'VIR' ? 'Virgin Islands, U.S.' : ''); 
            echo ($Country == 'WLF' ? 'Wallis and Futuna' : ''); 
            echo ($Country == 'ESH' ? 'Western Sahara' : ''); 
            echo ($Country == 'YEM' ? 'Yemen' : ''); 
            echo ($Country == 'ZMB' ? 'Zambia' : ''); 
            echo ($Country == 'ZWE' ? 'Zimbabwe' : ''); 
    } 
    function  total_products() 
        { 
             
            $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM products") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
         
         
         
        function  total_categories() 
        { 
             
            $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM categories") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
        function  total_brands() 
        { 
             
            $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM brands") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
         
        function  total_shirts() 
        { 
         
             
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM products where Status = 1 AND FIND_IN_SET('107',Categories) AND FIND_IN_SET('125',Categories)") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
     
    function  total_pants() 
        { 
             
            $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM products where Status = 1 AND FIND_IN_SET('117',Categories)AND FIND_IN_SET('107',Categories)") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
         
        function  total_t_shirts() 
        { 
         
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM products where Status = 1 AND FIND_IN_SET('107',Categories) AND FIND_IN_SET('126',Categories) ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
         
            function total_kids_jeans() 
        { 
         
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM products where Status = 1 AND FIND_IN_SET('108',Categories) AND  FIND_IN_SET('137',Categories) " ) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
         
        function total_mens_shoes() 
        { 
         
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM products where Status = 1 AND FIND_IN_SET('107',Categories) AND  FIND_IN_SET('143',Categories) " ) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
            function total_kids_shoes() 
        { 
         
        $res = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM products where Status = 1 AND FIND_IN_SET('108',Categories) AND  FIND_IN_SET('144',Categories) " ) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
            $Rs = mysqli_fetch_assoc($res); 
            $Students = mysqli_num_rows($res); 
            return $Students; 
        } 
?> 