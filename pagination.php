<?php
/*--------------------------------------------------------------------------------------------
|    @desc:         pagination 
|    @author:       Aravind Buddha
|    @url:          http://www.techumber.com
|    @date:         12 August 2012
|    @email         aravind@techumber.com
|    @license:      Free!, to Share,copy, distribute and transmit , 
|                   but i'll be glad if i my name listed in the credits'
---------------------------------------------------------------------------------------------*/
function paginate($reload, $page, $tpages) {
    $adjacents = 2;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<li class='disabled'><a style=\"cursor:not-allowed;\">" . $prevlabel . "</a></li>";
    } elseif ($page == 2) {
        $out.= "<li><a  href=\"" . $reload . "\">" . $prevlabel . "</a></li>";
    } else {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page - 1) . "\">" . $prevlabel . "</a></li>";
    }
  
    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li class='active'><a href='' class=\"active\">" . $i . "</a></li>";
        } elseif ($i == 1) {
            $out.= "<li><a  href=\"" . $reload . "\">" . $i . "</a></li>";
        } else {
            $out.= "<li><a  href=\"" . $reload . "&amp;page=" . $i . "\">" . $i . "</a></li>";
        }
    }
    
    if ($page < ($tpages - $adjacents)) {
        $out.= "<li><a style='font-size:11px' href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $tpages . "</a></li>";
    }
    // next
    if ($page < $tpages) {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page + 1) . "\">" . $nextlabel . "</a></li>";
    } else {
        $out.= "<li><a style=\"cursor:not-allowed;\">" . $nextlabel . "</a></li>";
    }
    $out.= "";
    return $out;
}
