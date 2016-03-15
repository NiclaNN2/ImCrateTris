<?php
session_start();


include('vue/header.php');

include('vue/menu.php');
						
?>

<div id="corps_graph">

	<div id="branche_graph">
	<?php
	$adresse_one_1 = 'modele/gallerie_thumbnails_graph/photo_56e745c0cd1ac.JPG';
	?>
	<div id="photo_graph">
		<figure>
    			<img src=<?php echo $adresse_one_1 ?> alt="Pantheon" />
		</figure>
	</div>

	<?php
	$branche = 1;
	include('vue/graph/graph_branche.php');
	?>
	</div>




	<div id="branche_graph">
	<?php
	$adresse_one_2 = 'modele/gallerie_thumbnails_graph/photo_56e73fc01a974.JPG';
	?>
	<div id="photo_graph">
		<figure>
    			<img src=<?php echo $adresse_one_2 ?> alt="Pantheon" />
		</figure>
	</div>
	<?php
	$branche = 2;
	include('vue/graph/graph_branche.php');
	?>
	</div>




	<div id="branche_graph">
	<?php
	$adresse_one_3 = 'modele/gallerie_thumbnails_graph/photo_56e74ac1aa2bb.JPG';
	?>
	<div id="photo_graph">
		<figure>
    			<img src=<?php echo $adresse_one_3 ?> alt="Pantheon" />
		</figure>
	</div>
	<?php
	$branche = 3;
	include('vue/graph/graph_branche.php');
	?>
	</div>

</div>

<?php


include('vue/footer_graph.php');
