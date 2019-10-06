<?php
	include_once('wp-config.php');

	global $wpdb;

	$query = "SELECT * FROM wp_posts WHERE post_type = 'product'";

	$results = $wpdb->get_results($query);

	foreach ($results as $res) {
		$post_id = $res->ID;
		$post_content = $res->post_content;

		// // Last Part Number
		// $a = explode("Part-Number List:", $post_content);

		// $b = explode("| Comparison-Number List:", $a[1]);

		// $c = explode("|", $b[0]);

		// $part_number = $c[sizeof($c)-1];

		// // Engine Type
		// $d = explode("Engine Type:", $post_content);

		// $e = explode("|", $d[1]);

		// $engine_type = $e[0];

		// // Engine Power

		// $f = explode("Engine Power(BHP):", $post_content);

		// $g = explode("|", $f[1]);

		// $engine_power = $g[0];

		// Extra Make
		$d = explode("Extra Make:", $post_content);

		$e = explode("|", $d[1]);

		$extra_work = $e[0];

		$query3 = "UPDATE wp_products SET `pa_extra_work` = '$extra_work' WHERE product_id = '$post_id'";

		$result3 = $wpdb->query($query3);

		// print_r($part_number. " ### " . $engine_type . " ### " . $engine_power);
		
		print_r($extra_work);
		print_r("<br/>");

		if($result3) {
			echo "Product Updated!";
			print_r("<br/>");
			print_r("<br/>");
		}
	}
?>