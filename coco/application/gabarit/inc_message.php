<?php
if (isset($_SESSION["message"]) and count($_SESSION["message"])>0 ) {
    foreach($_SESSION["message"] as $message) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?=$message?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } 
    $_SESSION["message"]=[];
}
?>