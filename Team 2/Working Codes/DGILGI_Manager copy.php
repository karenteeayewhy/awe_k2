<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/ 
/**
 * Description of DataTree
 *
 * @author Xuanyi Chen
 */
class DGILGI_Manager {

    var $support_giving_arr;
    var $last_giving_act_date;
    var $num_of_companies_invited;
    var $dgi;
    var $lgi;
    var $lgi_tree;
    var $dgi_summary_arr;
    var $lgi_summary_arr;
    var $dgi_growth_arr;
    var $lgi_growth_arr;
    var $dgi_monthly_avg_arr;
    var $lgi_monthly_avg_arr;
    var $dgi_growth_rate_arr;
    var $lgi_growth_rate_arr;

    var $level;
    var $lgi_tree2;
    function DGILGI_Manager($uid) {
        $this->level = 1;
        $this->lgi_tree2 = array();
        $this->lgi_tree = array();
        $this->support_giving_arr = array();
        $this->dgi_summary_arr = array();
        $this->lgi_summary_arr = array();
        $this->dgi_growth_arr = array();
        $this->lgi_growth_arr = array();
        $this->dgi_monthly_avg_arr = array();
        $this->lgi_monthly_avg_arr = array();
        $this->dgi_growth_rate_arr = array();
        $this->lgi_growth_rate_arr = array();	//die('am here');
        $this->populate_tree($uid);
	
		$this->populate_supported_causes($uid);
        $this->populate_last_giving_act($uid);
        $this->calculate_DGI($uid);
        $this->calculate_LGI();
        $this->populate_num_of_companies_invited($uid);
		//$this->get_total_num_of_companies_string($uid,0);	
        $this->populate_DGI_summary($uid);
        $this->populate_LGI_summary();
        $this->populate_DGI_growth($uid);
        uasort($this->dgi_summary_arr, array($this, "sort_lgi_summary_arr"));
        $this->populate_LGI_growth();
        $this->populate_DGI_growth_rate();
        $this->populate_LGI_growth_rate();
       // print_debug($this, true);
    }

