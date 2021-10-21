<div class="col-md-12" ng-controller="customerController">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list"></i> Daftar Customer</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th><i class="fas fa-cog fa-spin"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in datas">
                        <td>{{$index+1}}</td>
                        <td>{{item.nama}}</td>
                        <td>{{item.nik}}</td>
                        <td>{{item.alamat}}</td>
                        <td>{{item.kontak}}</td>
                        <td style="width: 10%">
                            <div class="d-flex justify-content-center">
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