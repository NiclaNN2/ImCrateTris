<?php
session_start();

?>
<nav>        
    <div id="menu_footer">

            <div class="bouton_main">
            <p><a href="main.php">  <?php echo '</br>'; ?> </a></p>
            </div>
           	
           	<div class="bouton_graph">
            <p><a href="graph.php">  <?php echo '</br>'; ?> </a></p>
            </div>

            <div class="bouton_help">
            <p><a href="help.php">   <?php echo '</br>'; ?> </a></p>
            </div>


<?php
if($_SESSION['admin'])
    {
        
    ?>

    <div>
    <p><a href="feedbacks_recus.php">  feedbacks </a></p>
    </div>

    <?php    
    }?>


    </div>    
</nav>