<?php
session_start();


include('vue/header.php');

include('vue/menu.php');
						
?>

<div id="corps_graph">

	<div id="branche_graph">
	<?php
	include('vue/graph/graph_branche1.php');
	?>
	</div>

	<div id="branche_graph">
	<?php
	include('vue/graph/graph_branche2.php');
	?>
	</div>

	<div id="branche_graph">
	<?php
	include('vue/graph/graph_branche3.php');
	?>
	</div>

</div>

<?php


include('vue/footer_graph.php');
