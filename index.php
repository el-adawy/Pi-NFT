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

<html lang="en"><head>
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

    <header>
     
              </ul>
            </div>
          </div>
        </div>
      </div>
      
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Pi Network NFTs 🖼</h1>
          <p class="lead text-muted">
NFTs are a fun and smart way to deal with cryptocurrencies.
Here at uneat APP you can Buy awesome NFTs, sell your own and take chances bidding public NFTs.

</p>
          <p>


You can also enter special events to get special edition Pi NFTs, breeding NFT from featured artists or even get breeding NFTs. Are you curious? Welcome to uneat NFT world.
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light"
">
        <div class="container">

<?php

	if (!isset($_GET['nft-id'])){

	  $query = $pdo->query('SELECT * FROM NFT');


	  echo '<div class="row">';

	  $i = 1;

	  while ($data = $query->fetch()) {
	  $i++;


	  echo '<div class="col-md-4">
              <div class="card mb-4 box-shadow">
	       
                <a href="index.php?nft-id=' . $data['ID'] .'"><img class="card-img-top" src="/img/nfts/NFT_' . $data['ID'] . '.jpg" data-holder-rendered="true" style="height: 300px"></a>

		<div class="card-body" style="height: 320px">
                  <p class="card-text">' . $data['TITLE'] . ' - @' . $data['CREATOR_NAME'] . '</p>
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Buy</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Bid</button>
                </div>
              <p class="card-text">' . $data['DESCRIPTION'] . '<br />You can Buy now this NFT or wait until you can bid on a Auction.</p>

              <div class="d-flex justify-content-between align-items-center">

                <small class="text-muted">'. round($data['PRICE'], 3) . ' <img src="/img/pi.png" style="height: 10px; margin-bottom: 3px"></small>
              </div>
            </div>
	    </div>
	    </div>
              ';
	  }
         
	 echo'      </div>
	       </div> ';

	       }//endIf

	       else {
	       //click on a nft
	       
	  $query = $pdo->query('SELECT * FROM NFT WHERE ID = :id_get');
	  $data = $query->execute(array('id_get' => htmlspecialchars($_GET['nft-id'])));
	  $data = $query->fetch();
	       
	       echo '<div class="row ">
	       
	      <div class="col-md-4">
              <div class="card mb-4 box-shadow">
	       
                <a href="index.php?nft-id=' . $data['ID'] .'"><img class="card-img-top" src="/img/nfts/NFT_' . $data['ID'] . '.jpg" data-holder-rendered="true" style="height: 300px"></a>

		<div class="card-body" style="height: 320px">
                  <p class="card-text">' . $data['TITLE'] . ' - @' . $data['CREATOR_NAME'] . '</p>
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Buy</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Bid</button>
                </div>
              <p class="card-text">' . $data['DESCRIPTION'] . '<br />You can Buy now this NFT or wait until you can bid on a Auction.</p>

              <div class="d-flex justify-content-between align-items-center">

                <small class="text-muted">'. round($data['PRICE'], 3) . ' <img src="/img/pi.png" style="height: 10px; margin-bottom: 3px"></small>
              </div>
            </div>
	    </div>
	    </div>';


	       }
?>
       

            
            
           
          
         
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p> © Pi Network</p>
        <p><a href="../../">Visit the homepage</a>.</p>
      </div>
    </footer>


  
