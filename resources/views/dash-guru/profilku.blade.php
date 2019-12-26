<div class="row">
    <div class="d-flex justify-content-center align-items-center col-12">
        <div class="card" style="width:400px">
            {{-- @php($cek = file_exists('/img/faces/soleh.jpg'))
            <img class="card-img-top" src="{{ (file_exists('/img/faces/'.Auth::user()->username).'jpg') ? asset('img/faces/'.Auth::user()->username.'.jpg') : asset('img/avatar-1.png') }}" alt="Card image"> --}}
            <button class="close btn-ganti-foto" style="position: absolute; right: 20px;top:20px;" title="Ganti Foto Profil">
                <i class="nc-icon nc-camera-20"></i>
            </button>
            <input type="file" name="imgFoto" id="imgFoto" style="display:none">
            @if(file_exists(public_path('/img/faces/'.Auth::user()->nip.'.jpg')))
                <img src="{{ asset('/img/faces/'.Auth::user()->nip.'.jpg') }}" alt="Avatar" class="card-img-top" >
            @else
                <img src="{{ asset('/img/avatar-1.png') }}" alt="Avatar" class="card-img-top" >
            @endif
            <div class="card-body">
                <h4 class="card-title">{{Auth::user()->fullname}}</h4>
                <p class="card-text" style="background:orange;color: white;display:grid; grid-template-columns: 30% auto;">
                    <span style="padding: 3px 5px;box-sizing:border-box;">NIP: </span>
                    <span style="font-family:Arial, Helvetica, sans-serif; background: black; color: orangered;padding: 3px 10px; box-sizing:border-box;">{{Auth::user()->nip}}</span>
                </p>
                <p class="card-text" style="background:orange;color:white;display:grid; grid-template-columns: 30% auto;">
                    <span style="padding: 3px 5px;box-sizing:border-box;">Username: </span>
                    <span style="font-family: cursive; background: black; color: orangered;padding: 3px 10px; box-sizing:border-box;">{{Auth::user()->username}}</span>
                </p>
                <p class="card-text" style="background:orange;color:white;display:grid; grid-template-columns: 30% auto;">
                    <span style="padding: 3px 5px;box-sizing:border-box;">Email: </span>
                    <span style="font-family: cursive; background: black; color: orangered;padding: 3px 10px; box-sizing:border-box;">{{Auth::user()->email}}</span>
                </p>
                <p class="card-text" style="background:orange;color:white;display:grid; grid-template-columns: 30% auto;">
                    <span style="padding: 3px 5px;box-sizing:border-box;">HP: </span>
                    <span style="font-family: cursive; background: black; color: orangered;padding: 3px 10px; box-sizing:border-box;">{{Auth::user()->hp}}</span>
                </p>
            </div>
          </div>
    </div>
</div>