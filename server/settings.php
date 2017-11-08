<?php

	$base_url = "http://localhost:8080/server";
	$page_title = "ADMIN";
	date_default_timezone_set("Australia/Sydney");
	$db = "db";
	$username = "root";
	$password = "hidden1234";
	$dbname = "MyDB";
	
	$table_name = "Entry";

	//gallery items per page
	$per_page = 12;

	function paginate($reload, $page, $tpages) {
		$adjacents = 2;
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<div class="pagination"><ul>';
		// previous
		if ($page == 1) {
			$out.= "<span>".$prevlabel."</span>\n";
		} elseif ($page == 2) {
			$out.="<li><a href=\"".$reload."\">".$prevlabel."</a>\n</li>";
		} else {
			$out.="<li><a href=\"".$reload."&amp;page=".($page - 1)."\">".$prevlabel."</a>\n</li>";
		}
		$pmin=($page>$adjacents)?($page - $adjacents):1;
		$pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
		for ($i = $pmin; $i <= $pmax; $i++) {
			if ($i == $page) {
				$out.= "<li class=\"active\"><a href=''>".$i."</a></li>\n";
			} elseif ($i == 1) {
				$out.= "<li><a href=\"".$reload."\">".$i."</a>\n</li>";
			} else {
				$out.= "<li><a href=\"".$reload. "&amp;page=".$i."\">".$i. "</a>\n</li>";
			}
		}
		
		if ($page<($tpages - $adjacents)) {
			$out.= "<a href=\"" . $reload."&amp;page=".$tpages."\">" .$tpages."</a>\n";
		}
		// next
		if ($page < $tpages) {
			$out.= "<li><a href=\"".$reload."&amp;page=".($page + 1)."\">".$nextlabel."</a>\n</li>";
		} else {
			$out.= "<span>".$nextlabel."</span>\n";
		}
		$out.= "</ul></div>";
		return $out;
	}
?>