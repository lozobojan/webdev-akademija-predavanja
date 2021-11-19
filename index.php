<?php 

    require './db_connect.php';
    require './users_functions.php';
    require './form_functions.php';
    require './auth_functions.php';
    
    checkAuth();
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

    <!-- HTTP, GET (query string)/POST -->

    <div class="container pt-5">
      <div class="row">
        <div class="col-8 offset-2">

            <?php 
                if(isset($_GET['user_saved']) && $_GET['user_saved'] == 1)
                    showAlertDiv("Uspješno dodavanje korisnika!", "alert-success");
                if(isset($_GET['user_deleted']) && $_GET['user_deleted'] == 1)
                    showAlertDiv("Uspješno brisanje korisnika!", "alert-success");
                if(isset($_GET['user_updated']) && $_GET['user_updated'] == 1)
                    showAlertDiv("Uspješna izmjena korisnika!", "alert-success");
                if(isset($_GET['logged_in']) && $_GET['logged_in'] == 1)
                    showAlertDiv("Dobrodošli!", "alert-success");
            ?>

            <div class="row mb-3">
                <div class="col-12 text-end">
                    <form action="./index.php" method="GET">
                        <div class="row">
                            <div class="col-3 text-start">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#newUserModal" class="btn btn-primary w-100">Dodaj novog korisnika</a>
                            </div>
                            <div class="col-3 offset-6">
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
                        <th>Država</th>
                        <th>Grad</th>
                        <th>Izmjena</th>
                        <th>Brisanje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        $get_users_sql = "SELECT 
                                                users.id, 
                                                users.first_name, 
                                                users.last_name, 
                                                users.email, 
                                                COALESCE(cities.name, 'nepoznato') as city_name, 
                                                COALESCE(countries.name, 'nepoznato') as country_name
                                            from users
                                            left join cities on cities.id = users.city_id
                                            left join countries on countries.id = users.country_id
                                        ";                      

                       if(isset($_GET['term'])){
                           $term = $_GET['term'];
                           $get_users_sql = $get_users_sql . " WHERE first_name like '%$term%' OR last_name like '%$term%' 
                                                                OR cities.name like '%$term%' OR countries.name like '%$term%'
                                                            ";
                       }
                       $get_users_sql .= " ORDER BY first_name ASC ";

                       $res_users = mysqli_query($dbconn, $get_users_sql); 
                       
                       while($user = mysqli_fetch_assoc($res_users)){
                           echo "<tr>";
                           echo "   <td>".$user['id']."</td>";
                           echo "   <td>".$user['first_name']."</td>";
                           echo "   <td>".$user['last_name']."</td>";
                           echo "   <td>".$user['email']."</td>";
                           echo "   <td>".$user['country_name']."</td>";
                           echo "   <td>".$user['city_name']."</td>";
                           echo "   <td> <a class=\"btn btn-primary\" href=\"#\" onclick=\"showEditModal(".$user['id'].")\" >i</a> </td>";
                           echo "   <td> <a class=\"btn btn-danger\" href=\"#\" onclick=\"confirmDelete(".$user['id'].")\" >X</a> </td>";
                           echo "</tr> \n ";
                       } 

                    ?>
                </tbody>
            </table>
            
            <div class="row">
                <div class="col-12 text-end">
                    <!-- php echo shorthand -->
                    Ukupno redova: <?=mysqli_num_rows($res_users)?>
                </div>
            </div>

        </div>
      </div>

    </div>
    
    <?php include("./modals/confirm_delete_modal.php"); ?>
    <?php include("./modals/new_user_modal.php"); ?>
    <?php include("./modals/edit_user_modal.php"); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        
        function confirmDelete(id){
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {});
            document.getElementById("deleteUserIdSpan").innerHTML = id;
            document.getElementById("deleteButton").href = 'delete_user.php?id='+id;
            confirmModal.show();
        }

        async function showEditModal(id){
            var editModal = new bootstrap.Modal(document.getElementById('editUserModal'), {});

            // Promise + callback verzija
            // fetch("http://localhost/uvod-php/api/user.php?id="+id)
            //     .then((response) => response.json())
            //     .then((responseJSON) => {
            //         if(responseJSON.status == true){
            //             let userData = responseJSON.data;
            //             document.getElementById("editModalFirstName").value = userData.first_name;
            //             document.getElementById("editModalLastName").value = userData.last_name;
            //             document.getElementById("editModalEmail").value = userData.email;
            //         }
            //     })
            
            let response = await fetch("http://localhost/uvod-php/api/user.php?id="+id);
            let responseJSON = await response.json();
            if(responseJSON.status == true){
                let userData = responseJSON.data;
                document.getElementById("editModalFirstName").value = userData.first_name;
                document.getElementById("editModalLastName").value = userData.last_name;
                document.getElementById("editModalEmail").value = userData.email;
                document.getElementById("editModalId").value = userData.id;
            }
            editModal.show();
        }

        document.getElementById("newUserCountrySelect").addEventListener('change', async () => {
            let country_id = document.getElementById("newUserCountrySelect").value;
            let response = await fetch("http://localhost/uvod-php/api/cities_by_country.php?country_id="+country_id);
            let responseJSON = await response.json();
            
            let usersOptions = '';
            responseJSON.forEach((city) => {
                usersOptions += `<option value="${city['id']}" >${city['name']}</option>`;
            });

            document.getElementById("newUserCitySelect").innerHTML = usersOptions;
        });

    </script>    

</body>
</html>