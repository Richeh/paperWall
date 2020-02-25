@extends('layouts.app')

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

@section("breadcrumb")
	<li><a href='/home'>Home</a></li>
	<li>Books</li>
@endsection

@section("title")
	- Books
@endsection


@section("content")


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Books</div>

				<ul class="itemList books">

					@foreach ($books as $book)
					<li><a href = '/books/{{$book->id}}'>{{$book->title}}</a></li>
					@endforeach
				</ul>                
            </div>
        </div>
    </div>
</div>


@endsection

@section("links")
@endsection