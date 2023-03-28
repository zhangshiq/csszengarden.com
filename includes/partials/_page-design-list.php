<ul class="design-list">
<?php

		// check for language URL
		global $langURL;

		// get total number of designs available
		$totalDesignCount = count($designList);

		// check if "pg" URL parameter is set
		if ( isset($_GET["pg"])) {

			// if querystring page count is something other than the first page,
			// display that list instead
			if (($_GET['pg']) > 1) {

				// The `pg` variable is 1-indexed for human-friendly page counts,
				// need to subtract 1 to reset to zero index. Also subtracting 1
				// from the total count to start the next page after the design the
				// previous page left off with
				$listStart = $totalDesignCount - ($_GET['pg'] - 1) * $numDesigns - 1;
			} else {
				$listStart = $totalDesignCount - 1;
			}
		}
	
		// begin at the already-established start of the list and loop down
		for ($i = $listStart; $i > ($listStart - $numDesigns); $i--) {

			// stop when we've hit the end
			if ($i >= 0) {

				$designId = $designList[$i][0];
				$designURL = $langURL . "/$designId/"; // prepend for translation pages
				$designName = hsc($designList[$i][1]);
				$designerName = hsc($designList[$i][2]);
				$designerURL = hsc($designList[$i][3]);

?>
	<li>
		<a href="<?php echo $designURL; ?>" class="design-preview">
			<img src="/content/previews/<?php echo $designId; ?>.png" alt="<?php echo $designName; ?> preview">
		</a>
		<div class="design-credits">
			<h3><?php echo $designName; ?></h3>
			by <?php
				if(($designerURL != "") && ($designerURL != "#")) {
					?><a href="<?php echo $designerURL; ?>"><?php echo $designerName; ?></a><?php
				} else {
					echo $designerName;
			}?>
		</div>
	</li>
<?php

			}
		}

?>
</ul>
