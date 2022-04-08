<?php include 'header.php' ?>
<?php require 'config.php' ?>
<?php session_start(); ?>

<?php



if(isset($_POST['update_data']))
{	
	$id = $_POST['id'];
	$pets = [
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'email' => $_POST['email'],
        'Description' => $_POST['Description'],
        'updated_at' => new MongoDB\BSON\UTCDateTime
    ];
	
	$errorMessage = '';
	foreach ($pets as $key => $value) {
		if (empty($value)) {
			$errorMessage .= $key . ' field is empty<br />';
		}
	}
			
	if ($errorMessage) {
		// print error message & link to the previous page
		
        header('location: edit.php');
	} else {
		
		$database->pets->updateOne(
						array('_id' => new mongoDb\BSON\ObjectId($id)),
						array('$set' => $pets)
					);
		
	
                    $_SESSION['update'] = "Pet updated successfully";
                    header('location: index.php');
	}
} 
?>
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
$category = $result['category'];



?>

<div class="row justify-content-center">


    <div class="col-md-6">

        <div class="card card-header my-3">


            <form action="edit.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>

                <div class="form-group">


                    <label for="animal_name">Animal Name</label>
                    <input type="text" name="animal_name" class="form-control" placeholder="First Name"
                        value="<?php echo $animal_name;?>">

                </div>

                <div class="form-group">

                    <label for="color">Animal Color</label>
                    <input type="text" name="color" class="form-control" placeholder="First Name"
                        value="<?php echo $color;?>">

                </div>

                <div class="form-group">

                    <label for="fname">Owner First Name</label>
                    <input type="text" name="fname" class="form-control" placeholder="First Name"
                        value="<?php echo $fname;?>">

                </div>
                <div class="form-group">

                    <label for="lname">Owner Last Name</label>
                    <input type="text" name="lname" class="form-control" value="<?php echo $lname;?>"
                        placeholder="Last Name">

                </div>

                <div class="form-group">

                    <label for="email">Owner Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email;?>"
                        placeholder="Email">

                </div>

                <div class="form-group">

                    <label for="Description">Animal description</label>
                    <textarea name="Description" id="body" class="form-control" cols="30" rows="5"
                        placeholder="Description"><?php echo $description;?></textarea>
                </div>


                <div class="form-group">

                    <button type="submit" class="bn btn-info text-white btn-block" name="update_data"
                        value="Update Data">Update Data</button>

                </div>

            </form>

            <div class="col-md-4"><a href="index.php" class="btn btn-outline-warning ">back to home</a></div>

        </div>


    </div>


</div>











<?php include 'footer.php' ?>