@extends("templates/defaultPage")

@section("breadcrumb")
	<li><a href='/home'>Home</a></li>
	<li><a href='/books/'>Books</a></li>
	<li>{{$book->title}}</li>
@endsection

@section("scripts")

<script type="text/javascript">
//TODO: hedgehog this off into its own file
	$(document).ready(function(){
		document.bookId = {{$book->id}};
		
		$(".leaf").each(function(){
			$(this).css("left", $(this).attr("xPos")+"px");
			$(this).css("top", $(this).attr("yPos")+"px");
			addEvents($(this));
		});

		

		$(".newLeaf").click(function( event ){
			var leafColor = $(this).attr("leafcolor");
			newLeaf(document.bookId, leafColor, event.clientX, event.clientY);
			return false;
		});
	});


	function newLeaf( bookId, leafStyle, posX, posY){
		var leafStyleIds = {"yellow":1, "blue":2, "green":3};
		console.log(leafStyle+":"+leafStyleIds[leafStyle]);
		var response = $.ajax({url: "/api/books/"+bookId+"/leaves", "style":leafStyleIds[leafStyle], type:"GET", success:
			function(result, status, xhr){
			var leaf = renderLeaf(result.id, result.style_id);
			posX = posX - leaf.width();
			leaf.css({left: posX, top: posY});			
			saveLeaf( $(leaf).attr("leafId") );
		}});
		return false;
	}

	function renderLeaf(leafId, styleId, content=""){
		var ticket = $("ul.leaves").prepend("<li id='leaf"+leafId+"' leafId='"+leafId+"' id='leaf"+leafId+"' xPos=0 yPos=0 class='yellow leaf ui-widget-content'><a href='#' class='deleteLink'>X</a><div class='content'><textarea>"+content+"</textarea></div></li>");
		var leaf =$('#leaf'+leafId); 
		addEvents( leaf );
		return ( leaf );
	}

//Add JS events to a newly created Leaf entity
	function addEvents( leaf ){
		//Make draggable
		$(leaf).draggable({scroll:true, stack:"#set div"});
		// Delete link
		$(leaf).find("a.deleteLink").click(function(){
			deleteLeaf($(this).parents("li").first().attr("leafId"));
			return false;
		});
		//Save on losing focus of textarea
		$(leaf).find("textarea").focusout(function(){
			saveLeaf($(this).parents("li.leaf").first().attr("leafId"));			
		});		
		//Save on moving
		$(leaf).mouseup(function(){
			saveLeaf( $(leaf).attr("leafId") );
		}); 

	}

	function saveLeaf( leafId ){
		var leaf = $("#leaf"+leafId);
		var bookId = $(document).bookId;
		$.ajax({url:"/api/books/"+bookId+"/leaves/"+$(leaf).attr("leafId"), data:{ 
			xPos: $(leaf).position().left, 
			yPos: $(leaf).position().top, 
			content:$(leaf).find("textarea").first().val() }, type:"POST", success:function(result, status, xhr){
		}});

	}

	function deleteLeaf(leafId){
		console.log("deleting "+leafId);
		var leaf = $("#leaf"+leafId);
		var response = $.ajax({
				url:"/api/books/1/leaves/"+leafId, 
				type:"POST", 
				data:{ _method:"DELETE"}, 
				success: function(result, status, xhr){
					$("#leaf"+result.id).remove();
				}
			});
	}



</script>

@endsection

@section("title")
	- {{ $book->name}}
@endsection


@section("mainContent")
<div class='board'>
<div id='controls'>
	<a class='newLeaf yellow' 	leafColor = "yellow" 	href = "#" id="testButton">+</a>
	<a class='newLeaf blue' 	leafColor = "blue" 		href = "#" id="testButton">+</a>
	<a class='newLeaf green' 	leafColor = "green" 	href = "#" id="testButton">+</a>

</div>
<ul class="leaves">

	<?php 
	foreach ($book->Leafs()->get() as $leaf){ 
		?>
	<li id="leaf{{$leaf->id}}" class="leaf ui-widget-content {{$leaf->Style()->first()->styleString}}" leafId='{{$leaf->id}}' xPos='{{$leaf->xPos}}' yPos='{{$leaf->yPos}}'>
		<a href='#' class='deleteLink'>X</a>
		<div class="content"><textarea>{{$leaf->content}}</textarea></div>
	</li>
	<?php } ?>

</ul>
</div>
@endsection
@section("links")
@endsection