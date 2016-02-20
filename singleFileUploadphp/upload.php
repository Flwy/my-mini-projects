<!-- 
    This is my code for uploading a single file in php.  I am currently working on 
    uploading using more than one input forms.  I have attempted to do more than one
    input from this file, but to no avail.  I shall attempt that in another php file.  This Php upload only accepts png files less than 3MB.  That can be modified to whatever file type by changing up the code a bit.  Thanks to newboston for the headstart on this mini project.
-->

<!-- 
        Version 2 on 2/20/16:
        Got two file uploads of different file types to work.  The issue with my previous attempt one was the order of the defined variables which yielded an undefined index error.  So the php code for the variables and function now comes before the method calling the function.
-->
<?php

$file1 = 'file1';
$checkType1 = 'png';
$file2 = 'file2';
$checkType2 = 'jpg';



function fileUpload($file, $checkType) { //function for uploading files.

    $name = $_FILES[$file]['name']; //name of file taken from associative array
    $type = $_FILES[$file]['type'];
    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));//gets file type extension and makes it lowercase
    $size = $_FILES[$file]['size'];
    $max_size = 3145728; //max size regulation in bytes (3MB)

    $type = $_FILES[$file]['type'];

    $tmp_name = $_FILES[$file]['tmp_name'];

    if (isset($name)) {
        if (!empty($name)) {
            if ($extension == $checkType && $size <= $max_size) { // checks to see if the file is of the specified type
            $location = 'uploads/'; //folder location of the uploads
                if (move_uploaded_file($tmp_name, $location.$name)) { //moves file to destination folder from location variable and if true, echos out the string below
                    echo 'Uploaded!';
                }
                else {
                    echo 'There was an error.'; //if the file was not moved, this string will echo out for debugging purposes.
                }
            }
            else {
                echo 'File type must be ' . $checkType . ' and must be less than 3mb';
            }
        }
        else {
            echo 'Please choose a ' . $checkType . ' file.';
        }
    }
}
?>

<br></br>
<div>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type = "file" name = "file1">
        <input type = "submit" value = "Submit file 1">
        <?php 
            fileUpload($file1, $checkType1);
        ?>
        
        <br></br>
        
        <input type = "file" name = "file2">
        <input type = "submit" value = "Submit file 2">
        <?php
            fileUpload($file2, $checkType2);
        ?>
        
    
    </form>
    <p>The test here is to allow only one type of file for the first input and to allow a different file type for the second input.</p>
</div>

