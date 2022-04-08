<?php

require'config.php';

$id = $_GET['id'];

$fileName = 'upload/'.$id['file'];
if(file_exists($fileName)){

    if(!unlink($fileName)){

        echo 'Failed to delete file';
        exit;
        
    }
    
}
$database->pets->deleteOne(array('_id' => new mongoDb\BSON\ObjectId($id)));

header("Location:index.php");
?>