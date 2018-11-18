<div class="terms">
	<h3>Terme & Condition</h3>
    <p><?php
    
	$textArray = explode("</p>", $terms);

for ($i = 0; $i < sizeof($textArray); $i++) {
 echo   $textArray[$i] = strip_tags($textArray[$i]);
} ?></p>
</div>