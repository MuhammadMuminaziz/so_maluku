<?php
    session_start();
    require_once("../../configuration/connection.php");

        $id = $_POST['id'];
        $title = $_POST['title'];

        $android1 = trim(strip_tags($_POST['android']));
        $android = $mysqli->escape_string($android1); 

        $ios1 = trim(strip_tags($_POST['ios']));
        $ios = $mysqli->escape_string($ios1); 

        $status = ($_POST['status'] == 1) ? 1 : 0;

        if( $_SESSION['user'] != "demo@admin.com" ){
                if($id == null){
                    
                    $record = "INSERT INTO `user_agent` VALUES(NULL,'".$title."','".$android."','".$ios."','".$status."')";
                    $message = "User Agent has been saved successfully";
                    
                } else {
                    $query = "SELECT * FROM `user_agent` WHERE `id` = '".$id."'";
                    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
                    
                    if( $is_upload == false ){
                        $row = mysqli_fetch_array($result);
                    }
                    
                    $record = "UPDATE `user_agent` SET `title` = '$title', `android` = '$android', `ios` = '$ios' , `status` = '$status'  WHERE `id` = '".$id."' ";
                    $message = "User Agent has been updated successfully";
                }
            
            if(mysqli_query($mysqli, $record)){
                $_SESSION['success'] = $message;
            } else{
                $_SESSION['error'] = "failed";
            }
        }else{
            $_SESSION['error'] = "Demo User Don\'t have permission for this action.";
        }
    header("Location: ../../view/index.php?page=useragent");
?>