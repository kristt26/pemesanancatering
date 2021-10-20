<div class="col-md-12" ng-controller="paketController">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Paket</h3>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <form ng-submit="save()">
                            <div class="form-group row">
                                <label for="paket" class="col-sm-4 col-form-label col-form-label-sm">Nama Paket</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="paket"
                                        ng-model="model.nama_paket">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="porsi" class="col-sm-4 col-form-label col-form-label-sm">Porsi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="porsi"
                                        ng-model="model.porsi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan"
                                    class="col-sm-4 col-form-label col-form-label-sm">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-sm" id="keterangan" rows="3"
                                        ng-model="model.keterangan"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <a href="" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#tambah">Tambah
                                    Item</a>
                            </div>
                            <div class="form-group" ng-show="model.detail.length>0">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in model.detail">
                                            <td>{{item.menu}}</td>
                                            <td>{{item.harga | currency: 'Rp. '}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td>{{model.harga = getTotal() | currency: 'Rp. '}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
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
                                <th>Nama Paket</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah Porsi</th>
                                <th>Total</th>
                                <th><i class="fas fa-cog fa-spin"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.nama_paket}}</td>
                                <td>{{item.harga | currency: 'Rp. '}}</td>
                                <td>{{item.porsi}}</td>
                                <td>{{item.harga*item.porsi | currency: 'Rp. '}}</td>
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
                <div class="modal-body">
                    <div class="row text-center text-lg-start">
                        <div class="col-lg-4 col-md-3 col-6" ng-repeat="item in menus">
                            <div class="custom-control custom-checkbox image-checkbox">
                                <input type="checkbox" class="custom-control-input" ng-model="item.value" ng-change="checkItem(item)" id="ck{{$index}}">
                                <label class="custom-control-label" for="ck{{$index}}">
                                    <img class="img-fluid img-thumbnail" ng-src="{{item.foto}}" alt="">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <img ng-src="{{files}}" class="img-responsive " />
            </div>
        </div>
    </div>



</div>