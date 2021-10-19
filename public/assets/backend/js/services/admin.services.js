angular.module('admin.service', [])
    .factory('dashboardServices', dashboardServices)
    .factory('homeServices', homeServices)
    .factory('menuServices', menuServices)
    .factory('paketServices', paketServices)
    ;


function dashboardServices($http, $q, $state, helperServices, AuthService) {
    var controller = helperServices.url + 'users';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        post: post,
        put: put
    };

    function get() {
        var def = $q.defer();
        if (service.instance) {
            def.resolve(service.data);
        } else {
            $http({
                method: 'get',
                url: controller,
                headers: AuthService.getHeader()
            }).then(
                (res) => {
                    service.instance = true;
                    service.data = res.data;
                    def.resolve(res.data);
                },
                (err) => {
                    def.reject(err);
                }
            );
        }
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: helperServices.url + 'administrator/createuser/' + param.roles,
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: helperServices.url + 'administrator/updateuser/' + param.id,
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.firstName = param.firstName;
                    data.lastName = param.lastName;
                    data.userName = param.userName;
                    data.email = param.email;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

}

function homeServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'admin/home';
    var service = {};
    service.data = [];
    return {
        get: get
    };

    function get() {
        var def = $q.defer();
        if (service.instance) {
            def.resolve(service.data);
        } else {
            $http({
                method: 'get',
                url: controller + "/read",
                headers: AuthService.getHeader()
            }).then(
                (res) => {
                    def.resolve(res.data);
                },
                (err) => {
                    def.reject(err);
                }
            );
        }
        return def.promise;
    }

}

function menuServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'admin/menu';
    var service = {};
    service.data = [];
    return {
        get: get, post: post, put: put, deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/",
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { menu: param.menu, satuan: param.satuan, harga: param.harga, foto: param.foto };
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.menu = param.menu;
                    data.satuan = param.satuan;
                    data.harga = param.harga;
                    data.foto = param.foto;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }

}

function paketServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'admin/paket';
    var service = {};
    service.data = [];
    return {
        get: get, post: post, put: put, deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/",
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { menu: param.menu, satuan: param.satuan, harga: param.harga, foto: param.foto };
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.menu = param.menu;
                    data.satuan = param.satuan;
                    data.harga = param.harga;
                    data.foto = param.foto;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.messages.error)
            }
        );
        return def.promise;
    }

}