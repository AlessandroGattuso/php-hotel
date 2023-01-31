<?php 
  $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],
  ];

  $hotelsToShow = $hotels;

  if(isset($_GET['search'])){
    if($_GET['search'] != ''){
      foreach($hotelsToShow as $index => $hotel){
        if(!preg_match('/'.$_GET['search'].'/i', $hotel['name'])){
          unset($hotelsToShow[$index]);
        }
      }
    }
  }

  if(isset($_GET['vote'])){
    if($_GET['vote'] != 'Voto'){
      foreach($hotelsToShow as $index => $hotel){
        if($hotel['vote'] < $_GET['vote'])
          unset($hotelsToShow[$index]);
      }
    }
  }
  
  if(isset($_GET['parking'])){
    foreach($hotelsToShow as $index => $hotel){
      if(!$hotel['parking'])
          unset($hotelsToShow[$index]);
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/style.css">
  <title>php-hotel</title>
  <style>
      .green-check:focus {
        border-color: rgba(0, 0, 0, 0.25);
        outline: 0;
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgb(53,225,161)'/></svg>");
      }

      .green-check:checked {
        background-color: rgb(53, 225, 161);
        border-color: rgb(53, 225, 161);
        border: none;
        background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba(255,255,255)'/></svg>");
      }
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
      <div class="container py-3">
        <a class="d-flex align-items-center navbar-brand" href="#">
          <img src="https://www.tripadvisor.it/favicon.ico" alt="Bootstrap" width="30" height="30">
        </a>
        <a class="navbar-brand" href="#">
          <h3 class="m-0 fw-bold">Booladvisor</h3>
        </a>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
            <form  action="./index.php" method="GET" class="d-flex gap-4" role="search">
              <div class="d-flex align-items-center form-check form-switch">
                <label class="me-5 form-check-label fw-semibold" for="flexSwitchCheckDefault">Parking</label>
                <input name="parking" class="form-check-input green-check" type="checkbox" role="switch" id="flexSwitchCheckDefault">
              </div>
              <select name="vote" class="form-select fw-semibold" aria-label="Default select example">
                  <option selected>Voto</option>
                  <?php for($i = 1; $i <= 5; ++$i){ ?>
                            <option value="<?php echo $i ?>" class="fw-semibold"><?php echo $i ?></option>
                  <?php } ?>           
              </select>
              <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-dark" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="container d-flex flex-wrap gap-4 mt-5">
      <?php foreach($hotelsToShow as $hotel){ ?>
              <div class="card" style="width: 15rem;">
                  <div class="card-body">
                    <h4><?php echo $hotel['name'] ?></h4>
                    <p><?php echo $hotel['description'] ?></p>
                    <p><?php echo $hotel['parking'] ? 'Parking <span class="green-text">is</span> available': 'Parking <span class="red-text">is not</span> available' ?></p>
                    <div class="d-flex align-items-center gap-2">
                      <span>Voto: </span>
                      <div class="d-flex align-items-center gap-1">
                        <?php for($votes = 0; $votes < $hotel['vote']; ++$votes){ ?>
                                  <i class="fa-solid fa-circle green-text"></i>
                        <?php } ?>
                      </div>
                    </div>
                    <p><?php echo 'Dista dal centro '.$hotel['distance_to_center'].' km' ?></p>
                  </div>
              </div>
      <?php } ?>
    </div> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>