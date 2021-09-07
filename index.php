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
          <p class="lead text-muted">Now you already know that NFTs are likely to revolutionize things in multiple industries, marketplace for NFTs where user can buy, sell NFTs and even mint one of their own to store it or sell it on auction. 

Since this is yet only in corners of my mind, this will have below special features. 

Open marketplace of NFTs
Minting new NFT from image, video, gif etc. 
Buy / sell NFT using Pi coins. </p>
          <p> 
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light"
">
        <div class="container">

<?php

	if (!isset($_GET['nft-id'])){

	  $query = $pdo->query('SELECT * FROM NFT');


	  echo '<div class="row ">';

	  $i = 1;

	  while ($data = $query->fetch()) {
	  $i++;


	  echo '<div class="col-md-4">
              <div class="card mb-4 box-shadow">
	       
                <a href="index.php?nft-id=' . $data['ID'] .'"><img class="card-img-top" src="/img/nfts/NFT_' . $data['ID'] . '.jpg" data-holder-rendered="true" style="height: 300px"></a>
                 <div class="card-body" style="height: 250px">
                  <p class="card-text">' . $data['DESCRIPTION'] . '</p>
                  <div class="d-flex justify-content-between align-items-center">
                     
					 <button type="button" class="btn btn-success">Buy</button>					 
					 <button type="button" class="btn btn-danger" style="margin-left: 5px; margin-right: 5px">Sell</button>
					 <button type="button" class="btn btn-info">Auction</button>

                    
 
                  </div>
                </div>
		</div>
		</div>
              ';
	  }
         
	 echo'      </div>
	       </div> ';

	       }

	       else {
	       //click on a nft
	       
	       
	       echo '<div class="row ">
	       
	       <div class="col-md-4">
              <div class="card mb-4 box-shadow">
	       
                <img class="card-img-top" src="/img/nfts/NFT_' . $_GET['nft-id'] . '.jpg" data-holder-rendered="true" style="height: 300px">
                 
<div class="card-body">

<div class="row">
<p class="card-text">' . $data['TITLE'] . '</p>
</div>

<div class="row">

</div>

<div class="row">

</div>
              <p class="card-text">' . $data['DESCRIPTION'] . '</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Buy</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Bid</button>
                </div>
                <small class="text-muted">' . round($data['PRICE'], 3) . ' <img </small>
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


  
