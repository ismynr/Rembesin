<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/web_config/'.$this->config->item('FAVICON').'') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="HTML, CSS, XML, XHTML, JavaScript">
  <meta name="description" content="<?= $this->config->item('DESKRIPSI') ?>">
  <meta name="author" content="">

  <title><?= $this->config->item('SITE_NAME') ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">

  <!-- Custom fonts for this template -->
  <link href="<?= base_url('assets/fontawesome-free/css/all.min.css"') ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="<?= base_url ('assets/css/landing.css') ?>"  rel="stylesheet">
  <style>
      .card.card-image {
          height: 230px;
          background-size: cover;
          background-position: center;
          width: 100%;
      }
      .card.card-image [class*="rgba-"] {
          border-radius: .25rem;
      }
      .rgba-black-strong, .rgba-black-strong::after {
          background-color: rgba(0,0,0,.7);
      }
      </style>
</head>