    function populate_supported_causes($uid) {
        $sql = "SELECT p.proj_org_name, p.projID, p.pic1url FROM project p " .
                "INNER JOIN contribution c ON p.projID=c.project_ID " .
                "WHERE c.contributer_ID='".$uid."' AND contribution_status <> 'unsuccessful' AND contribution_status <> 'unconfirmed' AND contribution_status <> 'cancelled'  " .
                "GROUP BY p.proj_org_name " .
                "ORDER BY c.contributionID DESC";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_object($result)) {
            $this->support_giving_arr[$row->projID] = array();
            $this->support_giving_arr[$row->projID]['name'] = $row->proj_org_name;
            $this->support_giving_arr[$row->projID]['pic'] = $row->pic1url;
        }
    }

    function populate_last_giving_act($uid) {
        $sql = "SELECT p.project_phrase_active, c.noofbeneficiaries as amt, " .
                "DATE_FORMAT(FROM_UNIXTIME(c.contribution_paid_tob1g1), '%D %M %Y') AS last_giving_date " .
                "FROM project p " .
                "INNER JOIN contribution c ON p.projID=c.project_ID " .
                "WHERE c.contributer_ID='".$uid."' AND contribution_status <> 'unsuccessful' AND contribution_status <> 'unconfirmed' AND contribution_status <> 'cancelled' " .
                "ORDER BY c.contributionID DESC " .
                "LIMIT 1";
        $result = mysql_query($sql);
        $this->last_giving_act_date = mysql_fetch_array($result);
    }

    function populate_num_of_companies_invited($uid) {
        $sql = "SELECT COUNT(*) FROM invite_relations i WHERE i.uid='".$uid."'";
        $result = mysql_query($sql);
		$resultRow = mysql_fetch_row($result);
        $this->num_of_companies_invited = $resultRow[0];
    }

    function populate_tree($uid) {
        $this->level++;
        $result = mysql_query("SELECT * FROM invite_relations WHERE uid='".$uid."'");
        while ($row = mysql_fetch_object($result)) {
			
            if(empty($this->lgi_tree[$row->uid])) {
                $this->lgi_tree[$row->uid] = array($row->invitee);
                $this->lgi_tree2[$row->uid] = array();
                array_push($this->lgi_tree2[$row->uid], array('invitee' => $row->invitee, 'level' => $this->level));				
            } else {
                array_push($this->lgi_tree[$row->uid], $row->invitee);
                array_push($this->lgi_tree2[$row->uid], array('invitee' => $row->invitee, 'level' => $this->level));
            }
            if($uid != $row->invitee){
			  $this->populate_tree($row->invitee);
			}
        }
        $this->level--;
    }

    function get_calculate_DGI($uid) {
        $result = mysql_query("SELECT sum(c.noofbeneficiaries) FROM contribution c WHERE contribution_status <> 'unsuccessful' AND contribution_status <> 'unconfirmed' AND contribution_status <> 'cancelled' AND contributer_id='".$uid."'");
		$resultRow = mysql_fetch_row($result);
        return $resultRow[0];//db_result($result);
    }

    function calculate_DGI($uid) {
        //print_debug($this->data_tree, true);
        $this->dgi = $this->get_calculate_DGI($uid);
    }

    function calculate_LGI() {
        array_walk_recursive($this->lgi_tree, array($this, "add_to_LGI"));
    }

    function populate_DGI_summary($uid) {
        $this->populate_summary($uid, $this->dgi_summary_arr);
    }

    function populate_summary($uid, &$dst) {
        $sql = "SELECT p.impact_category, SUM(c.noofbeneficiaries) as amt, " .
                "p.project_phrase_active " .
                "FROM project p " .
                "INNER JOIN contribution c ON p.projID=c.project_ID " .
                "WHERE c.contributer_ID='".$uid."' AND contribution_status <> 'unsuccessful' AND contribution_status <> 'unconfirmed' AND contribution_status <> 'cancelled' " .
                "GROUP BY p.impact_category";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_object($result)) {
            if(empty($dst[$row->impact_category])) {
                $dst[$row->impact_category] =
                        array('impact_category' => $row->impact_category,'amt' => $row->amt, 'phrase' => $row->project_phrase_active);
            } else {
                //Add up the amt instead of creating a new array for each record
                $dst[$row->impact_category]['amt'] += $row->amt;

                //create a new array under the same impact_category
                //array_push($dst[$row->impact_category], array($row->amt, $row->project_phrase_active));
            }
        }
        ksort($dst, SORT_NUMERIC);
    }

    function populate_LGI_summary() {
        array_walk_recursive($this->lgi_tree, array($this, "add_to_LGI_summary"));
        uasort($this->lgi_summary_arr, array($this, "sort_lgi_summary_arr"));
    }

    function populate_DGI_growth($uid) {
        $this->populate_growth($uid, $this->dgi_growth_arr);
    }

    function populate_growth($uid, &$dst) {
        $sql = "SELECT " .
                "p.impact_category, SUM(c.noofbeneficiaries) AS amt, " .
                "DATE_FORMAT(FROM_UNIXTIME(c.contribution_paid_tob1g1), '%Y.%m') AS mth " .
                "FROM project p " .
                "INNER JOIN contribution c ON p.projID=c.project_ID " .
                "WHERE c.contributer_ID='".$uid."' AND contribution_status <> 'unsuccessful' AND contribution_status <> 'unconfirmed' AND contribution_status <> 'cancelled' " .
                "GROUP BY mth, p.impact_category " .
                "ORDER BY c.contributer_ID, p.impact_category, mth ASC";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_object($result)) {
            $dst[$row->impact_category][$row->mth] = $row->amt;
            ksort($dst[$row->impact_category], SORT_NUMERIC);
        }		
    }

    function populate_LGI_growth() {
        array_walk_recursive($this->lgi_tree, array($this, "add_to_LGI_growth"));
    }

    function populate_growth_rate($src, &$dst, &$dst2) {		
        foreach($src as $key => $impact_cat) {
            $no_of_periods = ($this->get_num_of_periods($impact_cat) > 0) ? $this->get_num_of_periods($impact_cat) : 1;

            $latest = array_sum($impact_cat);

            if($no_of_periods > 1)
                array_pop($impact_cat);

            $no_of_periods_prev = ($this->get_num_of_periods($impact_cat) > 0) ? $this->get_num_of_periods($impact_cat) : 1;
            $previous = array_sum($impact_cat);

            //calculate latest avg
            $latest_avg = $latest / $no_of_periods;
            $dst2[$key] = round($latest_avg, 2);
			//calculate previous avg
            $previous_avg = $previous / $no_of_periods_prev;

            //calculate rate of growth
            $rate_of_growth = ($previous_avg > 0) ? $latest_avg / $previous_avg * 100 : 1;
            $actual_value = ($no_of_periods == 1) ? 100 : ($rate_of_growth - 100);
            $dst[$key] = ($actual_value > 0) ? '> ' . round($actual_value, 2) . '%' : '> -';
        }
			
        ksort($dst, SORT_NUMERIC);
    }

    function populate_DGI_growth_rate() {
		
       $this->populate_growth_rate($this->dgi_growth_arr, $this->dgi_growth_rate_arr, $this->dgi_monthly_avg_arr);
	   
    }

    function populate_LGI_growth_rate() {
        $this->populate_growth_rate($this->lgi_growth_arr, $this->lgi_growth_rate_arr, $this->lgi_monthly_avg_arr);
    }

    function add_to_LGI($value, $key) {
        $this->lgi += $this->get_calculate_DGI($value);
    }

    function add_to_LGI_summary($value, $key) {
        $this->populate_summary($value, $this->lgi_summary_arr);
    }

    function add_to_LGI_growth($value, $key) {
        $this->populate_growth($value, $this->lgi_growth_arr);
    }

    function sort_lgi_summary_arr($a, $b) {
        if ($a['amt'] == $b['amt']) return 0;
        return ($a['amt'] > $b['amt']) ? -1 : 1;
    }

    function get_num_of_periods($arr) {
        $periods = array_keys($arr);
        $last_date = end($periods);
        $exploded_last_date = explode('.', $last_date);
        $unix_last_date = mktime(0, 0, 0, $exploded_last_date[1], 1, $exploded_last_date[0]);

        $first_date = reset($periods);
        $exploded_first_date = explode('.', $first_date);
        $unix_first_date = mktime(0, 0, 0, $exploded_first_date[1], 1, $exploded_first_date[0]);

        $month_diff = round(abs($unix_last_date - $unix_first_date) / 2592000, 0 );
        return ($month_diff > 1) ? $month_diff : 1;
    }

    function get_supported_giving_string($is_show_all = FALSE) {
        $count = 2;
        $string = '';
        $i = 0;

        if($is_show_all) {
            $count = count($this->support_giving_arr);
        }

        foreach($this->support_giving_arr as $row) {
            $i++;
            $string .= (($i > 1) ? ', ' : '') . $row['name'];
            if($i >= $count)
                break;
        }
        return $string;
    }

    function get_lgi_or_dgi_summary_string($summary_arr, $rate_arr, $avg_arr, $is_show_all = FALSE) {
        $count = 2;
        $string = '';
        $i = 0;
        //$arrow_pic = '&nbsp;<img src="http://'.$_SERVER["SERVER_NAME"].'/buy1give1/images/arrow_up.png"/>';

        if($is_show_all) {
            $count = count($summary_arr);
        }
        foreach($summary_arr as  $key => $row) {
            $i++;
            $verb_temp = strchr($row['phrase'],'trees');
            $verb = (!empty($verb_temp) && $row['impact_category'] =='60') ? 'Planted' :  'Gave';
            $temp = strchr($rate_arr[$key],'-');
            $string .= '<tr>';
            $string .= '<td><img hspace="0" height="55" alt="" src="/buy1give1/sites/all/modules/custom/impactblock/images/impact_icons/'.$row['impact_category'].'.jpg" /></td>';
            $string .= '<td><li class="leaf">' . (!empty($row['amt']) ? $verb . ' <span style="color:#E5933D;font-weight:bold;">' . number_format($row['amt']) . '</span> ' . $row['phrase'] : '-') . '</li></td>';
            //$string .= '<td>' . $rate_arr[$key] . ((empty($temp)) ? $arrow_pic : '') . '</td>' ;
            $string .= '<td><span style="color:#E5933D;font-weight:bold;">' . number_format($avg_arr[$key]) . '</span></td>' ;
            $string .= '</tr>';
            if($i > $count)
                break;
        }
        return array('isEmpty' => empty($string), 'toString' => (!empty($string))? $string : ('<tr><td style="color:#999999;" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There is currently no Leveraged giving.</td></tr>')) ;
    }

    function get_last_activity_string() {
        return (!empty($this->last_giving_act_date['amt']) ? 'Gave ' . number_format($this->last_giving_act_date['amt']) . ' ' . $this->last_giving_act_date['project_phrase_active'] : '-');
    }

    function get_last_activity_date_string() {
        $temp = $this->last_giving_act_date['last_giving_date'];
        return (!empty($temp) ? $temp : '-');
    }

    function get_supported_causes_string($is_show_all = FALSE) {
        $temp = $this->get_supported_giving_string($is_show_all);
        return (!empty($temp) ? $temp : '-');
    }

    function get_dgi_string() {
        $temp = $this->dgi;
        return (!empty($temp) ? number_format($temp) : '-');
    }

    function get_lgi_string() {
        $temp = $this->lgi;
        return (!empty($temp) ? $temp : '-');
    }

    function get_num_of_companies_string() {
        $temp = $this->num_of_companies_invited;
        return (!empty($temp) ? number_format($temp) : '-');
    }
	
}
