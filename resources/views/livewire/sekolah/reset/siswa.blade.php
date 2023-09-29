<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Reset Password Calon Siswa</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Reset Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent="resetPassword()" class="login100-form validate-form">

                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control" wire:model="email" type="text" placeholder="NIK">
                                </div>

                                <div class="col-md-6">
                                    <input class="form-control" type="number" wire:model="no_hp"
                                        placeholder="No WhatsApp" id="myInput">
                                </div>
                            </div>

                            {{ $respons }}
                            <div>
                                <button class="btn btn-warning mt-3" style="float: right">
                                    Reset Password
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
