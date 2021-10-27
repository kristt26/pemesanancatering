angular.module('adminctrl', [])
    .controller('pageController', pageController)
    .controller('homeController', homeController)
    .controller('menuController', menuController)
    .controller('paketController', paketController)
    .controller('pegawaiController', pegawaiController)
    .controller('customerController', customerController)
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
                $scope.titleModal = "Tambah Data";
                $scope.model = {};
            })
        } else {
            menuServices.post($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
                $scope.titleModal = "Tambah Data";
                $scope.model = {};
            })
        }
    }

    $scope.edit = (item) => {
        $scope.titleModal = "Ubah Data";
        $scope.model = angular.copy(item);
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


function paketController($scope, $http, helperServices, paketServices, message, $sce, menuServices) {
    $scope.$emit("SendUp", "Paket Makanan");
    $scope.datas = [];
    $scope.titleModal = "Tambah Data";
    $scope.model = {};
    $scope.model.detail = [];
    $scope.menus = [];
    paketServices.get().then(res => {
        $scope.datas = res;
        menuServices.get().then(x => {
            $scope.menus = x;
            $scope.menus.forEach(element => {
                element.foto = $sce.trustAsResourceUrl(helperServices.url + "assets/backend/img/makanan/" + element.foto);
            });
        })
    })

    $scope.save = () => {
        if ($scope.model.id) {
            paketServices.put($scope.model).then(res => {
                message.info("Berhasil")
                $scope.model = {};
                $("#tambah").modal("hide");
            })
        } else {
            paketServices.post($scope.model).then(res => {
                message.info("Berhasil")
                $scope.model = {};
                $("#tambah").modal("hide");
            })
        }
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
        $scope.model.detail = [];
        item.detail.forEach(element => {
            var detail = $scope.menus.find(x => x.id == element.menu_id)
            if (detail) {
                detail.value = true;
                $scope.model.detail.push(angular.copy(detail));
            }
        });
    }


    $scope.checkItem = (item) => {
        var paket = $scope.datas.find(x => x.id == $scope.model.id);
        if (item.value) {
            if (paket) {
                detail = { paket_id: paket.id, menu_id: item.id };
                paketServices.postDetail(detail).then(x => { })
            }
            $scope.model.detail.push(item)
        } else {
            if (paket) {
                var detail = paket.detail.find(x => x.menu_id == item.id);
                paketServices.deleteDetail(detail).then(x => { })
            }
            var set = $scope.model.detail.find(x => x.id == item.id);
            if (set) {
                var index = $scope.model.detail.indexOf(set);
                $scope.model.detail.splice(index, 1);
            }
        }
        console.log($scope.model);
    }

    $scope.getTotal = () => {
        var total = 0;
        $scope.model.detail.forEach(element => {
            total += parseFloat(element.harga);
        });
        return total;
    }

    $scope.deleted = (param) => {
        message.dialog("ingin menghapus?", "Yakin", "Tidak").then(x => {
            paketServices.deleted(param).then(res => {
                message.info("Berhasil");
            })
        })
    }
}

function pegawaiController($scope, $http, helperServices, pegawaiServices, message, $sce) {
    $scope.$emit("SendUp", "Pegawai");
    $scope.datas = [];
    $scope.titleModal = "Tambah Data";
    $scope.model = {};
    pegawaiServices.get().then(res => {
        $scope.datas = res;
    })

    $scope.save = () => {
        if ($scope.model.id) {
            pegawaiServices.put($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
                $scope.titleModal = "Tambah Data";
                $scope.model = {};
            })
        } else {
            pegawaiServices.post($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
                $scope.titleModal = "Tambah Data";
                $scope.model = {};
            })
        }
    }

    $scope.edit = (item) => {
        $scope.titleModal = "Ubah Data";
        $scope.model = angular.copy(item);
        $("#tambah").modal("show");
    }

    $scope.cekFile = (item) => {
        console.log(item);
    }
    $scope.files = "";
    $scope.showFoto = (item) => {
        $scope.$applyAsync(x => {
            $scope.files = $sce.trustAsResourceUrl(helperServices.url + "assets/backend/img/foto/" + item.foto);
        })
        $("#modelId").modal("show");
    }

    $scope.deleted = (param) => {
        message.dialog("ingin menghapus?", "Yakin", "Tidak").then(x => {
            pegawaiServices.deleted(param).then(res => {
                message.info("Berhasil");
            })
        })
    }
}

function customerController($scope, $http, helperServices, customerServices, message, $sce) {
    $scope.$emit("SendUp", "Customer");
    $scope.datas = [];
    $scope.titleModal = "Tambah Data";
    $scope.model = {};
    customerServices.get().then(res => {
        $scope.datas = res;
    })

    $scope.save = () => {
        if ($scope.model.id) {
            customerServices.put($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
                $scope.titleModal = "Tambah Data";
                $scope.model = {};
            })
        } else {
            customerServices.post($scope.model).then(res => {
                message.info("Berhasil")
                $("#tambah").modal("hide");
                $scope.titleModal = "Tambah Data";
                $scope.model = {};
            })
        }
    }

    $scope.edit = (item) => {
        $scope.titleModal = "Ubah Data";
        $scope.model = angular.copy(item);
        $("#tambah").modal("show");
    }

    $scope.cekFile = (item) => {
        console.log(item);
    }
    $scope.files = "";
    $scope.showFoto = (item) => {
        $scope.$applyAsync(x => {
            $scope.files = $sce.trustAsResourceUrl(helperServices.url + "assets/backend/img/foto/" + item.foto);
        })
        $("#modelId").modal("show");
    }

    $scope.deleted = (param) => {
        message.dialog("ingin menghapus?", "Yakin", "Tidak").then(x => {
            customerServices.deleted(param).then(res => {
                message.info("Berhasil");
            })
        })
    }
}
