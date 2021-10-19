angular.module('adminctrl', [])
    .controller('pageController', pageController)
    .controller('homeController', homeController)
    .controller('menuController', menuController)
    .controller('paketController', paketController)
    ;


function pageController($scope, helperServices) {
    $scope.Title = "Page Header";
}

function homeController($scope, $http, helperServices, homeServices, message) {
    $scope.$emit("SendUp", "Home");
    homeServices.get().then(x => {
        console.log(x);
        var lebel = [];
        var datas = [];
        var color = [];
        x.forEach(element => {
            lebel.push($scope.setBulan(element.stringbln));
            datas.push(element.jumlah);
            color.push("#" + Math.floor(Math.random() * 16777215).toString(16));
        });
        console.log(lebel);
        console.log(datas);
        console.log(color);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lebel,
                datasets: [{
                    data: datas,
                    backgroundColor: color,
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Pemasangan Iklan Tahun ' + new Date().getFullYear(),
                    }
                }
            }
        });
    })

    $scope.setBulan = (bulan) => {
        switch (parseInt(bulan)) {
            case 1:
                return "Januari"
                break;
            case 2:
                return "Februari"
                break;
            case 3:
                return "Maret"
                break;
            case 4:
                return "April"
                break;
            case 5:
                return "Mei"
                break;
            case 6:
                return "Juni"
                break;
            case 7:
                return "Juli"
                break;
            case 8:
                return "Agustus"
                break;
            case 9:
                return "September"
                break;
            case 10:
                return "Oktober"
                break;
            case 11:
                return "November"
                break;

            default:
                return "Desember"
                break;
        }
    }
}

function menuController($scope, $http, helperServices, menuServices, message, $sce) {
    $scope.$emit("SendUp", "Menu Makanan");
    $scope.datas = [];
    $scope.titleModal = "Tambah Data";
    $scope.model = {};
    menuServices.get().then(res => {
        $scope.datas = res;
    })

    $scope.save = () => {
        if ($scope.model.id) {
            menuServices.put($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
            })
        } else {
            menuServices.post($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
            })
        }
    }

    $scope.edit = (item) => {
        $scope.titleModal = "Ubah Data";
        $scope.model = item;
        $("#tambah").modal("show");
    }

    $scope.cekFile = (item) => {
        console.log(item);
    }
    $scope.files = "";
    $scope.showFoto = (item) => {
        $scope.$applyAsync(x => {
            $scope.files = $sce.trustAsResourceUrl(helperServices.url + "assets/backend/img/makanan/" + item.foto);
        })
        $("#modelId").modal("show");
    }

    $scope.deleted = (param) => {
        message.dialog("ingin menghapus?", "Yakin", "Tidak").then(x => {
            menuServices.deleted(param).then(res => {
                message.info("Berhasil");
            })
        })
    }
}

function paketController($scope, $http, helperServices, paketServices, message, $sce) {
    $scope.$emit("SendUp", "Paket Makanan");
    $scope.datas = [];
    $scope.titleModal = "Tambah Data";
    $scope.model = {};
    paketServices.get().then(res => {
        $scope.datas = res;
    })

    $scope.save = () => {
        if ($scope.model.id) {
            paketServices.put($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
            })
        } else {
            paketServices.post($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
            })
        }
    }

    $scope.edit = (item) => {
        $scope.titleModal = "Ubah Data";
        $scope.model = item;
        $("#tambah").modal("show");
    }

    $scope.cekFile = (item) => {
        console.log(item);
    }
    $scope.files = "";
    $scope.showFoto = (item) => {
        $scope.$applyAsync(x => {
            $scope.files = $sce.trustAsResourceUrl(helperServices.url + "assets/backend/img/makanan/" + item.foto);
        })
        $("#modelId").modal("show");
    }

    $scope.deleted = (param) => {
        message.dialog("ingin menghapus?", "Yakin", "Tidak").then(x => {
            paketServices.deleted(param).then(res => {
                message.info("Berhasil");
            })
        })
    }
}
