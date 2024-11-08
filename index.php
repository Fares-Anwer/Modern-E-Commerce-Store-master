<?php require_once 'includes/header.php'; ?>

		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="navbar">
		  <a class="navbar-brand home" href="#">Navbar</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto text-uppercase">
		      <li >
		        <a class="active" href="index.php">Home</a>
		      </li>
		      <li>
		        <a href="shop.php">Shop</a>
		      </li>
		      <?php if (!isset($_SESSION['customer_email'])): ?>
						<li><a href="checkout.php">My Account</a></li>
					<?php else: ?>
						<li><a href="customer/my_account.php?my_orders">My Account</a></li>
					<?php endif ?>
		      <li>
		        <a href="cart.php">Shopping Cart</a>
		      </li>
		      <li>
		        <a href="contact.php">Contact Us</a>
		      </li>
		      <li>
		        <a href="about.php">About Us</a>
		      </li>
		      <li>
		        <a href="services.php">Services</a>
		      </li>
		    </ul>
					<a href="cart.php" class="btn btn-success mr-2"><i class="fas fa-shopping-cart"></i><span> <?php echo $getFromU->count_product_by_ip($ip_add); ?> items in Cart</span></a>

		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="user_query" required="1">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
		    </form>
		  </div>
		</nav>


		<div class="container-fluid px-0" id="slider">
			<div class="row">
				<div class="col-md-12">
				  <!-- carousel slide starts -->
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
					    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
					  </ol>
					  <div class="carousel-inner">
					  	<?php
					  		$slides = $getFromU->selectSlide1();
					  		foreach ($slides as $slide) {
					  			$slide_image = $slide->slide_image;
					  			$slide_name  = $slide->slide_name;
					  			$slide_title  = $slide->slide_title;
					  			$slide_text  = $slide->slide_text;
					  			$slide_url  = $slide->slide_url;
					  	?>
					  	 <div class="carousel-item active">
					      <a href="<?php echo $slide_url; ?>" target="_blank"><img class="d-block w-100 img-fluid" src="admin_area/slides_images/<?php echo $slide_image; ?>" alt="<?php echo $slide_name; ?>"></a>
					      <div class="carousel-caption d-none d-md-block">
							    <h5><?php echo $slide_title; ?></h5>
							    <p><?php echo $slide_text; ?></p>
							  </div>
					    </div>

							<?php } ?>

							<?php
					  		$slides = $getFromU->selectSlideAll();
					  		foreach ($slides as $slide) {
					  			$slide_image = $slide->slide_image;
					  			$slide_name  = $slide->slide_name;
					  			$slide_title  = $slide->slide_title;
					  			$slide_text  = $slide->slide_text;
					  			$slide_url  = $slide->slide_url;
					  	?>
					  	 <div class="carousel-item">
					      <a href="<?php echo $slide_url; ?>" target="_blank"><img class="d-block w-100 img-fluid" src="admin_area/slides_images/<?php echo $slide_image; ?>" alt="<?php echo $slide_name; ?>"></a>
					      <div class="carousel-caption d-none d-md-block">
							    <h5><?php echo $slide_title; ?></h5>
							    <p><?php echo $slide_text; ?></p>
							  </div>
					    </div>
							<?php } ?>

					  </div>

					  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
					<!-- carousel slide ends -->
				</div>
			</div>
		</div>


		<div class="container mt-4 advantages"> <!-- advantages starts -->
			<div class="row">
				<?php
					$view_boxes = $getFromU->viewAllFromTable('boxes_section');
					foreach ($view_boxes as $view_box) {
						$box_title = $view_box->box_title;
						$box_desc = $view_box->box_desc;
				?>

				<div class="col-sm-4">
					<div class="card">
					  <div class="card-body text-center">
					    <h5 class="card-title text-uppercase text-info"><?php echo $box_title; ?></h5>
					    <p class="card-text"><?php echo $box_desc; ?></p>
					  </div>
					</div>
				</div>

				<?php } ?>

			</div>
		</div> <!-- advantages ends -->


		<div id="hot">
			<div class="container-fluid mt-4 px-0">
				<div class="row">
					<div class="col-12">
						<h2 class="p-4 bg-light text-center text-uppercase">Latest this week</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="container" id="content">
			<div class="row">

				<?php
					$getProducts         = $getFromU->selectLatestProduct();
					foreach ($getProducts as $getProduct) {
						$product_id        = $getProduct->product_id;
						$product_title     = $getProduct->product_title;
						$product_price     = $getProduct->product_price;
						$product_img1      = $getProduct->product_img1;
						$product_label     = $getProduct->product_label;
						$manufacturer_id   = $getProduct->manufacturer_id;
						$product_psp_price = $getProduct->product_psp_price;
						$product_url       = $getProduct->product_url;

						$view_manufacturer = $getFromU->selectManufacturerByManufacturerID($manufacturer_id);
						$manufacturer_title = $view_manufacturer->manufacturer_title;

						if ($product_label == "Sale" || $product_label == "Gift") {
							$product_price = "<del>$$product_price</del>";
							$product_psp_price = "<i class='fas fa-long-arrow-alt-right'></i> $$product_psp_price";
						}else{
							$product_price = "$$product_price";
							$product_psp_price = "";
						}
				?>

				<div class="col-sm-6 col-md-4 col-lg-3 single">
					<div class="product mb-4">
						<div class="card rounded">
						  <a href="details.php?product_id=<?php echo $product_id; ?>"><img class="card-img-top img-fluid px-4 pt-4 rounded" src="admin_area/product_images/<?php echo $product_img1; ?>" alt="Card image cap"></a>
						  <div class="card-body text-center">
						  	<p class="btn btn-sm btn-info mb-0">Mnf By : <?php echo $manufacturer_title; ?></p><hr>
						    <h6 class="card-title"><a href="details.php?product_id=<?php echo $product_id; ?>"><?php echo $product_title; ?></a></h6>
						    <p class="card-text"><?php echo $product_price; ?> <?php echo $product_psp_price; ?></p>
						    <div class="row">
									<div class="col-md-6  pr-1 pb-2">
										<a href="details.php?product_id=<?php echo $product_id; ?>" class="btn btn-outline-info form-control">Details</a>
									</div>
									<div class="col-md-6  pr-3">
										<a href="details.php?product_id=<?php echo $product_id; ?>" class="btn btn-success form-control"><i class="fas fa-shopping-cart"></i> Add</a>
									</div>
								</div>
						  </div>
						</div>
					</div>

					<?php if (!empty($product_label)): ?>
						<a class="label sale" style="color: black">
							<div class="thelabel"><?php echo $product_label; ?></div>
							<div class="label-background"></div>
						</a>
					<?php endif ?>

				</div> <!-- SINGLE PRODUCT END -->

				<?php } ?>





			</div>
		</div>


		<?php require_once 'includes/footer.php'; ?>

