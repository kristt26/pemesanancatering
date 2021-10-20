<div class="col-md-12" ng-controller="pegawaiController">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list"></i> Daftar Pegawai</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah" ng-click="model={}"><strong><i
                            class="fas fa-plus-circle"></i></strong></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Pekerjaan</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th><i class="fas fa-cog fa-spin"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in datas">
                        <td>{{$index+1}}</td>
                        <td>{{item.nama}}</td>
                        <td>{{item.pekerjaan}}</td>
                        <td>{{item.deskripsi}}</td>
                        <td><a href="javascript:void();" ng-click="showFoto(item)">{{item.foto}}</a></td>
                        <td style="width: 10%">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning btn-sm mr-2" ng-click="edit(item)"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" ng-click="deleted(item)"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">{{titleModal}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form ng-submit="save()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label col-form-label-sm">Nama Pegawai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="nama" ng-model="model.nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pekerjaan" class="col-sm-2 col-form-label col-form-label-sm">Pekerjaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="pekerjaan"
                                    ng-model="model.pekerjaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label col-form-label-sm">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm" id="deskripsi" ng-model="model.deskripsi" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="foto" class="col-sm-2 col-form-label col-form-label-sm">Foto</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input custom-file-input-sm" id="foto"
                                            aria-describedby="inputGroupFileAddon01" ng-model="model.foto"
                                            base-sixty-four-input ng-change="cekFile(model.foto)">
                                        <label class="custom-file-label"
                                            for="foto">{{model.foto ? model.foto.filename: model.foto && !model.foto ? model.foto: 'Pilih File'}}</label>
                                    </div>

                                    <span ng-show="form.model.foto.$error.maxsize">Files must not exceed 5000
                                        KB</span>
                                </div>
                                <span ng-show="model.id">Kosongkan jika tidak ingin
                                    mengganti</span>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <img ng-src="{{files}}" class="img-responsive " />
            </div>
        </div>
    </div>



</div>