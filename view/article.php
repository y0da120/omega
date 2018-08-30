<?php include "controller/read_controller.php"; ?>
<div class="bg-faded">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-12">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-12 text-center">
						<img src="<?php echo $imageDest; ?>"  class="img-fluid pt-3 img-article" alt="Article image">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-12">
						<h2 class="pt-3"><?php echo $row['title']; ?></h2>
					</div>
				</div>
				<div class="row pt-2">
					<div class="col-lg-2 col-sm-2 col-2">
						<img src="images/user-image.jpg" class="rounded-circle" width="20px"> 
						<span class="text-info"><?php echo $row['name']; ?></span>
					</div>
					<div class="col-lg-10 col-sm-10 col-10">
						<i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo $row['create_date']; ?></span>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12 col-sm-12 col-12">
						<p class="text-justify">
							<strong><?php echo $row['attention_text']; ?></strong>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-12">
						<p class="text-justify"><?php echo $row['content']; ?> </p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-12">
						<li class="list-inline-item">
							<i class="fa fa-tags" aria-hidden="true"></i>
							<span>Tagek:</span>
						<?php echo $tags; ?>
					  </li>
					   <li class="list-inline-item float-right">
							<strong class="d-inline-block mb-2 pr-3 text-muted">Érdekes: 
                            <span class="ic"><?php echo $row['interestedSum']==0 ? ' '.$interestSum  : sprintf("%+d",$interestSum ); ?> </span></strong>
							<strong class="d-inline-block mb-2 pr-3 text-muted">Korrekt: 
                            <span class="ic"><?php echo $row['correctSum']==0 ? ' '. $correctSum : sprintf("%+d", $correctSum); ?> </span></strong>
					</li>
					</div>
				</div>
				<?php if(isset($_SESSION['login_id'])){ 
				$interestedBtns='
				<div class="row text-right">
					<div class="col-lg-12 col-sm-12 col-12 ">
						<button class="btn btn-outline-info btn-sm mr-3" id="like-btn"><span class="fa fa-thumbs-up"></span> Érdekel</button>	
						<button class="btn btn-outline-info btn-sm" id="dislike-btn"><span class="fa fa-thumbs-down"></span> Nem érdekel</button>
					</div>
				</div>';
				$correctBtns='
				<div class="row text-right pt-2">
					<div class="col-lg-12 col-sm-12 col-12 ">
						<button class="btn btn-outline-info btn-sm mr-3" id="correct-btn"><span class="fa fa-thumbs-up"></span> Korrekt</button>	
						<button class="btn btn-outline-info btn-sm" id="wrong-btn"><span class="fa fa-thumbs-down"></span> Nem korrekt</button>
					</div>
				</div>';
				$interestedTextPositive = '<span class="fa fa-thumbs-up"> Érdekelt</span>';
				$interestedTextNegativ = '<span class="fa fa-thumbs-down"> Nem érdekelt</span>';
				$correctTextPositiv = '<span class="fa fa-thumbs-up"> Korrektnek tartod</span>';
				$correctTextNegativ = '<span class="fa fa-thumbs-down"> Nem tartod korrektnek</span>';
				$baseBegin = '<div class="row text-right pt-2">
					<div class="col-lg-12 col-sm-12 col-12 ">';
				$baseEnd ='</div></div>';
				$baseMiddleCorrect= $showRateCorrect ==1 ? $correctTextPositiv :  $correctTextNegativ ;
				$baseMiddleInterested= $showRateInterest ==1 ? $interestedTextPositive :  $interestedTextNegativ ;				
				if(	$showRateInterest== 0 && $showRateCorrect==0){
					echo $interestedBtns.$correctBtns;
				}
				elseif ($showRateInterest== 0 && $showRateCorrect!=0 ){
					echo $interestedBtns.$baseBegin.$baseMiddleCorrect.$baseEnd;
				}
				elseif ($showRateInterest!= 0 && $showRateCorrect==0 ){;
					echo $correctBtns.$baseBegin.$baseMiddleInterested.$baseEnd;
				}			
				elseif ($showRateInterest!= 0 && $showRateCorrect!=0 ){
					echo $baseBegin.$baseMiddleInterested.$baseEnd;
					echo $baseBegin.$baseMiddleCorrect.$baseEnd;
				}
				} ?>

			</div>
		</div>
        <!--- comemnts -->
        <?php include "view/comments.php"; ?>
	</div>
</div>
<script>
if(document.getElementById("like-btn")){
	document.getElementById("like-btn").onclick = function() {rateBtn("like-btn","dislike-btn")};
}
if(document.getElementById("dislike-btn")){
	document.getElementById("dislike-btn").onclick = function() {rateBtn("dislike-btn","like-btn")};
}
if(document.getElementById("correct-btn")){
	document.getElementById("correct-btn").onclick = function() {rateBtn("correct-btn","wrong-btn")};
}
if(document.getElementById("wrong-btn")){
	document.getElementById("wrong-btn").onclick = function() {rateBtn("wrong-btn","correct-btn")};
}

function rateBtn(id,disId) {
	  document.getElementById(id).disabled = true;
	  document.getElementById(disId).style.display = 'none';
	  var userId = <?php if(isset($_SESSION['login_id']))echo $_SESSION['login_id']; ?> ;
	  var articleId =<?php echo $_GET['news-id']; ?>; 
      var tagIds = [];
      var tmp = document.getElementsByClassName("theme");
   	  for (i = 0; i < tmp.length; i++) { 
    	tagIds[i] = tmp[i].getAttribute("data-tag-id");
	 }   
     var themesIds 
     console.log(userId);
     console.log(articleId);
	    $.ajax({
                method: 'POST',
                url: 'controller/rate_controller.php',
				data: { uId: userId, aId : articleId, rate : id, themeIds : tagIds },
				error: function(data){
					alert(data);
				}	
            });
}
    
</script>