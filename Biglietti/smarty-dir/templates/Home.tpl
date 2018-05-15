<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/Home.css">

    <title>Zone Evento</title>
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid" id="header">
  <div class="container">
    <h1 class="display-4">TicketStore</h1>
    <!--<p class="lead">By people, for people</p>-->
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Eventi
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Concerti</a>
          <a class="dropdown-item" href="#">Spettacoli</a>
          <a class="dropdown-item" href="#">Sport</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Luoghi
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Roma</a>
          <a class="dropdown-item" href="#">Milano</a>
          <a class="dropdown-item" href="#">Torino</a>
          <a class="dropdown-item" href="#">Bologna</a>
          <a class="dropdown-item" href="#">L'Aquila</a>
          <div class="dropdown-divider"></div>
          <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
        </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../login.html">Accedi</a>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="carousel-section">

<div id="carousel-left" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="imgs/Deep.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="imgs/Deep-Purple.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="imgs/DT.jpg" alt="Third slide">
    </div>
  </div>
</div>

<div id="carousel-right" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="box">
        <div class="row">
          <div class="col"><img src="imgs/Deep.jpg" class="img-fluid" alt="Responsive image"></div>
          <div class="col"><img src="imgs/Deep.jpg" class="img-fluid" alt="Responsive image"></div>
          <div class="w-100"></div>
          <div class="col"><img src="imgs/Deep.jpg" class="img-fluid" alt="Responsive image"></div>
          <div class="col"><img src="imgs/Deep.jpg" class="img-fluid" alt="Responsive image"></div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="box">
        <div class="row">
          <div class="col"><img src="imgs/DT.jpg" class="img-fluid" alt="Responsive image"></div>
          <div class="col"><img src="imgs/DT.jpg" class="img-fluid" alt="Responsive image"></div>
          <div class="w-100"></div>
          <div class="col"><img src="imgs/DT.jpg" class="img-fluid" alt="Responsive image"></div>
          <div class="col"><img src="imgs/DT.jpg" class="img-fluid" alt="Responsive image"></div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<div class="categorie">
  <div class="header-categorie">
      <h2>tutte le categorie</h2>
  </div>

  {section name=nr loop=$results}      
    <div class="row">
    <div class="col">  
  <div class="card" style="width: 18rem;">
        <a href="DataLuogoPrezzo.tpl?nome={$results[nr].nome}" action="">
        <img class="card-img-top" src="{$results[nr].foto}" alt="Card image cap">
          </a>
          <div class="card-body">
            <p class="card-text">{$results[nr].nome}</p>
          </div>
      </div> 
    </div>
    </div>
  {/section}     
</div>

</body>

