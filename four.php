<?php
	include_once('wp-config.php');

	global $wpdb;

	$query = "SELECT * FROM wp_products";

	$results = $wpdb->get_results($query);

	foreach ($results as $res) {
		$post_id = $res->product_id;

		$category = $res->product_cat_name;
		$make = $res->product_name;
		$model = $res->p_model_name;
		$engine_capacity = $res->p_engine_capacity_name;
		$fuel_type = $res->p_fuel_name;
		$engine_type = $res->pa_engine_type_name;
		$engine_power = $res->pa_engine_power_name;
		$extra_make = $res->pa_extra_work;
		$last_part_number = $res->pa_part_number_last_item;

		$final_title = $category . " for";
		$final_title .= " " . $make;
		$final_title .= " " . $model;
		$final_title .= " " . $engine_capacity;
		$final_title .= " " . $fuel_type;
		$final_title .= " " . $engine_type;
		$final_title .= " " . $engine_power;
		$final_title .= " " . $extra_make;
		$final_title .= " " . $last_part_number;

		print_r($final_title);

		$query3 = "UPDATE wp_posts SET `post_title` = '$final_title' WHERE ID = '$post_id'";

		$result3 = $wpdb->query($query3);
		
		if($result3) {
			echo "Product Updated!";
			print_r("<br/>");
			print_r("<br/>");
		}
	}
?>