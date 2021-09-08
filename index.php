<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

try{
    $pdo = new PDO('sqlite:'.dirname(__FILE__).'/nft.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Pi Network - NFT</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>

  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">Uneat</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading"></h1>
          <p class="lead text-muted">
            NFTs are a fun and smart way to deal with cryptocurrencies.
            Here at uneat APP you can Buy awesome NFTs, sell your own and take chances bidding public NFTs.
          </p>
          <p>
            You can also enter special events to get special edition Pi NFTs, breeding NFT from featured artists or even get breeding NFTs. Are you curious? Welcome to uneat NFT world.
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

<?php


  function display_nft_card($id, $title, $creator_name, $description, $price){

    echo '<div class="col-md-4">
    <div class="card mb-4 box-shadow">	       
      <a href="index.php?nft-id=' . $id .'"><img class="card-img-top" src="/img/nfts/NFT_' . $id . '.jpg" data-holder-rendered="true" style="height: 300px"></a>
      <div class="card-body">
        <p class="card-text">' . $title . ' - @' . $creator_name . '</p>
        <p class="card-text">You can Buy now this NFT or wait until you can bid on a Auction.</p>
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-outline-secondary">Buy</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Bid</button>
        </div>
        <div class="d-flex justify-content-between align-items-center"><br>
          <small class="text-muted"><img src="/img/pi.png" style="height: 10px; margin-bottom: 3px">  '. round($price, 3) . ' </small>
        </div>
      </div>
    </div>
</div>';

  }

	if (!isset($_GET['nft-id'])){
        $query = $pdo->query('SELECT * FROM NFT');
        echo '<div class="row">';
        $i = 1;
        while ($data = $query->fetch()) {
        $i++;

        display_nft_card($data['ID'], $data['TITLE'], $data['CREATOR_NAME'], $data['DESCRIPTION'], $data['PRICE']);

	}
         
	 echo'</div></div>';
	}//endIf

	else {//click on a nft	       
        $query = $pdo->query('SELECT * FROM NFT WHERE ID = :id_get');
        $data = $query->execute(array('id_get' => htmlspecialchars($_GET['nft-id'])));
        $data = $query->fetch();
            display_nft_card($data['ID'], $data['TITLE'], $data['CREATOR_NAME'], $data['DESCRIPTION'], $data['PRICE']);
	      }
        
?>
          </div>
        </div>
      </div>

    </main>

      <footer>
          <div class="container">
              <div class="row">
                  
                  <div class="col-sm-6 col-md-3 item">
                      <h3>About</h3>
                      <ul>
                          <li><a href="#">About Us</a></li>
                          <li><a href="#">About Pi Network</a></li>
                          <li><a href="#">Contact Us</a></li>
                          <li><a href="#">FAQ</a></li>
                          <li><a href="#">Terms Of Use</a></li>
                          <li><a href="#">Privacy Policy</a></li>
                      </ul>
                  </div>
                  <div class="col-md-6 item text">
                      <h3>UNEAT</h3>
                      <p>Collecting Creativity</p>
                  </div>
                  <div class="col item social"><a href="https://www.facebook.com/PiCoreTeam/"><i class="icon ion-social-facebook"></i></a><a href="https://twitter.com/uneat_pi"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="https://www.instagram.com/uneat.pi/"><i class="icon ion-social-instagram"></i></a></div>
              </div>
              <p class="copyright">Uneat© 2021</p>
          </div>
      </footer>


  
</html>