<?php
/**
 * The Sidebar containing the menu widget area.
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
?>

<?php
    dynamic_sidebar('sidebar-menu');
?>

<div id="sticky-widgets">
    <!-- Static widgets -->
    <div class="widget order-online">

        <h3>Place an order online</h3>

        <div class="btn-wrapper">
            <?php $toGoUrl = 'https://order.lamadeleine.com'; ?>
            <?php if ( !empty($_COOKIE['LAM-location']) ) {
                $curLocation = json_decode( stripslashes( $_COOKIE['LAM-location']) );

                if ( in_array($curLocation->title, $GLOBALS['toGoLocations']) ) {
                    $toGoUrl = "https://order.lamadeleine.com/index.cfm?fuseaction=order&action=preorder&isToGo=1";
                }

            } ?>
            <a class="btn" target="_blank" href="<?php echo $toGoUrl; ?>">To Go</a>

            <a class="btn" target="_blank" href="https://order.lamadeleine.com/">Catering</a>
        </div>

    </div>

    <div class="widget menu-legend">
        <h3>LA L&Eacute;GENDE</h3>
        <div class="legend-wrapper">
            <div class="legend-item">
                <span class="icon icon-legend-signature"></span> La Madeleine Signature
            </div>
            <div class="legend-item">
                <span class="icon icon-legend-low-calorie"></span> Under 600 calories
            </div>
            <div class="legend-item">
                <span class="icon icon-legend-nuts"></span> Contains nuts
            </div>
            <div class="legend-item">
                <span class="icon icon-legend-alcohol"></span> Contains alcohol
            </div>
            <div class="legend-item">
                <span class="icon icon-legend-egg-whites"></span> Substitute egg whites free of charge
            </div>
            <div class="legend-item">
                <span class="icon icon-legend-gluten-free"></span> Gluten free
            </div>
        </div>
        <p class="disclaimer"><strong>* Please note:</strong> The consumption of raw or undercooked eggs may increase your risk of foodborne illness.</p>
        <p class="disclaimer">Some menu items may not be available at all locations.</p>
    </div>
</div>