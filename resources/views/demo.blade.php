<?php //echo "<pre>";print_r($data);die;?>
@foreach($data as $alldata)
	<li>{{$alldata->catename}}</li>
		<ul>
			@foreach($alldata->getinfo as $sub)
				<li>{{$sub->subcate}}</li>	
			@endforeach
			
		</ul>

@endforeach