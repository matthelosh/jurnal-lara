<div class="d-flex justify-content-center align-items-center">
    <div class="card card-custom" style="width:500px;">
	<div class="card-header">
		<div class="card-media">
            <img src="/img/bg.jpg" alt="Card-header">
        </div>
        @php
        	// $img=(file_exists('/img/faces/'.$data->username.'.jpg')) ? '/img/faces/'.$data->username.'.jpg' : '/img/avatar-1.png';
        	$img = '/img/avatar-1.png';
        	if(file_exists(public_path('/img/faces/'.$data->nip.'.jpg'))) {
        		$img = '/img/faces/'.$data->nip.'.jpg';
        	}
        @endphp
        <div class="logo-sekolah" style="background: #fff url('{{ $img }}');background-size: cover; background-position: center; background-repeat:no-repeat;">
            <button class="close btn-edit-avatar" style="display:none;">
                <i class="nc-icon nc-camera-20"></i>
            </button>
            <input type="file" name="imgAvatar" id="imgAvatar" style="display:none">
        </div>
		<h4 class="card-title">
			<i class="nc-icon nc-single-02"></i>
            {{ ucfirst($data->fullname) }}
            <button class="close btn-edit-user-detil">
                    <i class="fa fa-edit"></i>
                </button>
        </h4>
       
	</div>
	<div class="card-body">
	    <div class="card">
	    	<div class="card-body">
	    		Nama	: {{ $data->fullname }}
	    	</div>
	    </div>
	    <div class="card">
	    	<div class="card-body">
	    		User ID	: {{ $data->username }}
	    	</div>
	    </div>
	    <div class="card">
	    	<div class="card-body">
	    		NIP	: {{ $data->nip }}
	    	</div>
	    </div>
	    <div class="card">
	    	<div class="card-body">
	    		Email	: {{ $data->email }}
	    	</div>
	    </div>
	    <div class="card">
	    	<div class="card-body">
	    		HP	: {{ $data->hp }}
	    	</div>
	    </div>
	    
	</div>
    </div>
</div>