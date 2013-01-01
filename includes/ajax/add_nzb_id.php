<?php
/* Add nzb id to download queue */
$nh = new nzb_helper($smarty);

echo $nh->add_nzb_id($_REQUEST['base_url'],$_REQUEST['nzbid']);
?>