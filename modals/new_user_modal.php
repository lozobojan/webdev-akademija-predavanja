<!-- Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodavanje korisnika</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form action="./add_new_user.php" method="POST" enctype="multipart/form-data">
          <div class="row">
              <div class="col-12">
                  <input type="text" name="first_name" class="form-control" placeholder="Unesite ime">
              </div>
              <div class="col-12 mt-3">
                  <input type="text" name="last_name" class="form-control" placeholder="Unesite prezime">
              </div>

              <div class="col-12 mt-3">
                  <select name="country_id" class="form-control" id="newUserCountrySelect">
                    <option value="">-odaberite državu-</option>
                    <?php 

                      $countries_sql = "SELECT * FROM countries";
                      $countries_res = mysqli_query($dbconn, $countries_sql);

                      while($country = mysqli_fetch_assoc($countries_res) ){
                        $id_temp = $country['id'];
                        $name_temp = $country['name'];
                        echo "<option value=\"$id_temp\">$name_temp</option>";
                      }

                    ?>
                  </select>
              </div>

              <div class="col-12 mt-3">
                  <select name="city_id" class="form-control" id="newUserCitySelect"></select>
              </div>
              
              <div class="col-12 mt-3">
                  <input type="file" name="profile_photo" class="form-control">
              </div>

              <div class="col-12 mt-3">
                  <input type="email" name="email" class="form-control" placeholder="Unesite e-mail adresu">
              </div>
              <div class="col-12 mt-3">
                  <input type="password" name="password" class="form-control" placeholder="Unesite lozinku">
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
</div>