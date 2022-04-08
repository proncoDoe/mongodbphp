<?php include 'header.php' ?>

<?php require 'config.php' ?>
<?php session_start(); ?>
<?php 

 if(isset($_POST['save_data'])){

    $collection = $database->selectCollection('pets');

    $data = [

        'animal_name' => $_POST['animal_name'],
        'color'  =>  $_POST['color'],
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'email' => $_POST['email'],
        'Description' => $_POST['Description'],
        'category'  =>  $_POST['category'],
        'gender' => $_POST['gender'],
        'created_at' => new MongoDB\BSON\UTCDateTime

    ];

    if($_FILES['file']){

        if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' .$_FILES['file']['name'])){

            $data['cover_image'] = $_FILES['file']['name'];
            
        }else{

            echo 'failed to uplaod file';
        }
        
    }

    $result = $collection->insertOne($data);

    if($result->getInsertedCount() > 0){

        $_SESSION['add'] = "Pet add successfully";
                header('location: index.php');

    }else{

        echo 'Pet not created successfully';
    }
    
    if(!$result === 'dog' || !$result === 'cat' || !$result === 'bird' || !$result === 'reptile' || !$result === 'sheep' 
    || !$result === 'goat' || !$result === 'cow'){
     
 }

 if(!$result == "M" || !$result == "F"){


    echo 'You must check the botton';

 }

}

?>




<div class="row justify-content-center">


    <div class="col-md-6">

        <div class="card card-header my-3">


            <form action="insert.php" method="post" enctype="multipart/form-data">

                <div class="form-group">

                    <input type="text" name="animal_name" class="form-control" placeholder="Animal Name" required>

                </div>

                <div class="form-group">

                    <select name="category" id="" class="form-control" required>
                        <option value="" selected disabled>Categories</option>
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="bird">Bird</option>
                        <option value="reptile">Reptile</option>
                        <option value="sheep">sheep</option>
                        <option value="goat">Goat</option>
                        <option value="cow">Cow</option>


                    </select>

                </div>

                <div class="form-group">

                    <input type="text" name="color" class="form-control" placeholder="Color" required>

                </div>

                <div class="form-group">

                    <input type="text" name="fname" class="form-control" placeholder="Owner First Name" required>

                </div>

                <div class="form-group">

                    <input type="text" name="lname" class="form-control" placeholder="Owner Last Name" required>

                </div>

                <div class="form-group">

                    <input type="email" name="email" class="form-control" placeholder="Owner Email" required>

                </div>

                <div class="form-group">

                    <label for="Description">Optional</label>
                    <textarea name="Description" id="body" class="form-control" cols="30" rows="5"
                        placeholder="Animal Description"></textarea>
                </div>


                <div class="form-group">

                    <input type="file" name="file" class="form-control" required placeholder="Upload image"
                        onchange="previewFile(this)" />

                    <img id="previewImg" src="" style="max-width:130px; margin-top:20px;" />

                </div>

                <span class="form-group fontradio ">

                    <div class="form-group">

                        <input type="radio" class="mx-2 " name="gender" value="M" placeholder="Gender">
                        <label class="text-muted">male</label><i class="fas fa-paw fa-2x"></i>

                        <input type="radio" class="mx-2 " name="gender" value="F" placeholder="Gender">
                        <label class="text-muted">Female</label><i class="fas fa-paw fa-2x"></i>

                    </div>
                </span>

                <div class="form-group">

                    <button type="submit" class="bn btn-info text-white btn-block" name="save_data"
                        value="Save Data">Save pet</button>

                </div>

            </form>

            <div class="col-md-4"><a href="index.php" class="btn btn-outline-warning ">back to home</a></div>

        </div>


    </div>


</div>


</div>

<?php include 'footer.php' ?>