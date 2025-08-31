<?php
include("dbconnect.php");
if (isset($_POST["button"])) {
    $username=$_POST["uname"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $sql= "insert into user(username,email,Password) values
    ('$username','$email','$password')";

    $pdo->exec($sql);
    echo"Insert Data Successful";
}


?>

<!-- if (isset($_POST["insertBtn"])){
        $name = $_POST["pname"];
        $price = $_POST["price"];
        $category = $_POST["category"];
        $qty = $_POST["qty"];
        $description = $_POST["description"];
        $fileImage = $_FILES["productImage"];
        $filePath = "productImage/".$fileImage["name"];

        $status = move_uploaded_file($fileImage["tmp_name"], $filePath);

        if($status){
            try{ //inserting data into database
                //productID	productName	category	price	description	qty	imgPath	
                $sql= "insert into products values (?,?,?,?,?,?,?)";
                $stmt = $conn -> prepare($sql);
                $flag = $stmt -> execute([null,$name,$category,$price,$description,$qty,$filePath]);

                $id=$conn -> lastInsertId();
                if($flag){
                    $message= "new product with id $id has been insered successfully!.";
                    $_SESSION['message']= $message;
                    header("Location:viewProduct.php");
                

                }else{

                }

            }catch(Exception $e){
                echo $e->getMessage();
            }

        }else{
            echo "file upload failed";
        }
    } -->
