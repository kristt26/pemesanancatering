angular.module('adminctrl', [])
    .controller('pageController', pageController)
    .controller('homeController', homeController)
    .controller('menuController', menuController)
    .controller('paketController', paketController)
    .controller('pegawaiController', pegawaiController)
    .controller('customerController', customerController)
    .controller('jadwalController', jadwalController)
    .controller('pesananController', pesananController)
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
                detail={paket_id: paket.id, menu_id: item.id};
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

function jadwalController($scope, helperServices, jadwalServices, message, $sce) {
    $scope.$emit("SendUp", "Layanan");
    $scope.datas = [];
    $scope.spot = [];
    $scope.pengumuman = [];
    $scope.model = {};
    $scope.jenisTanggal = "spot";
    jadwalServices.get().then(res => {
        $scope.datas = res;
        $scope.spot = $scope.datas.filter(x => x.layanan == 'Spot Iklan');
        $scope.pengumuman = $scope.datas.filter(x => x.layanan == 'Pengumuman');
        $scope.iklanspot($scope.grouptanggal($scope.spot));
    })
    $scope.jadwal = (param) => {
        $scope.infoOrder = param;
        $scope.jadwals = $scope.grouptanggal(param.jadwal);
        $("#jadwalsiaran").modal("show");
    }
    $scope.grouptanggal = (data) => {
        $scope.total = 0;
        var newArray = [];
        var dataTanggal = "";
        data.forEach(element => {
            if (dataTanggal != element.tanggal) {
                var item = { tanggal: element.tanggal }
                newArray.push(item);
                dataTanggal = element.tanggal;
            }
        });

        newArray.forEach(element => {
            var item = data.filter(x => x.tanggal == element.tanggal);
            element.display = 'background';
            element.start = element.tanggal
            element.end = element.tanggal
            element.langth = item.length
            element.color = item.length > 0 && item.length < 5 ? 'green' : item.length > 4 && item.length < 10 ? 'yellow' : item.length > 9 && item.length < 15 ? 'orange' : item.length == 15 ? '#dc3545' : ''
            delete element.tanggal;
        });
        return newArray;
    }
    $scope.iklanspot = (datas) => {
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');
        var items = [];
        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            locale: 'id',
            themeSystem: 'bootstrap',
            //Random default events
            events: items = datas,
            dateClick: function (info) {
                // alert('Date: ' + info.dateStr);
                // alert('Resource ID: ' + info.resource.id);
                jadwalServices.detail(info.dateStr).then(x => {
                    $scope.dataDetail = x;
                    if (x.spot.length > 0 || x.pengumuman.length > 0) {
                        $("#detail").modal('show');
                    }
                })
            }
        });
        console.log(items);

        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            // Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)

            // Add draggable funtionality
            ini_events(event)

            // Remove event from text input
            $('#new-event').val('')
        })
    }
    $scope.setData = (set) => {
        if (set == 'spot') {
            $scope.iklanspot($scope.grouptanggal($scope.spot));
        } else {
            $scope.iklanspot($scope.grouptanggal($scope.pengumuman));
        }
    }
}

function pesananController($scope, helperServices, pesananAdminServices, message, $sce) {
    $scope.$emit("SendUp", "Pesanan");
    
    $scope.datas = [];
    $scope.titleModal = "Tambah Data";
    $scope.model = {};
    $scope.model.detail = [];
    $scope.warning = [];
    pesananAdminServices.get().then(res => {
        $scope.datas = res;
        $scope.numm();
    })

    $scope.numm=()=>{
        return $scope.$emit("send", $scope.datas.pesanan.filter(x=>x.status_bayar=='Proses').length);
    }

    $scope.edit = (item) => {
        $scope.totalNomina = 0;
        $scope.model = angular.copy(item);
        $scope.model.pembayaran.forEach(element => {
            element.bukti = $sce.trustAsResourceUrl(helperServices.url + "assets/backend/img/pembayaran/" + element.bukti);
            $scope.totalNomina += parseFloat(element.nominal);
        });
        $("#upload").modal("show");
    }

    $scope.save = ()=>{
        message.dialog("Ingin mengkonfirmasi pembayaran?", "Ya", "Tidak").then(x=>{
            pesananAdminServices.put($scope.model).then(res=>{
                message.info('Konfirmasi pembayaran berhasil!!!');
                $("#upload").modal("hide");
                $scope.numm();
                $scope.model = {};
            })
        })
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

    $scope.showUpload = (item)=>{
        $scope.model = item;
        console.log(item);
    }

    $scope.cekFile = (item) => {
        console.log(item);
    }
}
