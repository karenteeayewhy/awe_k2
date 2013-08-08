<?php

function businessstory_retrieve() {
  drupal_add_js(drupal_get_path('module', 'businesslist') .'/js/jquery.ae.image.resize.min.js');
  drupal_add_js(drupal_get_path('module', 'businesslist') .'/js/test.js');
  drupal_add_js(drupal_get_path('module', 'contribution') .'/jquery-ui-1.8.16.custom.min.js');
  drupal_add_css(drupal_get_path('module', 'contribution') .'/giving.css');
    $check_cid = db_result(db_query("SELECT COUNT(fid) FROM company_profile_values WHERE cid=".$_GET['companyID']));
    if ($check_cid == 0) {
        drupal_set_message("Could not find the business detail. You are redirected to home page.");
        drupal_goto('');
    }

    $current_user = $GLOBALS['user']->uid;
    $html = '<p align="right"><span style="float:left; width:110px;"><g:plusone></g:plusone>
				  <script type="text/javascript">// <![CDATA[
   (function() {
     var po = document.createElement("script");
     po.type = "text/javascript"; po.async = true;
     po.src = "https://apis.google.com/js/plusone.js";
     var s = document.getElementsByTagName("script")[0];
     s.parentNode.insertBefore(po, s);
    })();
// ]]></script></span>
  <a href="/buy1give1/?q=businesslist"> << Back to full business list</a></p>';
    $company= "(SELECT * FROM
                (SELECT temp31.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website,c_email,c_facebook,c_twitter, c_phone,c_primary_pic, c_secondary_pic, uid FROM
                (SELECT temp25.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website,c_email,c_facebook,c_twitter, c_phone,c_primary_pic, c_secondary_pic FROM
                (SELECT temp23.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website,c_email,c_facebook,c_twitter, c_phone,c_primary_pic FROM
                (SELECT temp21.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website,c_email,c_facebook,c_twitter, c_phone FROM
                (SELECT temp19.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website,c_email,c_facebook,c_twitter FROM
                (SELECT temp17.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website,c_email,c_facebook FROM
                (SELECT temp15.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website,c_email FROM
                (SELECT temp13.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission,c_website FROM
                (SELECT temp11.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about,c_mission FROM
                (SELECT temp9.cid,c_name,c_country,c_industry,c_product_service, c_logo, c_about FROM
                (SELECT temp7.cid,c_name,c_country,c_industry,c_product_service, c_logo FROM
                (SELECT temp5.cid,c_name,c_country,c_industry,c_product_service FROM
                (SELECT temp3.cid,c_name,c_country,c_industry FROM
                (SELECT temp1.cid,c_name,c_country FROM
                (SELECT cid, VALUE AS c_name FROM company_profile_values WHERE fid=40) AS temp1
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_country FROM company_profile_values WHERE fid=51)AS temp2
                ON temp1.cid= temp2.cid) AS temp3
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_industry FROM company_profile_values WHERE fid=62)AS temp4
                ON temp3.cid=temp4.cid) AS temp5
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_product_service FROM company_profile_values WHERE fid=63)AS temp6
                ON temp5.cid = temp6.cid) AS temp7
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_logo FROM company_profile_values WHERE fid=59) AS temp8
                ON temp7.cid= temp8.cid) AS temp9
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_about FROM company_profile_values WHERE fid=57) AS temp10
                ON temp9.cid = temp10.cid) AS temp11
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_mission FROM company_profile_values WHERE fid=64) AS temp12
                ON temp11.cid = temp12.cid) AS temp13
                LEFT OUTER JOIN
                (SELECT cid,VALUE AS c_website FROM company_profile_values WHERE fid=58) AS temp14
                ON temp13.cid = temp14.cid) AS temp15
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_email FROM company_profile_values WHERE fid=41) AS temp16
                ON temp15.cid = temp16.cid) AS temp17
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_facebook FROM company_profile_values WHERE fid=65) AS temp18
                ON temp17.cid = temp18.cid) AS temp19
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_twitter FROM company_profile_values WHERE fid=66) AS temp20
                ON temp19.cid = temp20.cid) AS temp21
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_phone FROM company_profile_values WHERE fid=42) AS temp22
                ON temp21.cid = temp22.cid) AS temp23
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_primary_pic FROM company_profile_values WHERE fid=73) AS temp24
                ON temp23.cid = temp24.cid) AS temp25
                LEFT OUTER JOIN
                (SELECT cid, VALUE AS c_secondary_pic FROM company_profile_values WHERE fid=74) AS temp26
                ON temp25.cid = temp26.cid) AS temp31
                LEFT OUTER JOIN
                (SELECT p.value AS cid, p.uid AS uid FROM profile_values p WHERE  p.fid = 1) AS temp32
                ON temp31.cid = temp32.cid) AS temp27
                LEFT OUTER JOIN           
                (SELECT company_id, category1, category2, contribution_pai_to_wc_date, contribution_status,
                MAX(contribution_paid_toB1G1) AS contribution_last_date, COUNT(company_id) AS time_of_donation, MIN(contribution_paid_toB1G1) AS contribution_first_date FROM contribution
                WHERE contribution_status <> 'unsuccessful' AND contribution_status <> 'unconfirmed' AND contribution_status <> 'cancelled' 
                GROUP BY company_id) AS temp29
                ON temp27.cid = temp29.company_id) AS c";
    $sql = "SELECT * FROM ". $company. ", users_roles As r WHERE c.cid  =".$_GET['companyID']. " AND r.uid = c.uid AND (r.rid = 6 OR r.rid = 9 OR r.rid = 13 OR r.rid = 14 OR r.rid = 15)";
  //echo 'sql= '.$sql;
    $result = db_query($sql);
