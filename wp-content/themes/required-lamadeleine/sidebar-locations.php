<?php
/**
 * The Sidebar containing the locations widget area.
 */
?>

<div class="zip-wrapper">
	<input id="zip-input-secondary" maxlength="5" placeholder='Enter Zip Code'> <a id="use-zip-secondary" class="btn" href="#">Go</a>
</div>

<?php
    dynamic_sidebar('sidebar-location');
?>