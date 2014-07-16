<?php
/**
 * The Sidebar containing the locations widget area.
 */
?>

<div class="secondary-wrapper">
	<div class="zip-wrapper">
		<input id="zip-input-secondary" maxlength="5" placeholder='Enter Zip Code'> <a id="use-zip-secondary" class="btn" href="#">Go</a>
	</div>

	<a href="#" class="btn locate">
		<div class="text">
			<span class="icon-pin"></span> Refresh Your Location
		</div>
		<div class="loading">
        <div class="floatingCirclesG">
            <div class="f_circleG frotateG_01"></div>
            <div class="f_circleG frotateG_02"></div>
            <div class="f_circleG frotateG_03"></div>
            <div class="f_circleG frotateG_04"></div>
            <div class="f_circleG frotateG_05"></div>
            <div class="f_circleG frotateG_06"></div>
            <div class="f_circleG frotateG_07"></div>
            <div class="f_circleG frotateG_08"></div>
        </div>
    </div>
	</a>
</div>

<?php
    dynamic_sidebar('sidebar-location');
?>