<?php
	if(isset($_GET['error']))
		$destError=unserialize($_GET['error']);

?>
<div class="bg-faded">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-12">
				<form action="controller/add_controller.php" method="post" enctype="multipart/form-data" >
				<div class="row pt-5">
					<div class="col-lg-8 col-sm-8 col-8">
						<div class="form-group">
							<label for="artImage">Hírhez tartozó kép feltöltés</label>
							 <input type="file" class="form-control-file" id="imageFile" name="imageFile" aria-describedby="fileHelp">
							<small id="fileHelp" class="form-text text-muted">Minimum méret: 150x150 </small>
						</div>
					</div>
					<div class="col-lg-4 col-sm-4 col-4">
						<?php if(isset($destError['image'])) echo $destError['image']; ?>
					</div>
				</div>
				<div class="row  pt-5">
					<div class="col-lg-8 col-sm-8 col-8">
						<div class="form-group">
							<label for="articleTitle">Hír Címe</label>
							<textarea name="artTitle" class="form-control" id="articleTitle" rows="3"></textarea>
						</div>
					</div>
					<div class="col-lg-4 col-sm-4 col-4">
						<?php if(isset($destError['title'])) echo $destError['title']; ?>
					</div>
				</div>
				<div class="row pt-5">
					<div class="col-lg-8 col-sm-8 col-8">
						<div class="form-group">
							<label for="articleAttention">Figyelem felkeltő szöveg</label>
							<textarea name="artAttentionText" class="form-control" id="articleAttention" rows="3"></textarea>
						</div>
					</div>
					<div class="col-lg-4 col-sm-4 col-4">
						<?php if(isset($destError['attentionText'])) echo $destError['attentionText']; ?>
					</div>
				</div>
				<div class="row pt-5">
					<div class="col-lg-8 col-sm-8 col-8">
						<div class="form-group">
							<label for="articleText">Hír szöveg</label>
							<textarea name="artText" class="form-control" id="articleText" rows="10"></textarea>
						</div>
					</div>
					<div class="col-lg-4 col-sm-4 col-4">
						<?php if(isset($destError['text'])) echo $destError['text']; ?>
					</div>
				</div>
				<div class="row pt-5">
					<div class="col-lg-8 col-sm-8 col-8">
						<?php
							include "core/functions.php";
                            $themes = allThemes();
							foreach ($themes as $item){
                                $t = mb_convert_encoding($item['name'],"UTF-8");
							    echo '<div class="form-check form-check-inline">
										<label class="form-check-label">
										<input name="artThemes[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="'.$item['idTheme'].'"> '.$t.'
										</label>
									</div>';
							}
						?>
						<small class="form-text text-muted">Minimum egy témát kötelező választani!</small>
					</div>
					<div class="col-lg-4 col-sm-4 col-4">
						<?php if(isset($destError['thems'])) echo $destError['thems']; ?>
					</div>
				</div>
			
					<div class="row pt-5">
						<div class="col-lg-2 col-sm-2 col-2">
							<button class="btn btn-primary btn-block" type="submit">Feltölt</button>
						</div>
					</div>
					<div class="row pt-5">
						<div class="col-lg-12 col-sm-12 col-12">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>