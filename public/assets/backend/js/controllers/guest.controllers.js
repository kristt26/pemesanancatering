angular.module('ctrl', [])
    .controller('pageController', pageController)
    .controller('homeController', homeController)
    .controller('pesananController', pesananController)
    ;

function pageController($scope, helperServices) {
    $scope.Title = "Page Header";
}

function homeController($scope, $http, helperServices, dashboardServices, $sce) {
    $scope.datas = [];
    dashboardServices.get().then(res=>{
        $scope.datas = res
        $scope.datas.menu.forEach(element => {
            element.harga = parseFloat(element.harga);
            $scope.$applyAsync(x => {
                element.foto = $sce.trustAsResourceUrl(helperServices.url + "assets/backend/img/makanan/" + element.foto);
            })
        });
        console.log($scope.datas);
    })
}

function pesananController($scope, helperServices, pesananServices, message, $sce) {
    $scope.$emit("SendUp", "Pegawai");
    $scope.datas = [];
    $scope.titleModal = "Tambah Data";
    $scope.model = {};
    $scope.model.detail = [];
    pesananServices.get().then(res => {
        $scope.datas = res;
        console.log($scope.datas.pesanan);
    })

    $scope.save = () => {
        message.dialog("Data setelah di simpan tidak dapat diubah!", "Ya", "Tidak").then(x=>{
            pesananServices.post($scope.model).then(res => {
                message.info("Berhasil")
                // $("#tambah").modal("hide");
                // $scope.titleModal = "Tambah Data";
                // $scope.model = {};
            })
        })
    }

    $scope.edit = (item) => {
        $scope.titleModal = "Ubah Data";
        $scope.model = angular.copy(item);
        $("#tambah").modal("show");
    }

    $scope.nilai = 0;
    $scope.setForm = (value)=>{
        $scope.nilai += value;
        if($scope.nilai==2){
            $("#tambah").modal("hide");
            $("#invoice").modal("show");
        }
        if($scope.nilai>0){
            if(!$scope.model.orderid){
                $scope.model.orderid = Date.now();
            }
        }
    }

    $scope.check = (item) => {
        if(item.value){
            item.paket_id = item.id;
            $scope.model.detail.push(angular.copy(item));
        }else{
            var data = $scope.model.detail.find(x=>x.paket_id==item.id);
            var index = $scope.model.detail.indexOf(data)
            $scope.model.detail.splice(index, 1);
        }
        console.log($scope.model); 
    }
    $scope.total = 0;
    $scope.subTotal = 0;
    $scope.tax = 0;
    $scope.hitungTotal=()=>{
        $scope.subTotal = 0;
        $scope.model.detail.forEach(element => {
            $scope.subTotal += (element.harga*element.jumlah);
        });
        $scope.tax = $scope.subTotal*0.1;
        $scope.total = $scope.subTotal + $scope.tax;
        $scope.model.tagihan = $scope.total;
    }

    $scope.showInvoice = (item)=>{
        $scope.model = angular.copy(item);
        $scope.model.tanggal_pesan = new Date($scope.model.tanggal_pesan);
        $scope.model.waktu_acara = new Date($scope.model.waktu_acara);
        var set = [];
        $scope.model.detail.forEach(element => {
            $scope.datas.paket.forEach(paket => {
                if(element.paket_id==paket.id){
                    var a = angular.copy(paket);
                    a.jumlah = parseFloat(element.jumlah);
                    set.push(a);
                }
            });
        });
        $scope.model.detail = set;
        $scope.hitungTotal();
        $("#invoice").modal("show");
    }
}
