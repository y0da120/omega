$(document).ready(function(){
  if(document.getElementsByClassName("delete-news")){
	var btns = document.getElementsByClassName("delete-news");
    for(var i=0; i<btns.length; ++i)
      btns[i].onclick = function() {deleteBtn(this)}; 
  }
});
function deleteBtn(clicked_object) {
	  var newsId = clicked_object.getAttribute("data-news-id");
	  console.log(newsId);
	    $.ajax({
                method: 'POST',
                url: 'controller/delete_article.php',
				data: { nId: newsId },
                success: function(data){
					alert(data);
				},	
				error: function(data){
					alert(data);
				}	
            });
} 