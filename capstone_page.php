<?php
include "includes/db.php";

include "includes/header.php";

include "includes/navigation.php";

?>

<?php
include "web_gl_build/capstone.html";
?>
     
    <div style="margin: 700px 150px 150px; font-family: 'Helvetica'; font-size: 24px;">
        <p>This particle simulator is an extension of the testing environment used in my capstone project, which was about optimizing collision detection. I added the GUI controls for this demo. There is a zipped file of the full <a href="https://github.com/how1/capstone_unity_proj" target="_blank">Unity project</a> on my github, as well as another repository for just the <a href="https://github.com/how1/broad_phase_benchmark" target="_blank">code</a>. You can also read the <a href="Owen.Henry.pdf" target="_blank">paper</a> I wrote.</p>
        <p>
        	Directions: 
        </p>
        <p>
        	1. The Algorithm Selector chooses which collision detction algorithm is used. The default algorithm is currently 'Simple', be sure to try out one of the others. Sweep and Prune is the best performer in most cases and is the most robust.
        </p>
        	<p>	
        		2. Try messing with the configurations and notice when performance becomes unsatisfactory.

        </p>
        </div>
       
<div style="margin: 60px 60px 60px 60px">
 <hr>
<?php include "includes/footer.php";?>
</div>
