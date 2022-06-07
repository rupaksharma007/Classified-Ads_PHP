<?php require 'header.php'; ?>

	<div class="content" style="padding:0;margin:0;">
		<div id="container" style="padding-top: 100px;">
			<div class="head-title"><?php echo $ob->setTitle();?></div>
			<div class="list-type-holder"> 
				<ul>
					<li><span>SORT BY :</span></li>
					<li><a href="?orderby=date" <?php echo (!isset($_GET['orderby']) || $_GET['orderby']=='date') ? 'class="active"' : '' ;?>>DATE</a></li>
					<li><a href="?orderby=title" <?php echo (isset($_GET['orderby']) && $_GET['orderby']=='title') ? 'class="active"' : '' ;?>>TITLE</a></li>
					<li><a href="?orderby=price" <?php echo (isset($_GET['orderby']) && $_GET['orderby']=='price') ? 'class="active"' : '' ;?>>PRICE</a></li>
				</ul>
			</div>
			<div class="ads-wrapper-container">
				<div class="ads-wrapper">

					<?php
					if(!empty($ob->display())){
						$query = $ob->display();
						while($ads = $query->fetch_assoc()){
							$thumb = json_decode($ads['images'])[0];
							echo '
								<div class="ad-container ad-hidden">
									<div class="thumb">
										<div class="img">
											<a href="/view/'.$ads['id'].'/'.urlencode($ads['title']).'"><img src="'.$thumb.'"></a>
										</div>
										<a href="/all-ads/'.$ads['user_id'].'"><img src="'.$ob->user2dp($ads['user_id']).'" class="seller-dp"></a>
									</div>
									<div class="type"> <a href="/list/'.$ads['cat_id'].'">'.$ob->cat_id2name($ads['cat_id']).'</a></div>
									<a href="/view/'.$ads['id'].'/'.urlencode($ads['title']).'"><div class="title">'.$ads['title'].'</div></a>
									<div class="address"><img src="/assets/icons/location.svg" class="icon-small"> '.$ads['address'].' </div>
									<div class="price">₹​ '. number_format($ads['price'],2,'.',',') .' /-</div>
								</div>
							';
						}
					}
					else{
						echo '<h3 style="color:#66a80f;">No Data Found !</h3>';
					}
				?>

				</div>
			</div>
		</div>
	</div>

<?php require 'footer.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		//navigation scroll function
		$(window).scroll(function(){
		    if($(this).scrollTop()>=50){
		        $("nav").css({"background-color":"#FFF"});
		    }
		    else{
		    	$("nav").css({"background-color":"rgba(255, 255, 255, 0.1)"});
		    }
		});
		//ads loading animation on scroll
		function apperance(_this,i) {
		    setTimeout(function() { 
		    	$(_this).removeClass("ad-hidden"); 
		    }, 100 + i * 300);
		}

		function checkLoad(){
			var scrTop = $(this).scrollTop()+$(this).height();
			$(".ad-hidden").each(function(index){
				if(scrTop > $(this).offset().top){
					apperance(this,index);
				}
		    });
		}

		checkLoad();

		$(window).scroll(function(){
			checkLoad();
		});
	});
	$(window).on("load", function(){
		//$(".preloader").fadeOut("slow");
		setTimeout(function(){ 
			$(".preloader").fadeOut("slow");
			$(".landing-page").addClass("bg-animation");
			$(".top-form-wrapper").addClass("form-animation");
			$(".slogans h1").addClass("slogan-h1-animation");
			$(".slogans h2").addClass("slogan-h2-animation");
		}, 1000);
	});
</script>