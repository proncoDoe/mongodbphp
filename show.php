<?php include 'header.php' ?>
<?php require 'config.php' ?>
<?php session_start(); ?>




<?php

$id = $_GET['id'];

//selecting data associated with this particular id
$result = $database->pets->findOne(array('_id' => new mongoDb\BSON\ObjectId($id)));

$animal_name = $result['animal_name'];
$color = $result['color'];
$fname = $result['fname'];
$lname = $result['lname'];
$email = $result['email'];
$description = $result['Description'];
$cover_img = $result['cover_image'];
$category = $result['category'];
$UTCDateTime =  new MongoDB\BSON\UTCDateTime((string)$result['created_at']);
$toDateTime =  $UTCDateTime->toDateTime()
?>



<div class="container">


    <div class="row justify-content-center">

        <div class="col-8">


            <div class="card my-5">

                <div class="card-header bg-success">

                    <div class="col-6">

                        <span> <?php echo "Owner: ".$fname?> <?php echo $lname?></span>


                    </div>
                    <div class="col-6 offset-11">

                        <i class="fas fa-info-circle"></i>

                    </div>

                </div>

                <div class="card-body">


                    <span>
                        <h3><?php echo "Animal name: ".$animal_name?>
                        </h3>
                    </span>
                    <hr>


                    <h4> <?php echo $description ?> </h4>

                    <hr>

                    <div>
                        <img src="upload/<?php echo $cover_img ?>" width="70px">
                    </div>

                </div>

                <div class="col-md-4 offset-10">

                    <a href="index.php" class="btn btn-outline-primary btn-lg">Back</a>

                </div>

                <div>

                    created at
                    <span><?php echo $toDateTime->format('d-m-Y h:i:s') ?></span>

                </div>
            </div>


        </div>



    </div>



</div>








<?php include 'footer.php' ?>