<?php
	include_once('wp-config.php');

	global $wpdb;

	$query = "SELECT * FROM wp_products WHERE `copy` = 0 ";

	$results = $wpdb->get_results($query);

	// print_r("expression");

	foreach ($results as $res) {
		$product_id = $res->product_id;
		$year_list=[];

		$year = $res->p_year;

		if(strtolower($year) == 'n/a' OR strtolower($year) == 'n-a'){
			$year_list[]= 'N/A' ;
		}
		else{

			preg_match_all('!\d+!', $year, $matches); // Get Number from string

			// print_r(count($matches[0]));
			// print_r("<br/>");

			if(count($matches[0])<2){

				$year_list[] = $matches[0][0];
			
			}else{

				for($i = $matches[0][0]; $i <= $matches[0][1]; $i++){

					$year_list[]=$i;
								
				}
			}

		}

		// print_r($year_list);
		// print_r("<br/>");

		$final_year_list = serialize($year_list);

		// print_r($year_list);
		// print_r("<br/>");

		$query3 = "UPDATE wp_products SET `p_year_list` = '$final_year_list' , `copy` = 1  WHERE `product_id` = '$product_id' ";

		$result3 = $wpdb->query($query3);

		if($result3) {
			echo "Product Updated!";
			print_r("<br/>");
			print_r("<br/>");
		}else{

			echo 'Error: ' . $wpdb->last_error;
		}
	}
?>