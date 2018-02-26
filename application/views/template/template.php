<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Podomoro University</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('images/icon/favicon.png'); ?>">


    <?php echo $include; ?>

</head>

<body>

	<?php echo $header; ?>

	<div id="container">
		<?php echo $navigation; ?>
		<!-- <div id="navigation">

		</div> -->

		<div id="content">
			<div class="container" style="position:relative;">
				<!-- Breadcrumbs line && Page Header -->
				<?php echo $crumbs; ?>
				<!-- /Breadcrumbs line && /Page Header -->


				<!--=== Page Content ===-->
				<?php echo $content; ?>

<!--                <div style="position: absolute;-->
<!--                    right: 0;-->
<!--                  bottom: 0px;-->
<!--                  left: 0;text-align: center;">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12">-->
<!---->
<!--                            <p style="border-top: 1px solid #ccc;padding-top: 10px;font-style: italic;">-->
<!--                                --- IT PU, We Made With-->
<!--                                <i class="fa fa-heart" style="color: red;" aria-hidden="true"></i> And-->
<!--                                <i class="fa fa-coffee bs-tooltip" aria-hidden="true"  data-placement="top"-->
<!--                                   data-original-title="udah pada ngopi belon? diem diem bae"></i> ----->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

			</div>
			<!-- /.container -->

		</div>
	</div>

</body>
</html>
