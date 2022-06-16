<?php
$fileerror=false;
$filesuccess=false;
$errormsg='';
if(isset($_POST['submit'])){
    $fileerror=false;
    $filesuccess=false;
    if(isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE){
        $name=$_FILES['image']['name'];
        if(file_exists('images/'.$name)){
            $fileerror=true;
            $errormsg='this file already is exists';

        }else{
            $filetype=pathinfo($name,PATHINFO_EXTENSION);
            // ECHO $filetype;
            if($filetype =='png' || $filetype == 'jpg'){
                if($_FILES['image']['size']> 555555){
                    $fileerror=true;
                    $errormsg='sorry your file is too large';
                }else{
                    if(move_uploaded_file($_FILES['image']['tmp_name'],'images/'.$name)){
                        $filesuccess=true;
            
                    }else{
                        $fileerror=true;
                        $errormsg='sorry we have an error in uploading file';
    
            
                    }
                }
                


            }else{
                $fileerror=true;
                $errormsg='please just upload jpg or  png file';

  
            }

        }


    }else {
        $fileerror=true;
        $errormsg='please select an image to upload';

 
    }

    // echo $name;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class='container'>

    <form method='post' enctype='multipart/form-data'>
        <div class='mb-3'>
            <label class='form-label'>Choose new picture profile</label>
            <input type='file' class='form-control <?php if($filesuccess) echo 'is-valid' ?> <?php if($fileerror) echo 'is-invalid' ?>' name='image' accept='image/*'>
            <div class='valid-feedback'>
                successfully add it
            </div>
            <div class='invalid-feedback'>
                <?php echo $errormsg ?>
            </div>
        </div>

        <input type='submit' name='submit' class='btn btn-success' value='Add image'>

    </form>

    </div>
</body>
</html>