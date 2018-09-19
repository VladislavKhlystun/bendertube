<ul class="list-inline">
			@foreach ($categories as $category)
				 <li class="list-inline-item"> <a href="/category/{{$category->id}}">{{$category->title}}</a> </li>
			@endforeach
			</ul>