<?php

include('header.php');

include('slidebar.php');

$objproduct=new Product();

$objcate=new Category();


if(isset($_GET['page'])){
	$page=$_GET['page'];
}else{
	$page=1;
}
$max_result=10;
$index_row=$max_result*$page-$max_result;

if (isset($_GET['catid'])) {
	$where=array();
	$catid=$_GET['catid'];
	$where[]='a.cat_id='.$catid;
	$where[]='pro_status=1';
	
	$cate=$objcate->showListCateid($catid);
	$row=$objproduct->listProduct($where);
	$list=$objproduct->listProduct($where,null,$index_row,$max_result);
}else{
	$where=' where pro_status=1';
	$list=$objproduct->listProduct($where,null,$index_row,$max_result);
	$row=$objproduct->listProduct(' where pro_status=1');
}

// echo "<pre>";
// print_r($cate);

?>
<!-- <script type="text/javascript">
	function submitform() {
		var order=$('.order').val();
		console.log(order);
		$('#myform').submit();
		$('.order').attr('selected','selected');
	}
</script> -->
<div class="span9">
	<ul class="breadcrumb">
		<li><a href="index.php">Trang chủ</a> <span class="divider">/</span></li>
		<li><a href="products.php">Sản phẩm</a> <span class="divider">/</span></li>
		<li class="active">
			<?php 
			if(isset($_GET['catid'])){
				if(empty($list)){
					echo $cate['cat_name'];
				}else{
					echo $list[0]['cat_name'];
				}
			}else{
				echo 'Tất cả sản phẩm';
			} 
			?>
			
		</li>
	</ul>
	<h3> 
		<?php 
		if(isset($_GET['catid'])){
			if(empty($list)){
				echo $cate['cat_name'];
			}else{
				echo $list[0]['cat_name'];
			}
		}else{
			echo 'Tất cả sản phẩm';
		} 
		?> 
		<small class="pull-right"> <?=count($row);?> sản phẩm có sẵn </small>
	</h3>
	<hr class="soft"/>
	<div id="myTab" class="pull-right" style="margin-bottom:20px;">
		<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
		<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
	</div>
	<br class="clr"/>
	<div class="tab-content">
		<div class="tab-pane" id="listView">
			<?php
			foreach ($list as $key => $value) {
				?>
				<div class="row">
					<div class="span2">
						<div class="tag1"></div>
						<img src="hinhanh/<?=$value['pro_image']; ?>" alt=""/>
					</div>
					<div class="span4">
						<h3>Có sẵn</h3>				
						<hr class="soft"/>
						<h5><?=$value['pro_name']; ?> </h5>
						<p>
							
						</p>
						<a class="btn btn-small pull-right" href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>">View Details</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
						<form class="form-horizontal qtyFrm">
							<?php
							if($value['pro_discount']==0){
								?>
								<h3><?php echo number_format($value['pro_price']); ?> VNĐ </h3>
								<?php
							}else{
								?>
								<h3><?php echo number_format($value['pro_price']-$value['pro_discount']); ?> VNĐ </h3>
								<h4 style="text-decoration:line-through;"><?php echo number_format($value['pro_price']); ?> VNĐ</h4>
								<?php
							}
							?>
							<br/>
							<?php
							if($value['pro_quantity']>0){
								?>
								<a href="addcart.php?proid=<?php echo $value['pro_id']; ?>" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
								<?php
							}else{
								?>
								<a class="btn btn-large btn-primary"> Hết hàng</i></a>
								<?php
							}
							?>
							<a href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>" class="btn btn-large"><i class="icon-zoom-in"></i></a>

						</form>
					</div>
				</div>
				<hr class="soft"/>
				<?php
			}
			?>
			
		</div>

		<div class="tab-pane active" id="blockView">
			<ul class="thumbnails">
				<?php
				foreach ($list as $key => $value) {

					?>
					<li class="span3">
						<div class="thumbnail">
							<div class="tag"></div>
							<a href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>"><img src="hinhanh/<?php echo $value['pro_image']; ?>" alt=""/></a>
							<div class="caption">
								<h5><?php echo $value['pro_name']; ?></h5>
								<p> 
									
								</p>
								<h4 style="text-align:center">
									<a class="btn" href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>"> 
										<i class="icon-zoom-in"></i>
									</a>
									<?php
									if($value['pro_quantity']>0){
										?>
										<a class="btn" href="addcart.php?proid=<?php echo $value['pro_id']; ?>">Add to <i class="icon-shopping-cart"></i>
										</a>
										<?php
									}else{
										?>
										<a class="btn"> Hết hàng</i></a>
										<?php
									}
									?>
									<?php
									if($value['pro_discount']==0){
										?>
										<a class="btn btn-primary" href="#"><?php echo number_format($value['pro_price']); ?></a>
										<?php 
									}else{
										?>
										<a class="btn btn-primary" href="#"><?php echo number_format($value['pro_price']-$value['pro_discount']); ?>
										</a>
										<a class="btn btn-primary" style="text-decoration:line-through;" href="#"><?php echo number_format($value['pro_price']); ?>
										</a>
										<?php } ?>
									</h4>
								</div>
							</div>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>

		<div class="pagination">
			<ul>
				<?php
				$total_row=count($row);
				$total_page=ceil($total_row/$max_result);
				if (isset($_GET['page']) && ($_GET['page']>1)) {
					if(isset($_GET['catid'])){
						echo "<li><a href=".$_SERVER['PHP_SELF']."?catid=".$_GET['catid']."&page=".($_GET['page']-1).">&lsaquo;</a></li>";
					}else{
						echo "<li><a href=".$_SERVER['PHP_SELF']."?page=".($_GET['page']-1).">&lsaquo;</a></li>";
					}
				}
				for ($i=1; $i <= $total_page ; $i++) { 
					if ($page==$i) {
						echo "<li class='active'><a>$i</a></li>";
					}else{
						if(isset($_GET['catid'])){
							echo "<li ><a href=".$_SERVER['PHP_SELF']."?catid=".$_GET['catid']."&page=$i>$i</a></li>";

						}else{
							echo "<li ><a href=".$_SERVER['PHP_SELF']."?page=$i>$i</a></li>";

						}
					}
				}
				if ((!isset($_GET['page']))) {
					if(isset($_GET['catid']) && $total_row > $max_result){
						echo "<li><a href=".$_SERVER['PHP_SELF']."?catid=".$_GET['catid']."&page=2>&rsaquo;</a></li>";
					}elseif(!isset($_GET['catid'])){
						echo "<li><a href=".$_SERVER['PHP_SELF']."?page=2>&rsaquo;</a></li>";
					}
				}elseif(isset($_GET['page']) && $_GET['page']<$total_page ){
					if(isset($_GET['catid'])){
						echo "<li><a href=".$_SERVER['PHP_SELF']."?catid=".$_GET['catid']."&page=".($_GET['page']+1).">&rsaquo;</a></li>";
					}else{
						echo "<li><a href=".$_SERVER['PHP_SELF']."?page=".($_GET['page']+1).">&rsaquo;</a></li>";
					}
				}
				?>
			</ul>
		</div>
		<br class="clr"/>
	</div>
	<?php

	include('footer.php');

	include('themes_section.php');

	?>