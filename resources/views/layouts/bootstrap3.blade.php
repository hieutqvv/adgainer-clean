@if ($breadcrumbs)
	<ul class="breadcrumb">
		@foreach ($breadcrumbs as $breadcrumb)

			<?php $titleBreadCumbs = App\User::getArrayAttribute($breadcrumb->title); ?>

			@if ($breadcrumb->url && !$breadcrumb->last)
				<li class="breadcrumb-item">
					<div class="breadcrumb-item-detail">
						<span class="title"><a href="{{ $breadcrumb->url }}">{{ $titleBreadCumbs[0] }}</a><br></span>
	                    <a data-toggle="dropdown" id="dropdownMenu1" class="dropdown-toggle" href="{{ $breadcrumb->url }}">
	                        <span class="content">{{ $titleBreadCumbs[1]['all'] }}</span>
	                    </a>
	                    <ul class="dropdown-menu extended tasks-bar id_{{$titleBreadCumbs[0]}}" id="dropdownMenu1">
	                    	@if (count($titleBreadCumbs[1]) > 0)
		                    	<div class="dropdown-menu scroll-menu">
		                    		@foreach ($titleBreadCumbs[1] as $key => $account)
			                    		<li>
		                                    <a href="#">
		                                        <div class="desc" data-breadcumbs="{{$key}}" data-url="{{$breadcrumb->url}}">{{$account}}</div>
		                                    </a>
		                                </li>
	                                @endforeach
		                    	</div>
	                    	@endif
	                    </ul>
                	</div>
				</li>
			@else
				<li class="breadcrumb-item active">
					<div class="breadcrumb-item-detail">
						<span class="title">{{ $titleBreadCumbs[0] }}<br></span>
	                    <a data-toggle="dropdown" id="dropdownMenu1" class="dropdown-toggle" href="#">
	                        <span class="content">{{ $titleBreadCumbs[1]['all'] }}</span>
	                    </a>
	                    <ul class="dropdown-menu extended tasks-bar id_{{$titleBreadCumbs[0]}}" id="dropdownMenu1">
	                    	@if (count($titleBreadCumbs[1]) > 0)
	                    		
		                    	<div class="dropdown-menu scroll-menu">
		                    		@foreach ($titleBreadCumbs[1] as $key => $account)
		                    		<li>
	                                    <a href="#">
	                                        <div class="desc" data-breadcumbs="{{$key}}" data-url="{{$breadcrumb->url}}" >{{$account}}</div>
	                                    </a>
	                                </li>
	                                @endforeach
		                    	</div>
		                    	
	                    	@endif
	                    </ul>
	                </div>
				</li>
			@endif
		@endforeach
	</ul>
@endif
