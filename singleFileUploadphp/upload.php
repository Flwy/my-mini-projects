<!-- 
    This is my code for uploading a single file in php.  I am currently working on 
    uploading using more than one input forms.  I have attempted to do more than one
    input from this file, but to no avail.  I shall attempt that in another php file.  This Php upload only accepts png files less than 3MB.  That can be modified to whatever file type by changing up the code a bit.  Thanks to newboston for the headstart on this mini project.
-->
<br></br>
<div>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type = "file" name = "file1">
        <input type = "submit" value="Submit">
        <?php 
            $file1 = 'file1';// php embedded for variable of each file name
            $checkType1 = 'png'; 
    
            fileUpload($file1, $checkType1);
        ?> 
    </form>
</div>

<?php

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
            echo 'Please choose a file.';
        }
    }
}
?>
