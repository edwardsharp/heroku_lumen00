<?php
    require('vendor/autoload.php');
 

    $from = $_REQUEST['From'];
 
    // now greet the sender
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message>HELLO <?php echo $from ?>! CURRENTLY IN TESTING MODE, CHECK BACK SOON!</Message>
</Response>
