<!DOCTYPE html>
<html>
<head>
<style type="text/css">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.header {
  background-color: #282828;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
}
@media (max-width: 594.98px) {
  .header {
    padding: 20px;
  }
}
@media (min-width: 595px) and (max-width: 991.98px) {
  .header {
    padding: 20px 50px;
  }
}
@media (min-width: 992px) {
  .header {
    padding: 20px 100px;
  }
}
@media (min-width: 1240px) {
  .header {
    padding: 20px 150px;
  }
}
.header__nav {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.nav__list {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 40px;
  list-style: none;
}
@media (max-width: 594.98px) {
  .nav__list {
    flex-direction: column;
  }
}
@media (max-width: 594.98px) {
  .nav__item {
    flex: 1 1 calc(100% - 40px);
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
}
.nav__link {
  font-family: sans-serif;
  font-size: 18px;
  color: white;
  text-decoration: none;
  cursor: pointer;
}
.nav__link:hover {
  opacity: 0.8;
}
.product-card {
  margin: 0.4rem 0;
}

.card {
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>
<body>
<header class="header">
	<nav class="header__nav nav">
		<ul class="nav__list">
			<li class="nav__item">
				<a href="<?php echo base_url('products'); ?>" class="nav__link">Products Bidding</a>
			</li>
			<li class="nav__item">
				<a href="<?php echo base_url('products/list'); ?>" class="nav__link">Products List</a>
			</li>
			
			
		</ul>
	</nav>
	<span  style="color:white">Hello! <?php echo $this->session->userData('name'); ?></span>
	<button class="btn btn-primary" style="color:red" ><a href ="<?php echo base_url('logout'); ?>">Logout<a/></button>
</header>


