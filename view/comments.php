<?php  include "controller/read_comment_controller.php"?>
<div class="row pt-5 pb-3">
    <div class="col-lg-12 col-sm-12 col-12">
        <h2 class="pb-3"><?php if($count==0 )echo "Nincs hozzászólás";
                                else echo "Hozzászólások ".$count;?></h2>
        <?php echo $output; 
        if(isset($_SESSION['login_id'])) {
            $form='    <div class="row pt-3 mt-2 ">
        <div class="col-lg-10 offset-lg-1 col-sm-10 offset-sm-1  col-10 offset-1">
			<form action="controller/add_comment_controller.php?idNews='.$_GET["news-id"].'" method="post">
                <div class="form-group">
                    <label for="commentArea"><strong>Saját hozzászólás</strong></label>
                    <textarea class="form-control" id="commentextArea" name="commentText" rows="5" placeholder="Szólj hozzá"></textarea>
                     <button class="btn btn-primary mt-2" type="submit">Hozzászól</button>
              </div>
                
            </form>       
        </div>
        </div>' ;
                echo $form; }?>
    
    </div>
</div>

        