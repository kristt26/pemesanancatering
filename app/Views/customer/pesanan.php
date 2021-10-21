<div class="col-md-12" ng-controller="pesananController">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list"></i> Daftar Pesanan</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"
                    ng-click="model={}; model.detail=[]; hitungTotal()"><strong><i class="fas fa-plus-circle"></i></strong></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pesan</th>
                        <th>Waktu Acara</th>
                        <th>Alamat</th>
                        <th>Tagihan</th>
                        <th>Status Pembayaran</th>
                        <th>Catatan</th>
                        <th><i class="fas fa-cog fa-spin"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in datas.pesanan">
                        <td>{{$index+1}}</td>
                        <td>{{item.tanggal_pesan | date: 'EEEE, d MMMM y'}}</td>
                        <td>{{item.waktu_acara | date: 'EEEE, d MMMM y'}}</td>
                        <td>{{item.alamat}}</td>
                        <td>{{item.tagihan}}</td>
                        <td>{{item.status_bayar}}</td>
                        <td>{{item.catatan}}</td>
                        <td style="width: 10%">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning btn-sm mr-2" ng-click="edit(item)"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-success btn-sm mr-2" ng-click="showInvoice(item)"><i
                                        class="fas fa-file-invoice" title="Invoice"></i></button>
                                <!-- <button class="btn btn-danger btn-sm" ng-click="deleted(item)"><i
                                        class="fas fa-trash"></i></button> -->
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
                <form ng-submit="setForm(1)">
                    <div class="modal-body" ng-show="nilai==0">
                        <div class="form-group row">
                            <label for="waktu_acara" class="col-sm-3 col-form-label col-form-label-sm">Waktu
                                Acara</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control form-control-sm" id="waktu_acara"
                                    ng-model="model.waktu_acara" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label col-form-label-sm">Tempat Acara</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="alamat"
                                    ng-model="model.alamat" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="catatan" class="col-sm-3 col-form-label col-form-label-sm">Catatan
                                Tambahan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control form-control-sm" id="catatan" ng-model="model.catatan"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body" ng-show="nilai==1">
                        <div class="panel-pricing-in">
                            <div class="row">
                                <div ng-repeat="item in datas.paket" class="col-md-4 col-sm-4 text-center">
                                    <div class="panel panel-pricing">
                                        <div class="panel-heading">
                                            <!-- <div class="pric-icon">
                                        <img src="../assets/frontend/images/store.png" alt="" />
                                    </div> -->
                                            <h4>{{item.nama_paket}}</h4>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p><strong>{{item.harga | currency: 'Rp. '}}</strong></p>
                                            <!-- <h5 style="color: black;">{{item.porsi}} Porsi</h5> -->
                                        </div>
                                        <ul class="list-group text-center">
                                            <li ng-repeat="det in item.detail" class="list-group-item"><i
                                                    class="fa fa-check"></i> {{det.menu}}</li>
                                        </ul>
                                        <div class="panel-footer">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" ng-model="item.value"
                                                    ng-change="check(item)" id="inlineCheckbox{{$index}}">
                                                <label class="form-check-label"
                                                    for="inlineCheckbox{{$index}}">Pilih</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"
                            ng-click="nilai=0">Batal</button>
                        <button ng-show="nilai>0" type="button" class="btn btn-warning btn-sm"
                            ng-click="setForm(-1)">Kembali</button>
                        <button ng-show="nilai<3" type="submit" class="btn btn-primary btn-sm">Lanjut</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        data-backdrop="false" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> CATERING JAYAPURA
                                    <small class="float-right">Date: <?=date('d M Y');?></small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>Catering Jayapura</strong><br>
                                    Hamadi, Jayapura Selatan, Kota Jayapura, Papua<br>
                                    Indonesia, Kode Pos 99221<br>
                                    Phone: (0967) 536386<br>
                                    Email: info@rrijayapura.com
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong><?=session()->get("nama");?></strong><br>
                                    <?=session()->get("alamat") ? session()->get("alamat") : '';?><br>
                                    Phone: <?=session()->get("kontak");?><br>
                                    <!-- Email: <?=session()->get("email");?> -->
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <br>
                                <b>Order ID:</b> {{model.orderid}}<br>
                                <b>Payment Due:</b> <?=date('d-m-Y', strtotime(' +1 day'))?><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Paket</th>
                                            <th>Harga Paket</th>
                                            <th>Jumlah Pesan</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in model.detail">
                                            <td>{{item.nama_paket}}</td>
                                            <td>{{item.harga}}</td>
                                            <td>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control form-control-sm" ng-model="item.jumlah" ng-disabled="model.id"
                                                        ng-change="hitungTotal()" required>
                                                </div>
                                            </td>
                                            <td width = 20%>{{item.harga*item.jumlah | currency}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                <img src="../assets/backend/dist/img/credit/visa.png" alt="Visa">
                                <img src="../assets/backend/dist/img/credit/mastercard.png" alt="Mastercard">
                                <img src="../assets/backend/dist/img/credit/american-express.png"
                                    alt="American Express">
                                <img src="../assets/backend/dist/img/credit/paypal2.png" alt="Paypal">

                                <p>anda dapat melakukan transfer bank ke rekening berikut<br>
                                    Bank BRI : 0821212121 / Deni Malik <br>
                                    Bank Mandiri : 0821212121 / Deni Malik <br>
                                    Bank BCA : 0821212121 / Deni Malik
                                </p>

                                <!-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya
                                    handango imeem
                                    plugg
                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                </p> -->
                            </div>
                            <div class="col-6">
                                <p class="lead">Amount Due <?=date('d-m-Y', strtotime(' +1 day'))?></p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>{{subTotal | currency}}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax (10%)</th>
                                            <td>{{tax | currency}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>{{total | currency}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a> -->
                                <button id="pay-button" type="button" class="btn btn-success float-right"
                                    ng-click="save()"><i class="far fa-credit-card"></i>
                                    Confirm
                                </button>
                                <button ng-show="nilai>0" type="button" class="btn btn-warning btn-sm"
                                    ng-click="setForm(-1)">Kembali</button>
                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal" ng-click="nilai=0"
                                    style="margin-right: 5px;">
                                    <i class="fas fa-back"></i> Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

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