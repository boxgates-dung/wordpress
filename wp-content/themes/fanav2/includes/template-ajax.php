<?php
add_action('wp_ajax_latoya_product_search', 'latoya_product_search');
add_action('wp_ajax_nopriv_latoya_product_search', 'latoya_product_search');
function latoya_product_search()
{
  //do bên js để dạng json nên giá trị trả về dùng phải encode
  // $website = (isset($_POST['website'])) ? esc_attr($_POST['website']) : '';

  // $result = array(
  //   array(
  //     'permalink_link' => 'sdsd',
  //     'thumbnail' => 'sdsd',
  //     'title' => 'sdsd',
  //     'price' => 'sdsd',
  //   ),
  //   array(

  //   ),
  //   array(

  //   )
  // );

  // wp_send_json_success($result);
  // die(); //bắt buộc phải có khi kết thúc


  $products = wc_get_products([
		'page' => 1
	]);
	$results = [];
	if( $products ){
		foreach ($products as $product){
			$results[] = [
				'title' => $product->get_title(),
				'photo' => get_the_post_thumbnail_url($product->id),
				'price' => $product->get_price_html(),
				'permalink' => get_permalink($product->id)
			];
		}
	}
	echo json_encode([
		"results" => $results
	]);
	die();
}


