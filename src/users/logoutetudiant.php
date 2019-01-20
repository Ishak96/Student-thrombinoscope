<?php
setcookie("nom", '', time() - 3600);
setcookie("prenom", '', time() - 3600);
setcookie("destination", '', time() - 3600);
setcookie("poste", '', time()-3600);
setcookie("numero", '', time()-3600);
header ('location: ../index.html');
sleep(2);
?>
