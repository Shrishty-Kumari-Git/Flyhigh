<?php 
foreach ($formatted_search_result_data as $formatted_search_result_data_key => $formatted_search_result) {
	$this->template->load_isolated_view('flight/search_result_card', $formatted_search_result);
}
?>
