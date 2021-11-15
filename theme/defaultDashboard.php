<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= _page_title ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?=baseUrl()?>/asset/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=baseUrl()?>/asset/css/theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?=baseUrl()?>/asset/css/theme_dashboard.min.css">

    <!-- jQuery fitst, then Bootstrap JS. -->
    <script type="text/javascript" src="<?=baseUrl()?>/asset/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?=baseUrl()?>/asset/js/jquery.form.min.js"></script>
    <script type="text/javascript" src="<?=baseUrl()?>/asset/js/tether.min.js"></script>
    <script type="text/javascript" src="<?=baseUrl()?>/asset/js/bootstrap.min.js"></script>

  </head>
  <body>
    <? require_once('header.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar mt-lg-0 mt-md-5 mt-sm-5">

          <?if($activePage == 'uniReviews'){?>
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link color_primary active_primary">نظرات کاربران<span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <?}?>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link color_primary <?if($activePage == 'home'){?>active_primary<?}?>" href="<?=baseUrl()?>/page/home"><?if(isAdmin()){echo('لیست دانشکده ها');}else{echo('دانشکده های من');}?><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link color_primary <?if($activePage == 'addUni' || $activePage == 'editUni'){?>active_primary<?}?>" href="<?=baseUrl()?>/page/addUni"><?if($activePage == 'editUni'){echo('ویرایش دانشکده');}else{echo('افزودن دانشکده');}?></a>
            </li>
          </ul>

          <?if(isAdmin()){?>
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link color_primary <?if($activePage == 'accountsManagement'){?>active_primary<?}?>" href="<?=baseUrl()?>/page/accountsManagement">مدیریت حساب های کاربری</a>
            </li>
            <li class="nav-item">
              <a class="nav-link color_primary <?if($activePage == 'registerUser'){?>active_primary<?}?>" href="<?=baseUrl()?>/account/register">ایجاد حساب کاربری</a>
            </li>
          </ul>
          <?}?>

          <?if(isSuperAdmin()){?>
            <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                <a class="nav-link color_primary <?if($activePage == 'mainImageSlider'){?>active_primary<?}?>"  href="<?=baseUrl()?>/page/mainImageSlider">اسلاید تصاویر صفحه اصلی</a>
              </li>
              <li class="nav-item">
                <a class="nav-link color_primary <?if($activePage == 'feedback'){?>active_primary<?}?>"  href="<?=baseUrl()?>/page/feedback">بازخورد کاربران</a>
              </li>
            </ul>
          <?}?>

        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pr-3 pt-3 pl-3" id="dashboardMain">
          <div id="content"><?=$content?></div>
        </main>
      </div>
    </div>

    <? require_once('footer.php'); ?>
  </body>
</html>