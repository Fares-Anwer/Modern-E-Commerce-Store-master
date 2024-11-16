<?php require_once 'includes/header.php'; ?>
<?php require_once '../includes/sidebar_for_all.php'; ?>



<?php
// تخزين الصفحة الأصلية في الجلسة فقط إذا لم تكن محددة من قبل
if (!isset($_SESSION['original_page'])) {
	$_SESSION['original_page'] = "customer/my_account.php";
}

// التحقق إذا كان المستخدم مسجلاً الدخول
if (!isset($_SESSION['customer_email'])) {
	header('Location: ../checkout.php');
	exit();
}
?>


<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="../index.php">Home</a></li>
						<li class="breadcrumb-item" aria-current="page">My Account</li>
					</ol>
				</nav>
			</div>

			<div class="col-md-12">
				<?php
				$customer_session = $_SESSION['customer_email'];
				$get_customer = $getFromU->view_customer_by_email($customer_session);

				$customer_confirm_code = $get_customer->customer_confirm_code;
				?>

				<?php if (empty($customer_confirm_code)): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Please confirm your email. If you do not received your email
						<a href="my_account.php?send_email" class="alert-link">Send Email Again</a>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>


				<?php if (isset($_SESSION['customer_confirm_msg'])): ?>
					<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
						<?php echo $_SESSION['customer_confirm_msg'];
						unset($_SESSION['customer_confirm_msg']); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>

				<?php if (isset($_SESSION['success_msg'])): ?>
					<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
						<?php echo $_SESSION['success_msg'];
						unset($_SESSION['success_msg']); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>

				<?php if (isset($_SESSION['error'])): ?>
					<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
						<?php echo $_SESSION['error'];
						unset($_SESSION['error']); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>



			</div>

			<div class="col-md-3">
				<?php require_once 'includes/sidebar.php'; ?>
			</div>

			<div class="col-md-9">
				<?php if (isset($_SESSION['login_success_msg'])): ?>
					<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
						<?php echo $_SESSION['login_success_msg'];
						unset($_SESSION['login_success_msg']); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>

				<?php
				if (isset($_GET['confirm_code'])) {
					$customer_confirm_code = $_GET['confirm_code'];
					$update_customer = $getFromU->update_customer_confirm_code($customer_confirm_code);

					if ($update_customer) {
						$_SESSION['customer_confirm_msg'] = "Your Email has been Confirm";
						header('Location: my_account.php?my_orders');
					}
				}

				if (isset($_GET['send_email'])) {
					$customer_email = $_SESSION['customer_email'];

					$view_customer = $getFromU->view_customer_by_email($customer_email);
					$customer_name = $view_customer->customer_name;
					$customer_confirm_code = $view_customer->customer_confirm_code;

					$message = '<h1 class="text-center">Email Confirmation From ART-FOR-ALL</h1> ';
					$message .= '<h2 class="text-center">Dear ' . $customer_name . '</h2> ';
					$message .= '<h3 class="text-center"><a href="localhost/ecommerce/customer/my_account.php?confirm_code=' . $customer_confirm_code . '">Click Here To Confirm Email</a></h3> ';

					$subject = 'Confirm Email';
					// $message = $message;
					$headers =  'MIME-Version: 1.0' . "\r\n";
					$headers .= 'From: eCommerce Admin <info@address.com>' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					if (mail($customer_email, $subject, $message, $headers)) {
						$_SESSION['success_msg'] = "Your Confirmation Link has been Sent to your Email";
						header('Location: my_account.php?my_orders');
					} else {
						$_SESSION['error'] = "Email not Sent";
					}
				}




				if (isset($_GET['my_orders'])) {
					require_once 'includes/my_orders.php';
				}
				if (isset($_GET['pay_offline'])) {
					require_once 'includes/pay_offline.php';
				}
				if (isset($_GET['edit_account'])) {
					require_once 'includes/edit_account.php';
				}
				if (isset($_GET['change_pass'])) {
					require_once 'includes/change_pass.php';
				}
				if (isset($_GET['delete_account'])) {
					require_once 'includes/delete_account.php';
				}

				if (isset($_GET['wishlist'])) {
					require_once 'includes/wishlist.php';
				}

				?>
			</div>



		</div>
	</div>
</div>

<?php require_once 'includes/footer.php'; ?>