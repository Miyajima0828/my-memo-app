	<form action="#">
		<div class="test"><textarea id="target" ></textarea></div>
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>
		$(function() {
			$('textarea#target').on('input', function() {
				var lines = $(this).val().match(/\n/g).length;
				$(this).css('min-height', lines + 1 + 'em');
			})
		})
	</script>
