<?php 

    require './file_functions.php'; // throws an error
    require './users_functions.php';
    require './form_functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sedmica 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="./style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
</head>
<body>
    
    <div class="container pt-5">
      <div class="row">
        <div class="col-8 offset-2">

            <?php 
                if(isset($_GET['user_saved']) && $_GET['user_saved'] == 1)
                    showAlertDiv("Uspješno dodavanje korisnika!", "alert-success");
                if(isset($_GET['user_deleted']) && $_GET['user_deleted'] == 1)
                    showAlertDiv("Uspješno brisanje korisnika!", "alert-success");
            ?>

            <div class="row">
                <div class="col-12 text-end">
                    <form action="./index.php" method="GET">
                        <div class="row">
                            <div class="col-3 offset-9">
                                <input type="text" placeholder="Pretraga..." name="term" class="form-control" id="searchTermInput" value="<?=isset($_GET['term']) ? $_GET['term'] : ''?>" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                       $users = getUsersFromFile();
                       if(isset($_GET['term'])){
                           $users = filterUsers($users, strtolower($_GET['term']));
                       }
                       
                       for($i = 0; $i < count($users); $i++){
                           echo "<tr>";
                           echo "   <td>".$users[$i]['id']."</td>";
                           echo "   <td>".$users[$i]['first_name']."</td>";
                           echo "   <td>".$users[$i]['last_name']."</td>";
                           echo "   <td>".$users[$i]['email']."</td>";
                           echo "   <td> <a class=\"btn btn-danger\" href=\"delete_user.php?id=".$users[$i]['id']."\" >X</a> </td>";
                           echo "</tr> \n ";
                       } 

                    ?>
                </tbody>
            </table>
            
            <div class="row">
                <div class="col-12 text-end">
                    <!-- php echo shorthand -->
                    Ukupno redova: <?=count($users)?>
                </div>
            </div>

        </div>
      </div>

      <div class="row mt-5">
          <div class="col-8 offset-2">
            
          <form action="./add_new_user.php" method="POST">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="first_name" class="form-control" placeholder="Unesite ime">
                    </div>
                    <div class="col-4">
                        <input type="text" name="last_name" class="form-control" placeholder="Unesite prezime">
                    </div>
                    <div class="col-4">
                        <input type="email" name="email" class="form-control" placeholder="Unesite e-mail adresu">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4 offset-4">
                        <button class="btn btn-success w-100">Dodaj korisnika</button>
                    </div>
                </div>
            </form>

          </div>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        // document.getElementById("searchTermInput").addEventListener("keyup", () => {
        //     console.log(document.getElementById("searchTermInput").value);
        // });
    </script>
</body>
</html>