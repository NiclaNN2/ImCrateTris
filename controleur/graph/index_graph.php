<?php
session_start();


include('vue/header.php');

include('vue/menu.php');
						
?>

<div id="corps_graph">

	<div id="branche_graph">
	<?php
	$adresse_one_1 = 'photos_thumbnails_graph/photo_56f3611f084ee.JPG';
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
	$adresse_one_2 = 'photos_thumbnails_graph/photo_56f361543b913.JPG';
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
	$adresse_one_3 = 'photos_thumbnails_graph/photo_56f361260cd1d.JPG';
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


include('vue/footer.php');
