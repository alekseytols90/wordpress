<?php
	include_once('wp-config.php');

	global $wpdb;

	$query = "SELECT * FROM wp_posts WHERE post_type = 'product'";
	// $query = "SELECT * FROM wp_posts WHERE post_type = 'product' AND copy = 'no'";
	// $query = "SELECT * FROM wp_posts WHERE post_type = 'product' AND ID = 35527";

	$results = $wpdb->get_results($query);

	foreach ($results as $res) {
		$post_id = $res->ID;

		$query1 = "SELECT * FROM wp_term_relationships WHERE object_id = '$post_id'";

		$results1 = $wpdb->get_results($query1);

		if($results1) {
			$category = "";
			
			foreach ($results1 as $key) {
				$term_id = $key->term_taxonomy_id;

				if($term_id == 17930) {
					$category = "Turbo Charger";
				} else if($term_id == 37243) {
					$category = "Turbo Actuator";
				} else if($term_id == 37244) {
					$category = "Electronic Turbo Actuator";
				} else if($term_id == 37245) {
					$category = "Turbo Actuator Position Sensor";
				} else if($term_id == 37246) {
					$category = "Turbo Cleaner";
				} else if($term_id == 37247) {
					$category = "Turbo Vanes";
				}
			}

			print_r("Make : ".$post_id." ".$category);
			print_r("<br/>");



			$query3 = "UPDATE wp_products SET product_cat_name = '$category' WHERE product_id = '$post_id'";

			$result3 = $wpdb->query($query3);

			// print_r($result);

			if($result3) {
				echo "Product Updated!";
				print_r("<br/>");
				print_r("<br/>");
			}
		}
	}
?>