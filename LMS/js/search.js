/* Search JS File */

// Start Ready
$(document).ready(function() {
	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#search').val();
        var rank = $(".currentrank b").eq(0).html();
		$('b#search-string').html(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "http://severtsonscreens.com/cse360/LMS/book_search.php",
				data: { query: query_value, rank: rank },
				cache: false,
				success: function(html){
					$("table#results").html(html);
				}
			});
		}return false;
	}

	$("input#search").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("table#results").fadeOut();
			$('h4#results-text').fadeOut();
		}
        else {
			$("table#results").fadeIn();
			$('h4#results-text').fadeIn();
			$(this).data('timer', setTimeout(search, 500));
		}
	});

});