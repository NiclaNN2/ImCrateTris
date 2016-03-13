<?php
session_start();


include('vue/header.php');

include('vue/menu.php');
						
?>
<div id="conteneur">

    <div class="element">
    <?php
	include('vue/graph/graph_branche1.php');
	?>
    </div>

    <div class="element">
    <?php
	include('vue/graph/graph_branche2.php');
	?>
    </div>

    <div class="element">
    <?php
	include('vue/graph/graph_branche3.php');
	?>
	</div>

</div>

<?php
include('vue/footer.php');
