<pre>
    <?php
    require "database.php";
    $id = $_GET["id"];
    $lookData = $conection -> prepare("SELECT * FROM contacts WHERE id_contact = :id");
    $lookData -> execute([":id"=> $id]);

    if($lookData->rowCount() == 0){
        http_response_code(404);
        header("Location: notFound.php");
        return;
    }

    $getContact = $lookData-> fetch(PDO::FETCH_ASSOC); // Devuelve el valor en forma de un array asociativo

    $error = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['name']) || empty($_POST['phone_number'])){
        $error = "Please fill all the fields";
        }else if(strlen($_POST['phone_number']) < 9){
        $error = "Phone number must be at least 9 characters";
        }else{
        $name = $_POST["name"];
        $phoneNumber = $_POST["phone_number"];
    
        $saveData = $conection-> prepare("UPDATE contacts SET name = :name, phone_number = :phone_number WHERE id_contact= :id");
        $saveData -> execute([
            ":id" => $id,
            ":name" => $name,
            "phone_number" =>$phoneNumber
        ]);
        header("Location: index.php");
        }
    }
    ?>
</pre>

<?php require "./partials/header.php" ?>
        <main>
            <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Contact</div>
                    <div class="card-body">
                    <?php if($error != null): ?>
                        <p class="text-danger">
                        <?= $error ?>
                        </p>
                    <?php endif?>
                    <form method="POST" action="edit.php?id=<?= $getContact['id_contact'] ?>">
                        <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
            
                        <div class="col-md-6">
                            <input value="<?= $getContact['name']?>" id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                        </div>
                        </div>
            
                        <div class="mb-3 row">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>
            
                        <div class="col-md-6">
                            <input value="<?= $getContact['phone_number']?>" id="phone_number" type="tel" class="form-control" name="phone_number" required autocomplete="phone_number" autofocus>
                        </div>
                        </div>
            
                        <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </main>
</body>

</html>