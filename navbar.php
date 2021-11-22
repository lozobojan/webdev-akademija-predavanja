<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">PhoneBook</a>
    <div class="float-end">
        <span>prijavljeni korisnik: <?=$_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']?> </span>
        <a href="./logout.php" class="btn btn-primary btn-sm ml-4">Odjava</a>
    </div>
  </div>
</nav>