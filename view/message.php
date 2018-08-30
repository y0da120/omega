<!-- Modal -->
  <div class="modal fade" id="messageModal" role="dialog">
    <div class="modal-dialog modal-sm">
		  <?php 
		  if(isset($_SESSION['login_error']))
			  echo '<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			<strong>Hibás bejentkezés!</strong>
			</div>';
		  elseif(isset($_SESSION['reg_error']))
			echo '<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			<strong>Hibás regisztráció!</strong>
			</div>';
		  elseif(isset($_SESSION['reg_succes']))
			echo '<div class="alert alert-success" role="alert">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			 <span aria-hidden="true">&times;</span>
			</button>
			<strong>Sikeres regisztráció!</strong>
			</div>';
		  ?>
 
      </div>
    </div>
  </div>
<script>
$("#messageModal").modal('show');
</script>