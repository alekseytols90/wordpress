<?php
	include_once('wp-config.php');

	global $wpdb;

	// $query = "SELECT * FROM wp_posts WHERE post_type = 'product' AND ID = 35527 AND copy = 'no'";
	$query = "SELECT * FROM wp_posts WHERE post_type = 'product' AND copy = 'no'";
	// $query = "SELECT * FROM wp_posts WHERE post_type = 'product' AND ID = 35527";

	$results = $wpdb->get_results($query);

	foreach ($results as $res) {
		$post_id = $res->ID;
		$post_title = $res->post_title;
		$post_content = $res->post_content;

		$query1 = "SELECT * FROM wp_term_relationships WHERE object_id = '$post_id'";

		$results1 = $wpdb->get_results($query1);

		if($results1) {
			print_r($post_id);
			print_r("<br/>");
			print_r($post_title);
			print_r("<br/>");
			print_r($post_content);
			print_r("<br/>");
		
			$make = "";
			$make_slug = "";
			$model = "";
			$model_slug = "";
			$engine_capacity = "";
			$engine_capacity_slug = "";
			$year = "";
			$year_slug = "";
			$fuel = "";
			$fuel_slug = "";

			$num = 0;
			
			foreach ($results1 as $key) {
				$term_id = $key->term_taxonomy_id;

				$query21 = "SELECT * FROM wp_termmeta WHERE term_id = '$term_id'";

				$results21 = $wpdb->get_results($query21)[0];

				if($results21->meta_key == 'order_pa_make') {
					$query2 = "SELECT * FROM wp_terms WHERE term_id = '$term_id'";
					$results2 = $wpdb->get_results($query2)[0];

					$make = $results2->name;
					$make_slug = $results2->slug;
				} else if($results21->meta_key == 'order_pa_fuel') {
					$query2 = "SELECT * FROM wp_terms WHERE term_id = '$term_id'";
					$results2 = $wpdb->get_results($query2)[0];

					$fuel = $results2->name;
					$fuel_slug = $results2->slug;
				} else if($results21->meta_key == 'order_pa_car-year') {
					$query2 = "SELECT * FROM wp_terms WHERE term_id = '$term_id'";
					$results2 = $wpdb->get_results($query2)[0];

					$year = $results2->name;
					$year_slug = $results2->slug;
				} else if($results21->meta_key == 'order_pa_engine-capacity') {
					$query2 = "SELECT * FROM wp_terms WHERE term_id = '$term_id'";
					$results2 = $wpdb->get_results($query2)[0];

					$engine_capacity = $results2->name;
					$engine_capacity_slug = $results2->slug;
				} else if($results21->meta_key == 'order_pa_model') {
					$query2 = "SELECT * FROM wp_terms WHERE term_id = '$term_id'";
					$results2 = $wpdb->get_results($query2)[0];

					$model = $results2->name;
					$model_slug = $results2->slug;
				}

				$num++;
			}


			print_r("Make : ".$make." ".$make_slug);
			print_r("<br/>");

			print_r("Model : ".$model." ".$model_slug);
			print_r("<br/>");

			print_r("Engine : ".$engine_capacity." ".$engine_capacity_slug);
			print_r("<br/>");

			print_r("Year : ".$year." ".$year_slug);
			print_r("<br/>");

			print_r("Fuel : ".$fuel." ".$fuel_slug);
			print_r("<br/>");


			$query3 = "INSERT INTO wp_products (
												product_id,
												product_name,
												p_make,
												p_model_name,
												p_model,
												p_engine_capacity_name,
												p_engine_capacity,
												p_year_name,
												p_year,
												p_fuel_name,
												p_fuel
											  ) VALUES (
											  	'$post_id',
											  	'$make',
											  	'$make_slug',
											  	'$model',
											  	'$model_slug',
											  	'$engine_capacity',
											  	'$engine_capacity_slug',
											  	'$year',
											  	'$year_slug',
											  	'$fuel',
											  	'$fuel_slug'
											  )";

			$result3 = $wpdb->query($query3);

			// print_r($result);

			if($result3) {
				echo "Product Inserted!";

				$query4 = "UPDATE wp_posts SET copy = 'yes' WHERE ID = '$post_id'";

				$results4 = $wpdb->query($query4);

				if($results4) {
					echo "&nbsp;&nbsp;Posts Table Updated!<br/><br/><br/>";
				}
			}
		}
	}
?>