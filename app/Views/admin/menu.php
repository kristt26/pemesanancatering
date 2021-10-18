<div class="col-md-12" ng-controller="menuController">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list"></i> Daftar Menu</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"><strong><i
                            class="fas fa-plus-circle"></i></strong></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu Makanan</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th><i class="fas fa-cog fa-spin"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in datas">
                        <td>{{$index+1}}</td>
                        <td>{{item.menu}}</td>
                        <td>{{item.satuan}}</td>
                        <td>{{item.harga}}</td>
                        <td>{{item.foto}}</td>
                        <td style="width: 10%">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning btn-sm mr-2" ng-click="edit(item)"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" ng-click="deleted(item.id)"><i
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
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form ng-submit="save()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="menu" class="col-sm-2 col-form-label col-form-label-sm">Menu</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="menu" ng-model="model.menu">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="satuan" class="col-sm-2 col-form-label col-form-label-sm">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="satuan"
                                    ng-model="model.satuan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-2 col-form-label col-form-label-sm">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm text-right" id="harga"
                                    mask-currency="'Rp. '" ng-model="model.harga">
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
</div>