//    echo 'result= '.$result;
    //$html .= '<form name="becomeFan" method="post" action ="?q=/giving"/>';

    $html = $html.'<table width="700px" class="listing">';

    while ($data = db_fetch_object($result)) {
        //echo $data;
        $sql2 = "SELECT uid FROM profile_values WHERE fid = 1 AND value=".$data->cid;
//        echo 'sql2= '.$sql2;
        $result2 = db_query($sql2);
        $user = db_result($result2);
        $last_giving = date("d/m/Y",$data->contribution_last_date);
        if($last_giving == '01/01/1970') {
            $last_giving = '';
        }
        $first_giving = date("d/m/Y",$data->contribution_first_date);
        //$member_since_date = strtotime($data->member_since);
		$member_since_date = db_result(db_query('SELECT  `created`  FROM  `users`  WHERE  `uid` ="'.$data->uid.'" LIMIT 1'));
        $member_since = date("d/m/Y", $member_since_date);
        $pic_url = $data->c_logo;
        if($pic_url == 'N' || $pic_url == NULL || $pic_url == '') {
            $pic_url = 'blank_image.png';
        }


        $dgilgi_temp = get_dgilgi_formatted($data);
        $picture_strings = prepare_dgilgi_pic_string($dgilgi_temp['supported_giving']);
        $picture_string['pic3'] = '<img src="http://'.$_SERVER["SERVER_NAME"].'/buy1give1/sites/default/files/company/'.$pic_url.'" class="resizeme1" />';
//width="142" height="100"

        $html .= '<tr>
                  <td width="150" rowspan="2" valign ="top" align="center" style="padding-bottom:1.5ex"><img src="http://'.$_SERVER["SERVER_NAME"].'/buy1give1/sites/default/files/company/'.$pic_url.'" class="resizeme1"  /><br />';
        //$html .= '<input type="submit" value="BECOME A FAN" class="form-submit" /> </form></td>'; width="142" height="100"
        $html .= '<th bgcolor="#F7F7F7" valign="top" width="420px"><font color="#232323"><font size="3.1em">'.$data->c_name.'</font></font></th>
                  <th bgcolor="#F7F7F7" valign="top" width="100px">';
        if($user == $current_user) {
            $html .= '<form name="edit" method="post" action ="?q=user/'.$user.'/edit/Company Profile Information">
                  <div style="font-size: 11pt; color: #DC6E02; font-weight:bold;">
                  <input type="submit" value="EDIT" class="form-submit" />
                  </div></form>';
        }
        $html .= '</th></tr>';
		
		
		
        $html .= '<tr valign="top">
                    <td width="350px">'.$data->c_mission.'</td>
                    <td width="170px" colspan="2">
                        <font color="#999999">Last Giving:</font> <font color="#666666">'.$last_giving.'</font><br />
                        <font color="#999999">Member Since:</font> <font color="#666666">'.$member_since.'</font><br />';

        $certified_sql = 'SELECT value FROM company_profile_values cpv WHERE fid = 207 AND cid ='.$data->cid;
        $certified_result = db_query($certified_sql);
        $certified = db_result($certified_result);
        if($certified == 1) {
            $html .= '<a href="" style="color:#11A1F4"
                      title="\'Certified Giver\' status is given to BusinessesThatGive Members who have been giving regularly long-term through B1G1 Giving"
                                                                onClick="return false">
                     <img src="http://'.$_SERVER["SERVER_NAME"].'/buy1give1/sites/default/files/company/icon/BusinessesThatGive_ProfileImage.png" />
                      </a>';
        }
        $html .='   </td>
                  </tr>';


        $html .= '</table>';

        /*
         *  Company Html
        */

        $org .= '<table width="700px" class="listing"><tbody valign="top">';


        $org .= '<tr><td width="150px" valign="top" >
            <table class="listing">';
        $pic_url = $data->c_primary_pic;
        $pic_url2 = $data->c_secondary_pic;

        $sql3 = "SELECT value FROM company_profile_values WHERE fid = 75 AND cid=".$data->cid;
        $result3 = db_query($sql3);
        $pic_url3 = db_result($result3);
        if($pic_url == 'N' || $pic_url == NULL || $pic_url == '') {
            $pic_url = 'default_image_BTG_profile.jpg';
        }
        if($pic_url2 == 'N' || $pic_url2 == NULL || $pic_url == '') {
            $pic_url2 = 'default_image_BTG_blank.jpg';
        }

        $org .= '<tr><td valign="top" style="padding-bottom:0.5ex">
                     <img src="http://'.$_SERVER["SERVER_NAME"].'/buy1give1/sites/default/files/company/'.$pic_url.'" class="resizeme1"  /></td></tr>';  //width="142" height="100"
        $org .= '<tr><td valign="top" style="padding-bottom:0.5ex">
                     <img src="http://'.$_SERVER["SERVER_NAME"].'/buy1give1/sites/default/files/company/'.$pic_url2.'"  class="resizeme1"/></td></tr>'; //width="142" height="100"
//        $org .= '<tr><td valign="top" style="padding-bottom:0.5ex">
//                     <img src="http://'.$_SERVER["SERVER_NAME"].'/buy1give1/sites/default/files/company/'.$pic_url3.'" width="142" height="100" /></td></tr>';

        $org .= '<tr><td></td></tr></table>';

        $org .= '</td><td width="550px" valign="top">';
        $org .= '<table width="100%" class="listing">
                 <tbody valign="bottom">';
        $c_about = $data->c_about;

        if($c_about == 'NULL') {
            $c_about = 'Please see our website or contact us for more information';
        }
        $org .= '<tr><td colspan="2" style="padding-top:0.5ex; border-bottom:1px solid #232323;"><font color="#666666" size="3.1em">'."About the company: ".$data->key_org_name.'</font></td></tr>';
        $org .= '<tr>';
        $country_sql = "SELECT DISTINCT iso, name FROM {company_profile_values} c, {profile_location_country} pc WHERE c.fid=51 AND c.value = iso";
        $country_result = db_query($country_sql);
        while ($iso = db_fetch_object($country_result)) {
            if($iso->iso == $data->c_country ) {
                $country = $iso->name;
            }
        }
        if ($data->c_phone == '' || $data->c_phone == 'N' || $data->c_phone == NULL) {
            $data->c_phone = 'N/A';
        }
        $org .= '   <td width="65%"><font color="#999999">Country: </font><font color="#666666">'.$country.'</font></td>
                    <td width="35%"><font color="#999999">Phone: </font><font color="#666666">'.$data->c_phone.' </font></td>
                 </tr>
                 <tr>';
        if($data->c_industry != '' && $data->c_industry != NULL) {
            $industry = $data->c_industry;
            if(is_numeric($industry[0])) {
                $industry = profile_location_get_industry($data->c_industry);
            }else {
                $industry = $data->c_industry;
            }
        }

        //find new industry
        $industry1 = db_result(db_query("select value from company_profile_values where cid = ".$data->cid." and fid = 307;"));
        $industry2 = db_result(db_query("select value from company_profile_values where cid = ".$data->cid." and fid = 309;"));

        //get the value of industry1
        $cat1 = db_result(db_query("select category_name from lg_individual_keyword_matching where category_id = ".$industry1."")) ;
        $cat2 = db_result(db_query("select category_name from lg_individual_keyword_matching where category_id = ".$industry2."" ));

       
        $org .= '   <td width="65%"><font color="#999999">Industry: </font><font color="#666666">'.$industry1.'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$industry2.'</font></td>';
        $org .= '<td width="35%" rowspan="2">';
        $facebook = $data->c_facebook;
        $twitter = $data->c_twitter;
        if ($twitter != NULL) {
            if ((strpos($twitter,'http://') !== false) || (strpos($twitter,'https://') !== false)) {
				$org .= '<a href="'.$twitter.'" target="_blank"><img width="35" height="35" alt="twitter" src="/buy1give1/images/twitter-icon.png" /></a>';
			}else {
				$org .= '<a href="http://'.$twitter.'" target="_blank"><img width="35" height="35" alt="twitter" src="/buy1give1/images/twitter-icon.png" /></a>';
			}
        }
        if ($facebook != NULL) {
			if ((strpos($facebook,'http://') !== false) || (strpos($facebook,'https://') !== false)) {
				$org .= '<a href="'.$facebook.'" target="_blank"><img width="35" height="35" alt="facebook" src="/buy1give1/images/facebook-icon.png" /></a>';
			}else{
            	$org .= '<a href="http://'.$facebook.'" target="_blank"><img width="35" height="35" alt="facebook" src="/buy1give1/images/facebook-icon.png" /></a>';
			}
        }
		if($data->c_email){
        $org .=' <a href="javascript:void(0);" id="emailMe"><img width="35" height="35" alt="email" src="/buy1give1/images/email-icon.png" alt="email" /></a>';
		}
                   
        $org .= '</td></tr>
                 
                 <td width="65%"><font color="#999999">Website: </font><a href="http://'.$data->c_website.'"  target="_blank">
				 '.$data->c_website.'</a></td>
                 </tr>
                 <tr>
                 <td colspan="2">'.$c_about.'</td>
                 </tr>
                 <tr>
                 <td colspan="2">&nbsp;</td>
                 </tr>
                 </tbody></table></td></tr></table>';
        $org .= '<table class="listing">';
        $org .= '<tr>';
        $org .= '<td valign="top">';
        $org .= '<table>';
        $org .= '<tr><td valign="top" align="center" style="border:0px solid #DED3B0;">' . $picture_string['pic3'] . '</td></tr>';
        $org .= '<tr><td valign="top" align="center" style="border:0px solid #DED3B0;">' . $picture_strings['pic1'] . '</td></tr>';
        $org .= '<tr><td valign="top" align="center" style="border:0px solid #DED3B0;">' . $picture_strings['pic2'] . '</td></tr>';
        $org .= '<tr height="330px"><td valign="bottom"><img width="140" height="110" alt="leverage" src="/buy1give1/images/leverage_mini.png" /></td></tr>';
        $org .= '</table>';
        $org .='</td>';
        $org .= '<td width="550px" >' . $dgilgi_temp['html_display'] . '</td>';
        $org .= '</tr>';
        $org .= '</table>';
		
		if($data->c_email){
		$org .='<div id="thankyougiving" style="display:none;"> <a href="javascript:void(0);"><img width="63" height="20" style="left: 310px;position: relative;" id="close_thankyougiving" class="close" src="https://www.b1g1.com/givinglife/images/close.jpg"></a>
  <div class="thanku-left" style="padding-top:10px;width: auto;">
   <div style="font-size:21px;" align="center">Send a message</div>
  </div>
  <div class="cata-box_thanks" style="position:inherit; background:none;border: 0 none;">
         <div class="cata-detail">'.drupal_get_form(contactFrm_form).'
         </div>
    </div>   
</div>';
		$org .= '<script>
$(document).ready(function(){
	$("#switch_edit-message").hide();
	 $("#thankyougiving").dialog({
					modal: true,
					autoOpen: false,
					closeText: "close me",
					resizable: false,
					width: 550,	
					height: 425,				
				});	
							
				$("#emailMe").click(function(){					
					$("#thankyougiving").dialog("open");					
				});
				$("#close_thankyougiving").click(function(){					
					$("#thankyougiving").dialog("close");					
				});
				
	
});
		</script>';
		}
    }

    $org .= "</tbody></table><br />";
    return $html.$org;
}

?>