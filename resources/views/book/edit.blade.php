@extends("templates/layout")

@section("scripts")

<script type="text/javascript">

	$(document).ready(function(){
		$(".ticket").draggable();
		$(".ticket").mouseup(function(){
			position = $(this).position();
			var leafid = $(this).attr("leafId");
			saveLeaf( leafid , position.left, position.top );
		});
	});

	function saveLeaf( leafId, xPos, yPos, title, content ){
		console.log(leafId);
	}

</script>

@endsection

@section("title")
	- {{ $wall->name}}
@endsection


@section("mainContent")
@endsection

@section("links")
@endsection