<?php include 'header.php' ?>

<?php session_start(); ?>
<?php require 'config.php' ?>
<?php require 'functions.php' ?>



<?php //echo phpinfo();?>

<div class="container my-4">


    <div class="row">

        <div class="col-12">

            <div class="jumbotron">

                <h1 class="text-center">Simple mongoDB pets record keeper</h1>

                <a href="insert.php" class="btn btn-outline-primary animated rubberBand">Add Pet best option</a>

            </div>


        </div>



        <div class="container">

            <?php 



if(isset($_SESSION['status']) && $_SESSION['status'] != ""){


?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo  $_SESSION['status']; ?>!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>




            <?php


unset($_SESSION['status']);




}

?>

            <?php
        
        if(isset($_POST['save_data'])){

            $collection = $database->selectCollection('pets');
        
            $data = [
        
                'animal_name' => $_POST['animal_name'],
                'color'  =>  $_POST['color'],
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'email' => $_POST['email'],
                'category'  =>  $_POST['category'],
                'Description' => $_POST['Description'],
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
        
                $_SESSION['status'] = "Pet add successfully";
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


            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-4 my-2">

                        <input type="text" name="animal_name" class="form-control" placeholder="Animal Name" required>

                    </div>
                    <div class="col-md-4 my-2">

                        <input type="text" name="fname" class="form-control" placeholder="Owner First Name" required>

                    </div>

                    <div class="col-md-4 my-2">

                        <input type="text" name="lname" class="form-control" placeholder="Owner Last Name" required>

                    </div>
                    <div class="col-md-4 my-2">

                        <input type="email" name="email" class="form-control" placeholder="Owner Email" required>

                    </div>
                    <div class="col-md-4 my-2">

                        <input type="text" name="category" class="form-control"
                            placeholder="Enter the Category of Animal" required>

                    </div>

                    <div class="col-md-4 my-2">

                        <input type="text" name="color" class="form-control" placeholder="Animal  Color" required>

                    </div>

                    <div class="col-md-12 my-2">

                        <textarea name="Description" id="body" class="form-control my-2" cols="30" rows="5"
                            placeholder="Animal Description"></textarea>
                    </div>


                    <div class="col-md-4 my-2">

                        <input type="file" name="file" class="form-control my-2" required placeholder="Upload image"
                            onchange="previewFile(this)" />

                        <img id="previewImg" src="" style="max-width:130px; margin-top:20px;" />

                    </div>

                    <span class="form-group">

                        <div class="form-group">

                            <input type="radio" class="mx-2 " name="gender" value="M" placeholder="Gender">
                            <label class="text-muted">male</label><i class="fas fa-paw fa-2x"></i>

                            <input type="radio" class="mx-2 " name="gender" value="F" placeholder="Gender">
                            <label class="text-muted">Female</label><i class="fas fa-paw fa-2x"></i>

                        </div>
                    </span>




                    <div class="col-md-4 my-2">

                        <button type="submit" class="bn btn-info ml-5 my-2  text-white btn-block" name="save_data"
                            value="Save Data">Save pet</button>

                    </div>

                </div>
            </form>


        </div>



        <div class="container">

            <div class="row">


                <div class="col-md-12">


                    <div class="card card-header">


                        <?php 



if(isset($_SESSION['add']) && $_SESSION['add'] != ""){


?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo  $_SESSION['add']; ?>!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>




                        <?php


unset($_SESSION['add']);




}

?>









                        <?php 

if(isset($_SESSION['update']) && $_SESSION['update'] != ""){


?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo  $_SESSION['update']; ?>!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <?php


unset($_SESSION['update']);

}





?>



                        <table class="table  table-striped table-borderless table-responsive-lg">

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>Animal Name</th>
                                    <th>Animal Color</th>
                                    <th>Owner First Name</th>
                                    <th>Owner Last Name</th>
                                    <th>Owner Email</th>
                                    <th>Animal category</th>
                                    <th>Animal Gender</th>

                                    <!-- <div>

                                        <a href="#" class="btn btn-warning text-white py-2">Total record:
                                        </a>
                                    </div> -->




                                </tr>

                            </thead>


                            <tbody>

                                <?php 
                                
                                    $collection = $database->selectCollection('pets');

                                    $getUsers = $collection->find(

                                        [],

                                        [

                                            //  'limit' => 3,
                                            // 'skip'  => 1,
                                            'sort' => ['animal_name' =>  -1 ]
                                        ]



                                    );


                                              $i = 0;
                                            foreach ($getUsers as $res => $getUser) {
                                               $i++;
                                           
                                                echo "<tr>";
                                                echo "<td>".$i."</td>";
                                                echo "<td>".$getUser['animal_name']."</td>";
                                                echo "<td>".$getUser['color']."</td>";
                                                echo "<td>".$getUser['fname']."</td>";
                                                echo "<td>".$getUser['lname']."</td>";
                                                echo "<td>".$getUser['email']."</td>";
                                                echo "<td>".$getUser['category']."</td>";
                                                echo "<td>".$getUser['gender']."</td>";
                                           
                                               
                                                ?>
                                <td> <img src="upload/<?php echo $getUser['cover_image'] ?>" width="70px"></td>


                                <?php   

                                echo "<td class='btn btn-group'>";


                                    echo "<a href=\"edit.php?id=$getUser[_id]\" data-toggle='tooltip'
                                        data-placement='top' title='Edit'
                                        class='btn btn-outline-success edit red-tooltip'><i
                                            class='fas fa-edit'></i></a>";
                                            
                                    echo "<a href=\"show.php?id=$getUser[_id]\" data-toggle='tooltip'
                                        data-placement='top' title='Detail'
                                        class='btn btn-outline-info  detail red-tooltip'><i
                                            class='fas fa-eye'></i></a>";
                                    echo "<a href=\"delete.php?id=$getUser[_id]\" data-toggle='tooltip'
                                        data-placement='top' title='Delete'
                                        class='btn btn-outline-danger delete red-tooltip'><i
                                            class='fas fa-dumpster'></i></a></td>";


                                }

                            

                                ?>



                            </tbody>

                        </table>


                    </div>

                </div>



            </div>

        </div>



        <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        </script>

        <!-- <script>
        <if(isset($_SESSION['msg'])): ?>

        toastr.success('< flash("msg"); ?>');
        < endif ?>
        </script>

        <  -->

        <?php
        echo "<script type='text/javascript'>
        toastr.success('Welcome to Pet Care')
        </script>";

        ?>


        <?php include 'footer.php' ?>