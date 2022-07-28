<?php $data = array();

	foreach ($response as $value):		
		$output = array();

		$output[] = $value["name"];
		$output[] = $value["email"];
		$output[] = $value["message"];
		$output[] = '<div>
			'.date("d/m/Y", strtotime($value["updated_at"])).'
			<small class="d-block">
				'.date("H:i:s", strtotime($value["updated_at"])).'
			</small>
		</div>';
		$output[] = '
			<a href="'.route('/contacts-form/save/'.$value['id']).'" class="btn btn-success btn-sm">
				<i class="fa fa-pencil"></i> 
			</a>
			<a href="'.route('/contacts-form/details/'.$value['id']).'" class="btn btn-success btn-sm">
				<i class="fa fa-book"></i> 
			</a>
			<a href="javascript:void(0)" class="btn btn-danger btn-sm j_remove_record" 
			data-removeurl="'.route('/contacts-form/remove/'.$value['id']).'"
			data-titlemsg="Message" 
			data-confirmmsg="Do you want to remove this record?" 
			data-successmsg="Record successfully removed" 
			data-failedmsg="Failed to remove record" 	
			data-id="'.$value['id'].'">
				<i class="fa fa-trash"></i> 
			</a>';

		$data[] = $output;

	endforeach; ?>
<?php echo json_encode($data) ?>